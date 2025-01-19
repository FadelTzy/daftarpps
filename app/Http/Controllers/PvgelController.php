<?php

namespace App\Http\Controllers;

use App\Models\pvgel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\pvtagihan;
use App\Models\pvsemester;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\vauser as im;
use Carbon\Carbon;
use App\Models\bayarpps;
use App\Models\ppsmhs;
use App\Models\daftarmhs;
use Illuminate\Support\Facades\DB;
use App\Models\pvproblems;
use App\Models\pvmahasiswa;

class PvgelController extends Controller
{
    public function fN($name)
    {
        // Pola ekspresi reguler yang diperbarui
        $pattern = "/[,'`:;@#$]+/";

        // Ganti karakter khusus dengan string kosong
        $filteredName = preg_replace($pattern, '', $name);

        return $filteredName;
    }

    public function importdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required'],
            'semester' => ['required'],
            'gel' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $array = Excel::toCollection(new im(), $request->file('file'));
        $datasemester = pvsemester::where('kode_semester', $request->semester)->first();

        DB::beginTransaction();
        $failedData = [];

        try {
            foreach ($array[0] as $key => $value) {
                if ($key == 0 || !isset($value[10], $value[1], $value[2])) {
                    continue;
                }

                $jenis = $value[2] == 1 ? 1 : 2;
                $jenismhs = $value[2] == 1 ? 'Mahasiswa Baru' : 'Mahasiswa Lanjut';
                $deskripsi = $value[2] == 1 ?
                    'Pembayaran SPP & Daftar Semester ' . $datasemester->nama_semester :
                    'Pembayaran SPP Semester ' . $datasemester->nama_semester;

                try {
                    // Proses data mahasiswa
                    if ($jenis == 1) {
                        # code...
                        $data = pvmahasiswa::updateOrCreate(
                            [
                                'nodaftar' => $value[0],
                                'nik' => $value[12],
                                'va' => $value[1],
                            ],
                            [
                                'nama' => $this->fN($value[3]),
                                'jenis' => $jenis,
                                'status' => 1,
                                'fakultas' => $value[4],
                                'prodi' => $value[5],
                                'jenjang' => $value[6],
                                'jalur_masuk' => $value[7],
                                'angkatan' => $value[9],
                                'tagihan' => $value[8],
                                'semester' => $value[11],
                            ]
                        );
                    } else {
                        $data = pvmahasiswa::updateOrCreate(
                            [
                                'nim' => $value[0],
                                'nik' => $value[12],
                                'va' => $value[1],
                            ],
                            [
                                'nama' => $this->fN($value[3]),
                                'jenis' => $jenis,
                                'status' => 1,
                                'fakultas' => $value[4],
                                'prodi' => $value[5],
                                'jenjang' => $value[6],
                                'jalur_masuk' => $value[7],
                                'angkatan' => $value[9],
                                'tagihan' => $value[8],
                                'semester' => $value[11],
                            ]
                        );
                    }


                    if ($data) {
                        $expired = Carbon::now()->addMonths(3)->format('ymdHi');

                        // Proses tagihan
                        pvtagihan::updateOrCreate(
                            [
                                'idmhs' => $data->id,
                                'ref' => $value[0],
                                'va' => $data->va,
                                'gel' => $request->gel,
                                'periode' => $request->semester,
                            ],
                            [
                                'nama' => $data->nama,
                                'nik' => $data->nik,
                                'nodaftar' => $data->nodaftar,
                                'nim' => $data->nim,
                                'va' => $data->va,
                                'layanan' => $data->prodi,
                                'jenisbayar' => $jenismhs,
                                'kodejenisbayar' => $jenis,
                                'kodelayanan' => 100,
                                'tagihan' => $data->tagihan,
                                'totalbayar' => $data->tagihan,
                                'noid' => $data->id,
                                'flag' => 'F',
                                'angkatan' => $data->angkatan,
                                'description' => $deskripsi,
                                'statustagihan' => 1,
                                'statusbayar' => 0,
                                'expired' => $expired,
                                'reserve' => $data->jenjang,
                            ]
                        );
                    }
                } catch (\Exception $e) {
                    // Tangkap data yang gagal dan simpan ke pvproblems
                    $failedData[] = [
                        'nama' => $this->fN($value[3]) ?? null,
                        'nim' => $value[0] ?? null,
                        'va' => $value[1] ?? null,
                        'nik' => $value[12] ?? null,
                        'va' => $value[1] ?? null,
                        'data' => json_encode($value),
                        'error_message' => $e->getMessage(),

                    ];
                }
            }

            // Simpan semua data yang gagal sekaligus
            if (!empty($failedData)) {
                pvproblems::insert($failedData);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }

        return response()->json(['success' => 'Data saved successfully', 'failed' => $failedData], 200);
    }

    public function gelombang($periode, $gel)

    {
        $allperiode = pvsemester::with('mS')->get();
        $allgel = pvgel::where('kode_semester', $periode)->get();
        // return $allperiode;
        $dperiode = pvsemester::where('kode_semester', $periode)->first();
        $dgel = pvgel::where('kodegel', $gel)->first();
        $datava = pvtagihan::with('oB')->where(function ($q) {
            if (request()->input('statusbayarform')) {
                $q->where('statusbayar', request()->input('statusbayarform'));
            }
            if (request()->input('statustagihanform')) {
                $q->where('statustagihan', request()->input('statustagihanform'));
            }
        })->where('periode', $periode)->where('gel', $gel)->orderBy('created_at', 'DESC')->get();
        // return $datava;
        if (request()->ajax()) {
            return Datatables::of($datava)
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
        return view('va.tagihangel', compact('periode', 'gel', 'dperiode', 'dgel', 'allperiode', 'datava', 'allgel'));
    }
    public function pembayaran()
    {
        $aktif = pvsemester::where('status', 'Aktif')->first();
        if (request()->ajax()) {
            return Datatables::of(pvgel::with('mT', 'oS')->where('kode_semester', $aktif->kode_semester)->get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn = '';
                    // Cek status dan tentukan tombol yang sesuai
                    $btn .=
                        "<li class='list-inline-item'>
                      <a href='/admin/pv-pembayaran/" .
                        $data->kode_semester . "/" . $data->kodegel .
                        "' class='btn btn-sm btn-warning btn-xs mb-1'>Lihat Tagihan Mahasiswa Gelombang Ini </a>
                    </li>";


                    return $btn;
                })
                ->addColumn('totalnya', function ($data) {
                    $total = $data->mT->where('periode', $data->kode_semester)->count();
                    return $total;
                })
                ->addColumn('nama_semester', function ($data) {
                    $btn = $data->oS->nama_semester ?? '-';
                    return $btn;
                })
                ->rawColumns(['aksi', 'nama_semester'])
                ->make(true);
        }
        return view('va.pvgel', compact('aktif'));
    }
}
