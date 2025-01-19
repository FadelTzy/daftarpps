<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Models\pvgel;
use App\Models\pvmahasiswa;
use Carbon\Carbon;

use App\Models\pvsemester;
use App\Models\pvtagihan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PvtagihanController extends Controller
{
    //
    public function delete(Request $request)
    {

        try {
            // Cari data mahasiswa berdasarkan ID
            $mahasiswa = pvtagihan::findOrFail($request->id);
            if ($mahasiswa->statustagihan == 2) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tagihan sedang live, tekan delete VA terlebih dahulu.',
                ]);
            }
            if ($mahasiswa->statusbayar == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak bisa menghapus tagihan yang telah lunas',
                ]);
            }
            // Hapus data mahasiswa
            $mahasiswa->delete();

            // Return response sukses
            return response()->json([
                'status' => 'success',
                'message' => 'Data tagihan berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            // Menangani jika terjadi error saat penghapusan
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data.',
            ], 500);
        }
    }
    public function edit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'va' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
            'tagihan' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'flag' => 'required|string|in:F,P',
        ]);

        try {
            $tagihan = pvtagihan::findOrFail($request->id);

            // Update the Tagihan data
            $tagihan->update([
                'nama' => preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $request->nama),
                'va' => $request->va,
                'ref' => $request->ref,
                'tagihan' => $request->tagihan,
                'description' => $request->deskripsi,
                'flag' => $request->flag,
                'statustagihan' => 1,
                'expired' => Carbon::now()->addMonths(3)->format('ymdHi'),

            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Tagihan berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan tagihan: ' . $e->getMessage()
            ], 500);
        }
        // Find the Tagihan record by ID


        // Redirect to a specific page with a success message
        return redirect()->route('tagihan.index')->with('success', 'Tagihan updated successfully!');
    }
    public function create(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'va' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
            'tagihan' => 'required|numeric',
            'prodi' => 'required|string|max:255',
            'jenjang' => 'required|string|max:10',
            'semester' => 'required|exists:pvsemesters,kode_semester',  // Pastikan kode_semester ada di tabel pvsemesters
            'gel' => 'string|max:10',
            'angkatan' => 'required|string|max:10',
            'jenis' => 'required|in:1,2',
        ]);

        try {
            $datasemester = pvsemester::where('kode_semester', $request->semester)->first();

            $datamhs = pvmahasiswa::where('id', $request->id)->first();
            if (!$datamhs) {
                return response()->json([
                    'status' => 'danger',
                    'message' => 'Data Mahasiswa tidak ditemukan.'
                ]);
            }
            //cek gel
            $kodegel = '';
            $gel = pvgel::where('kode_semester', $request->semester)->latest()->first();
            if ($gel == null) {
                $kodegel = pvgel::create([
                    'kode_semester' => $request->semester,
                    'kodegel' => 1
                ]);
                $gel = $kodegel;
            }
            // return $kodegel;
            // Menyimpan data tagihan
            $tagihan = new pvtagihan();

            $tagihan->idmhs = $request->id;
            $tagihan->nama = preg_replace('/[^a-zA-Z0-9\s\-_]/', '', $request->nama);
            $tagihan->nik = $datamhs->nik;
            $tagihan->nim = $datamhs->nim;
            $tagihan->nodaftar = $datamhs->nodaftar;
            $tagihan->va = str_pad($request->va, 17, '0', STR_PAD_RIGHT);
            if ($request->jenis == 1) {
                $deskripsi = 'Pembayaran SPP & Daftar Semester ' . $datasemester->nama_semester;
                $jenis = 'Mahasiswa Baru';
                $tagihan->ref = str_pad($request->ref, 12, '0', STR_PAD_RIGHT);
            } else {
                $deskripsi = 'Pembayaran SPP Semester' . $datasemester->nama_semester;

                $jenis = 'Mahasiswa Lanjut';
                $tagihan->ref = str_pad($request->ref, 12, '0', STR_PAD_RIGHT);
            }
            // return $tagihan->ref;
            $tagihan->layanan = $request->prodi;
            $tagihan->kodelayanan = $request->kodelayanan;
            $tagihan->jenisbayar = $jenis;
            $tagihan->kodejenisbayar = $request->jenis;
            $tagihan->tagihan = $request->tagihan;
            $tagihan->totalbayar = $request->tagihan;
            $tagihan->noid = $datamhs->id;
            $tagihan->flag = $request->flag;
            $tagihan->angkatan = $request->angkatan;
            $tagihan->periode = $request->semester;
            $tagihan->gel = $gel->kodegel;
            $tagihan->description = $deskripsi;
            $tagihan->reserve = $request->jenjang;

            $tagihan->expired = Carbon::now()->addMonths(3)->format('ymdHi');

            $tagihan->statustagihan = 1;
            $tagihan->statusbayar = 0;


            // Simpan tagihan ke database
            $tagihan->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Tagihan berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan tagihan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function tagihan($id)

    {
        $user = pvmahasiswa::where('id', $id)->first();
        $periode = pvsemester::get();
        $gel = pvgel::get();
        if (request()->ajax()) {
            $data = pvtagihan::with('oB')->where('idmhs', $id)->where('nik', $user->nik)->orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn = "<ul class='list-inline mb-0'>";
                    $btn .=
                        "<li class='list-inline-item'>
            <button type='button'  onclick='staffupd(" .
                        $dataj .
                        ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit Data</button>
            </li>";
                    $btn .=
                        "<li class='list-inline-item'><button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete Data</button>
</li>";
                    if ($data->statusbayar == 1) {
                        $btn .=
                            "<li class='list-inline-item'>
        <button type='button'  onclick='cekbayar(" .
                            $dataj .
                            ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Cek Pembayaran</button>
        </li>";
                        $btn .=
                            "<li class='list-inline-item'><button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete Data</button>
</li>";
                        $btn .=
                            "<li class='list-inline-item'>
            <button type='button'  onclick='inquiryva(" .
                            $dataj .
                            ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
            </li>";
                    } else {
                        if ($data->statustagihan != 1) {
                            $btn .=
                                "<li class='list-inline-item'>
                        <button type='button'  onclick='updateva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Update VA</button>
                        </li>";
                            $btn .=
                                "<li class='list-inline-item'>
                        <button type='button'  onclick='deleteva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                        </li>";
                            $btn .=
                                "<li class='list-inline-item'>
                    <button type='button'  onclick='inquiryva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
                    </li>";
                        } else {
                            $btn .=
                                "<li class='list-inline-item'>
                        <button type='button'  onclick='createva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Send VA</button>
                        </li>";
                            $btn .=
                                "<li class='list-inline-item'>
                    <button type='button'  onclick='deleteva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                    </li>";
                            $btn .=
                                "<li class='list-inline-item'>
            <button type='button'  onclick='inquiryva(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
            </li>";
                        }
                    }

                    $btn .= '</ul>';
                    return $btn;
                })

                ->addColumn('tagihannya', function ($data) {
                    $btn = Money($data->tagihan, 'IDR', 'true');

                    return $btn;
                })
                ->addColumn('periodenya', function ($data) {
                    $btn = $data->periode . ' - ' . $data->gel;

                    return $btn;
                })

                ->addColumn('statusnya', function ($data) {
                    if ($data->statustagihan == 1) {
                        $btn = '<span class="badge badge-warning">Belum Live</span>';
                    } elseif ($data->statustagihan == 2) {
                        $btn = '<span class="badge badge-success">Sudah Live</span>';
                    } else {
                        $btn = '<span class="badge badge-primary">TRX Selesai</span>';
                    }
                    $btn .= '<br>';
                    if ($data->statusbayar == 1) {
                        $btn .= '<span class="badge badge-success">Sudah Lunas</span>';
                    } else {
                        $btn .= '<span class="badge badge-danger">Belum Lunas</span>';
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'tagihannya', 'identitas', 'statusnya'])
                ->make(true);
        }
        return view('va.tagihanmhs', compact('user', 'id', 'periode', 'gel'));
    }
}
