<?php

namespace App\Http\Controllers;

use App\Models\konsultasiSiswa;
use App\Models\pesan;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Models\pelanggaranSiswa;
use App\Models\RiwayatQuiz;
use App\Models\Topik;

class KonsultasiSiswaController extends Controller
{
    public function qrcodesiswa($id)
    {
        $ps = pelanggaranSiswa::with('oLanggar')
            ->where('id_siswa', $id)
            ->latest()
            ->sum('poinpelanggaran');
        $pl = 0;
        $kl = 0;
        $sk = 0;
        if (Auth::user()->role == 2) {
            $pl = pelanggaranSiswa::where('id_siswa', $id)->count();
            $kl = konsultasiSiswa::where('id_siswa', $id)->count();
            $sk = RiwayatQuiz::where('id_user', $id)->count();

        }
        $data = User::with('oBk')
            ->where('id', $id)
            ->first();
        $qrs = 'https://bk.antangdev.site/reporting/' . $data->id;
        return view('admin.qrs', compact('data', 'ps', 'pl','kl','sk','qrs'));
    }
    public function qrcode()
    {
        if (Auth::user()->role == 1) {
            $t = User::where('role', 2)->get();
        } else {
            $t = User::where('role', 2)
                ->where('id_guru', Auth::user()->id)
                ->get();
        }
        $guru = User::where('role', 3)->get();
        if (request()->ajax()) {
            return Datatables::of($t)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $btn =
                        "<ul class='list-inline mb-0'>
                    
                <li class='list-inline-item'>
                <a type='button' target='_blank' href='" .
                        url('admin/qr-code/') .
                        '/' .
                        $data->id .
                        "'  class='btn btn-sm btn-info btn-xs mb-1'>Generate Code</a>

                </li>
                 
                     
                </ul>";
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.qr', compact('guru'));
    }
    public function konsulpesan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idsiswa' => ['required', 'string', 'max:255'],
            'idkonsul' => ['required', 'string', 'max:255'],
            'pesan' => ['string'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $data = pesan::create([
            'id_konsultasi' => $request->idkonsul,
            'id_user' => $request->idsiswa,
            'id_balasan' => null,
            'pesan' => $request->pesan,
        ]);

        if ($data) {
            return ['status' => 'success'];
        }
    }
    public function konsulstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'iduser' => ['required', 'string', 'max:255'],
            'idguru' => ['required', 'string', 'max:255'],
            'judul' => ['string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = konsultasiSiswa::create([
            'id_siswa' => $request->iduser,
            'id_guru' => $request->idguru,
            'judul' => $request->judul,
            'status' => 1,
        ]);
        pesan::create([
            'id_konsultasi' => $data->id,
            'id_user' => $request->iduser,
            'id_balasan' => null,
            'pesan' => $request->pesan,
        ]);

        if ($data) {
            return ['status' => 'success', 'id' => $data->id];
        }
    }
    public function konsul()
    {
        // return Auth::user();
        if (Auth::user()->role == 3) {
            $t = User::with('oSanksi', 'oBk', 'oKonsul')
                ->where('role', 2)
                ->where('id_guru', Auth::user()->id)
                ->get();
        } else {
            $t = User::with('oSanksi', 'oBk', 'oKonsul')
                ->where('role', 2)
                ->get();
        }

        if (request()->ajax()) {
            return Datatables::of($t)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                    
                <li class='list-inline-item'>
                <a type='button' href='" .
                        url('admin/konsultasi-siswa/') .
                        '/' .
                        $data->id .
                        "'  class='btn btn-primary btn-xs mb-1'>Riwayat Konsultasi</a>

                </li>
         
                     
                </ul>";
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->oSanksi) {
                        $btn = 'Sanksi Terbaru, Poin : ' . $data->oSanksi->poin . ' Tindak Lanjut : ' . $data->oSanksi->tindaklanjut;
                    } else {
                        $btn = 'Belum Ada Sanksi';
                    }
                    return $btn;
                })
                ->addColumn('gurunya', function ($data) {
                    $btn = $data->oBk->name ?? '-';
                    return $btn;
                })
                ->addColumn('tk', function ($data) {
                    $btn = $data->oKonsul->count();
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.konsultasi.index');
    }
    public function pesansiswa($id)
    {
        $datakonsul = konsultasiSiswa::with('oSiswa', 'oGuru')
            ->where('id', $id)
            ->first();
        $pesan = pesan::with('oUser')
            ->where('id_konsultasi', $id)
            ->get();
        // return $pesan;
        return view('admin.konsultasi.pesan', compact('datakonsul', 'pesan'));
    }
    public function konsulsiswa($id)
    {
        $user = User::with('oBk')
            ->where('id', $id)
            ->first();
        $topik = Topik::get();
        if (request()->ajax()) {
            return Datatables::of(
                konsultasiSiswa::with('mPesan')
                    ->where('id_siswa', $id)
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);

                    if (Auth::user()->role == 2) {
                        $btn =
                            "<ul class='list-inline mb-0'>
                
            <li class='list-inline-item'>
            <a type='button' href='" .
                            url('siswa/konsultasi-pesan/') .
                            '/' .
                            $data->id .
                            "'  class='btn btn-primary btn-xs mb-1'>Pesan</a>

            </li>
     
                 
            </ul>";
                    } else {
                        $btn =
                            "<ul class='list-inline mb-0'>
                
            <li class='list-inline-item'>
            <a type='button' href='" .
                            url('admin/konsultasi-pesan/') .
                            '/' .
                            $data->id .
                            "'  class='btn btn-primary btn-xs mb-1'>Pesan</a>

            </li>
     
                 
            </ul>";
                    }
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 1) {
                        $btn = ' Proses ';
                    } else {
                        $btn = 'Selesai';
                    }
                    return $btn;
                })
                ->addColumn('pesannya', function ($data) {
                    $btn = $data->mPesan->count();
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.konsultasi.siswa', compact('user','topik'));
    }
}
