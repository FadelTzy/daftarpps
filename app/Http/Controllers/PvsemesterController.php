<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pvsemester;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PvsemesterController extends Controller
{
    public function gel()
    {
        // return gel::get();
        if (request()->ajax()) {
            return Datatables::of(pvsemester::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);

                    // Cek status dan tentukan tombol yang sesuai
                    if ($data->status == 'Nonaktif') {
                        $btn = "<ul class='list-inline mb-0'>
                            <li class='list-inline-item'>
                                <button type='button' onclick='ubahStatus(" . $data->id . ", \"Aktif\")' 
                                class='btn btn-sm btn-success btn-xs mb-1'>Buka Pembayaran</button>
                            </li>
                        </ul>";
                    } else {
                        $btn = "<ul class='list-inline mb-0'>
                            <li class='list-inline-item'>
                                <button type='button' onclick='ubahStatus(" . $data->id . ", \"Nonaktif\")' 
                                class='btn btn-sm btn-danger btn-xs mb-1'>Tutup Pembayaran</button>
                            </li>
                        </ul>";
                    }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('va.pvsemester');
    }
    public function aktifasi(Request $request)
    {
        try {
            $id = $request->id;
            $status = $request->status;

            // Cari data semester berdasarkan ID
            $semester = pvsemester::findOrFail($id);

            // Jika status yang diminta adalah 'Aktif', nonaktifkan semester lain
            if ($status == 'Aktif') {
                pvsemester::where('status', 'Aktif')->update(['status' => 'Nonaktif']);
            }

            // Update status semester yang dipilih
            $semester->status = $status;
            $semester->save();

            return response()->json('success');
        } catch (\Exception $e) {
            return response()->json('error', 500);
        }
    }


    public function gelstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => ['required', 'string', 'max:10', 'min:9'], // contoh 2024/2025
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'data' => $validator->errors()]);
        }

        try {
            $tahun = $request->tahun; // contoh: 2024/2025
            $tahunArray = explode('/', $tahun); // pisahkan menjadi [2024, 2025]

            if (count($tahunArray) !== 2) {
                return response()->json(['status' => 'error', 'data' => 'Format tahun tidak valid.']);
            }

            $tahun_awal = $tahunArray[0]; // 2024
            $tahun_akhir = $tahunArray[1]; // 2025

            // Data semester Ganjil
            $ganjil = [
                'nama_semester' => 'Ganjil ' . $tahun,
                'kode_semester' => $tahun_awal . '1',
                'tanggal_mulai' => $tahun_awal . '-08-01',
                'tanggal_selesai' => $tahun_akhir . '-01-15',
                'status' => 'Nonaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Data semester Genap
            $genap = [
                'nama_semester' => 'Genap ' . $tahun,
                'kode_semester' => $tahun_awal . '2',
                'tanggal_mulai' => $tahun_akhir . '-02-01',
                'tanggal_selesai' => $tahun_akhir . '-07-15',
                'status' => 'Nonaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Simpan ke database
            DB::table('pvsemesters')->insert([$ganjil, $genap]);

            return response()->json(['status' => 'success', 'message' => 'Semester berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    //
}
