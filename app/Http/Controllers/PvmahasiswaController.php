<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;

use App\Models\pvmahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PvmahasiswaController extends Controller
{
    //
    public function mahasiswa()

    {

        if (request()->ajax()) {
            return Datatables::of(pvmahasiswa::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                          <li class='list-inline-item'>
                          <button type='button' data-toggle='modal' onclick='staffupd(" .
                        $dataj .
                        ")' class='btn btn-sm btn-success btn-xs mb-1'>Edit</button>
                          </li>
                          <li class='list-inline-item'>
                          <button type='button' onclick='staffdel(" .
                        $data->id .
                        ")' class='btn btn-sm btn-danger btn-xs mb-1'>Hapus</button>
                          </li>";

                    $btn .=
                        "<li class='list-inline-item'>
                          <a href='/admin/pv-tagihan/" .
                        $data->id .
                        "' class='btn btn-sm btn-warning btn-xs mb-1'>Lihat Tagihan</a>
                        </li>";

                    $btn .= '</ul>';
                    return $btn;
                })

                ->addColumn('jenismhs', function ($data) {
                    if ($data->jenis == 1) {
                        $btn = 'Mahasiswa Baru';
                    } else {
                        $btn = 'Mahasiswa Lanjutan';
                    }

                    return $btn;
                })
                ->addColumn('identitas', function ($data) {
                    $btn = '<strong>' . $data->nama . '</strong><br>' . $data->nik;
                    return $btn;
                })
                ->addColumn('noidentitas', function ($data) {
                    if ($data->jenis == 1) {
                        $btn = $data->nodaftar;
                    } else {
                        $btn = $data->nim;
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'jenismhs', 'identitas', 'noidentitas'])
                ->make(true);
        }
        return view('va.mahasiswapps');
    }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:pvmahasiswas,nik',
            'nim' => 'nullable|string|max:12|min:12|unique:pvmahasiswas,nim',
            'nodaftar' => 'nullable|string|max:12|min:12|unique:pvmahasiswas,nodaftar',
            'prodi' => 'required|string|max:100',
            'jenjang' => 'required|string|max:10',
            'angkatan' => 'required|string|max:10',
            'jenis' => 'required|in:1,2',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors()
            ]);
        }

        // Simpan data mahasiswa
        try {
            $mahasiswa = new pvmahasiswa();
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nik = $request->nik;
            $mahasiswa->nim = $request->nim ?? null;
            $mahasiswa->nodaftar = $request->nodaftar ?? null;
            $mahasiswa->prodi = $request->prodi;
            $mahasiswa->jenjang = $request->jenjang;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->jenis = $request->jenis;
            $mahasiswa->jalur_masuk = 'USM';
            $mahasiswa->status = 1;
            $mahasiswa->fakultas = 'PPS';
            $mahasiswa->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil disimpan',
                'data' => $mahasiswa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function delete(Request $request)
    {
        // Validasi ID yang diberikan
        $request->validate([
            'id' => 'required|exists:pvmahasiswas,id',  // Pastikan ID ada di database
        ]);

        try {
            // Cari data mahasiswa berdasarkan ID
            $mahasiswa = pvmahasiswa::findOrFail($request->id);

            // Hapus data mahasiswa
            $mahasiswa->delete();

            // Return response sukses
            return response()->json([
                'status' => 'success',
                'message' => 'Data mahasiswa berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            // Menangani jika terjadi error saat penghapusan
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data.',
            ], 500);
        }
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:pvmahasiswas,nim,' . $request->id,  // NIM harus unik kecuali untuk ID pvmahasiswas yang sedang di-update
            'nik' => 'nullable|string|max:50|unique:pvmahasiswas,nik,' . $request->id,  // NIK harus unik kecuali untuk ID pvmahasiswas yang sedang di-update
            'nodaftar' => 'nullable|string|max:50|unique:pvmahasiswas,nodaftar,' . $request->id,  // No. Daftar harus unik kecuali untuk ID mahasiswa yang sedang di-update
            'prodi' => 'required|string|max:100',
            'jenjang' => 'required|string|max:10',
            'angkatan' => 'required|string|max:10',
            'jenis' => 'required|in:1,2',
            'status' => 'required|in:1,2',
        ]);

        try {
            // Cari data mahasiswa berdasarkan ID
            $mahasiswa = pvmahasiswa::findOrFail($request->id);

            // Update data mahasiswa
            $mahasiswa->nama = $request->nama;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nik = $request->nik;
            $mahasiswa->nodaftar = $request->nodaftar;
            $mahasiswa->prodi = $request->prodi;
            $mahasiswa->jenjang = $request->jenjang;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->jenis = $request->jenis;
            $mahasiswa->status = $request->status;

            // Simpan perubahan
            $mahasiswa->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data mahasiswa berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data.',
            ], 500);
        }
    }
}
