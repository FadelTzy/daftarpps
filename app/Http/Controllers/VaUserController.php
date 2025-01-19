<?php

namespace App\Http\Controllers;

use App\Models\vaTagihan;
use App\Models\vaTahun;
use Illuminate\Http\Request;
use App\Models\vaUser;
use Carbon\Carbon;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Imports\vauser as im;
use App\Models\bayarpps;
use App\Models\daftarmhs;
use App\Models\gel;
use App\Models\kt;
use App\Models\ppsmhs;
use Maatwebsite\Excel\Facades\Excel;
class VaUserController extends Controller
{
    public function deleteuser($id)
    {
        vaUser::where('id', $id)->delete();
        return 'success';
    }
    public function mahasiswaupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],

            'nim' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $dt = vaTahun::where('status', 1)->first();

        $data = vaUser::where('id', $request->id)->first();
        $data->nama = $request->nama;
        $data->nim = $request->nim;
        $data->tagihan = $request->tagihan;
        $data->save();

        // $tagihan = vaTagihan::where('iduser',$data->id)->first();

        if ($data) {
            return 'success';
        }
    }
    public function importdataupd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],

            'nim' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // $dt = vaTahun::where('status', 1)->first();
        $d = ppsmhs::where('id',$request->id)->first();
        if ($d) {
            # code...
            $d->periode = $request->periode;
            $d->jenis = $request->jenis;
            $d->nama = $request->nama;
            $d->ukt = $request->tagihan;
            $d->save();

            $x = bayarpps::where('noid',$request->id)->first();
            $x->tagihan = $request->tagihan;
            $x->periode = $request->periode;
            $x->nama = $request->nama;
            $x->description = $request->deskripsi;
            $x->save();
        }

        // $tagihan = vaTagihan::where('iduser',$data->id)->first();

        if ($d) {
            return 'success';
        }
    }
    public function mahasiswaimport(Request $request)
    {
        // return 1;
        $validator = Validator::make($request->all(), [
            'file' => ['required'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        try {
            $array = Excel::toCollection(new im(), request()->file('file'));
            // return $array;
            $dt = vaTahun::where('status', 1)->first();

            foreach ($array[0] as $key => $value) {
                $b[] = substr($value[1], 5);
                $pjg = strlen(substr($value[1], 5));
                $length[] = $pjg;

                $sisa = 12 - $pjg;
                $nol = '';
                for ($i = 0; $i < $sisa; $i++) {
                    $nol .= '0';
                }
                $nim = $nol . substr($value[1], 5);
                // return $nim;
                // $data = kt::create([
                //     'va' => $nim,
                //     'pendaftaran' => $value[1],
                // ]);
                $data = vaUser::create([
                    'nama' => $value[0],
                    'nim' => $value[2],
                    'tagihan' => $value[4],
                    'prodi' => $value[5],
                    'c_prodi' => $value[6],
                    'fak' => $value[7],
                    'c_fak' => '01',
                    'tahun' => $dt->tahun,
                    'c_jur' => $value[1],
                    'tglakhir' => $value[9],
                    'jenis' => $value[10],
                    'gel' => $value[11],
                    'nimasli' => $value[8],
                ]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

        // return $nim;
        // (new im)->import('users.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);

        return 'adaji';

        if ($data) {
            return 'success';
        }
    }
    public function fN($name) {
        // Pola ekspresi reguler yang diperbarui
        $pattern = "/[,'`:;@#$]+/";
    
        // Ganti karakter khusus dengan string kosong
        $filteredName = preg_replace($pattern, '', $name);
    
        return $filteredName;
    }
    public function importmhspps(Request $request)
    {
        // return 1;
        $validator = Validator::make($request->all(), [
            'file' => ['required'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $array = Excel::toCollection(new im(), request()->file('file'));
        // DB::beginTransaction();

        try {
            // return $array;
            // $dt = vaTahun::where('status', 1)->first();

            foreach ($array[0] as $key => $value) {
                if ($key == 0) {
                    continue;
                } else {
                 
                    $cek = bayarpps::where('gel', $value[10])
                        ->where('ref', $value[1])
                        ->where('va', $value[2])
                        ->where('statusbayar', 1)

                        ->first();
                    if ($cek) {
                        # code...
                    } else {
                        $data = ppsmhs::updateOrCreate(
                            [
                                'nim' => $value[1],
                                'jenis' => $value[3],
                                'gel_buka' => $value[10],
                                'va' => $value[2],
                            ],
                            [
                                'no_daftar' => $value[0],
                                'nama' => $this->fN($value[4]),
                                'fakultas' => $value[5],
                                'prodi' => $value[6],
                                'jenjang' => $value[7],
                                'jalur_masuk' => $value[8],
                                'ukt' => $value[9],
                                'angkatan' => $value[11],
                                'periode' => $value[12],
                            ],
                        );
                        if ($data) {
                            $datar = daftarmhs::updateOrCreate(
                                [
                                    'nim' => $value[1],
                                    'angkatan' => $value[11],

                                ],
                                [
                                    'no_daftar' => $value[0],
                                    'jenis' => $value[3],

                                    'nama' => $this->fN($value[4]),
                                    'fakultas' => $value[5],
                                    'prodi' => $value[6],
                                    'jenjang' => $value[7],
                                    'jalur_masuk' => $value[8],

                                ],
                            );
                            // Mendapatkan tanggal hari ini
                            $today = Carbon::now();

                            // Menambah 3 bulan ke tanggal hari ini
                            $dateIn3Months = $today->addMonths(3);

                            // Mengubah tanggal ke dalam format yymmddHHMM
                            $expired = $dateIn3Months->format('ymdHi');
                            $xx = bayarpps::updateOrCreate(
                                [
                                    'idppsmhs' => $data->id,
                                    'ref' => $data->nim,
                                    'va' => $data->va,
                                    'gel' => $value[10],
                                ],
                                [
                                    'nama' => $this->fN($data->nama),
                                    'layanan' => $data->jenis == 1 ? 'MAHASISWA BARU' : 'MAHASISWA LANJUT',
                                    'kodelayanan' => $data->jenis,
                                    'tagihan' => $data->ukt,
                                    'totalbayar' => $data->ukt,
                                    'noid' => $data->id,
                                    'flag' => 'F',
                                    'angkatan' => $data->angkatan,
                                    'periode' => $data->periode,
                                    'description' => $value[13],
                                    'statusbayar' => null,
                                    'expired' => $expired,
                                ],
                            );
                        }
                    }
                }
            }
            // DB::commit();
        } catch (\Throwable $th) {
            // DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }

        // return $nim;
        // (new im)->import('users.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);

        return response()->json(['success' => 'Data saved successfully'], 200);

        if ($data) {
            return 'success';
        }
    }
    public function mahasiswastore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'fak' => ['required', 'string', 'max:255'],
            'tagihan' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $dt = vaTahun::where('status', 1)->first();
        $data = vaUser::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'fak' => $request->fak,
            'c_fak' => $request->c_fak,
            'tahun' => $dt->tahun,
            'c_prodi' => $dt->desc,
            'tagihan' => $request->tagihan,
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function mahasiswa()
    {
        // return 1;
        $dt = vaTahun::where('status', 1)->first();
        $gel = gel::where('status', 1)->first();
        // return $gel;
        if ($gel) {
            $tahun = Date('Y');
            // return $tahun;
            // return vaUser::with('oT')->where('tahun',$dt->tahun ?? $tahun)->get();
            if (request()->ajax()) {
                return Datatables::of(
                    vaUser::with('oT')
                        ->where('tahun', $dt->tahun ?? $tahun)
                        ->where('gel', $gel->kode)
                        ->get(),
                )
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn =
                            "<ul class='list-inline mb-0'>
                    <li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" .
                            $dataj .
                            ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit</button>
                    </li>
                        <li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Hapus</button>
                        </li>";
                        if ($data->oT) {
                            $btn .=
                                " <li class='list-inline-item'>
                            <button type='button'  onclick='generateu(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Update VA</button>
                            </li>";
                        } else {
                            $btn .=
                                " <li class='list-inline-item'>
                            <button type='button'  onclick='generate(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Generate VA</button>
                            </li>";
                        }

                        $btn .= '</ul>';
                        return $btn;
                    })

                    ->rawColumns(['aksi'])
                    ->make(true);
            }
            return view('va.user');
        } else {
            return 'aktifkan';
        }
    }
    public function importdata()
    {
        // return 1;
        $gel = gel::where('status', 1)->first();
        // return $gel;
        if ($gel) {
            // return $tahun;
            // return vaUser::with('oT')->where('tahun',$dt->tahun ?? $tahun)->get();
            if (request()->ajax()) {
                return Datatables::of(ppsmhs::with('oB')->where('gel_buka', $gel->kode)->get())
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn =
                            "<ul class='list-inline mb-0'>
                    <li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" .
                            $dataj .
                            ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit</button>
                    </li>
                        <li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Hapus</button>
                        </li>";
          

                        $btn .= '</ul>';
                        return $btn;
                    })

                    ->rawColumns(['aksi'])
                    ->make(true);
            }
            return view('va.importdata');
        } else {
            return 'aktifkan';
        }
    }
    public function mhspps()
    {
        // return 1;
        $dt = vaTahun::where('status', 1)->first();
        $gel = gel::where('status', 1)->first();
        // return $gel;
        if ($gel) {
            $tahun = Date('Y');
            // return $tahun;
            // return vaUser::with('oT')->where('tahun',$dt->tahun ?? $tahun)->get();
            if (request()->ajax()) {
                return Datatables::of(daftarmhs::get())
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn =
                            "<ul class='list-inline mb-0'>
                    <li class='list-inline-item'>
                    <button type='button' data-toggle='modal' onclick='staffupd(" .
                            $dataj .
                            ")'   class='btn btn-sm btn-success btn-xs mb-1'>Edit</button>
                    </li>
                        <li class='list-inline-item'>
                        <button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Hapus</button>
                        </li>";
                        $btn .=
                                " <li class='list-inline-item'>
                            <button type='button'  onclick='lihattagihan(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Lihat Tagihan</button>
                            </li>";

                        $btn .= '</ul>';
                        return $btn;
                    })

                    ->rawColumns(['aksi'])
                    ->make(true);
            }
            return view('va.mhspps');
        } else {
            return 'aktifkan';
        }
    }
}
