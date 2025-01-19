<?php

namespace App\Http\Controllers;

use App\Models\batasPelanggaran;
use Illuminate\Http\Request;
use App\Models\pelanggaran;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\pelanggaranSiswa;
use App\Models\RiwayatQuiz;
use Illuminate\Support\Facades\DB;
class PelanggaranController extends Controller
{
    public function pesireset($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->poin = 0;
            pelanggaranSiswa::where('id_siswa', $user->id)->delete();
            RiwayatQuiz::where('id_user', $user->id)->delete();
            $user->save();
            return 'success';
        }
        return 'danger';
    }
    public function siswa($id)
    {
        $user = User::where('id', $id)->first();
        $data = pelanggaran::get();
        $pt = RiwayatQuiz::where('id_user', $id)
            ->orderBy('poin', 'DESC')
            ->first();
        if ($pt) {
            $bp = batasPelanggaran::where('poin', '>', $pt->poin)
                ->orderBy('poin', 'ASC')
                ->first();
        } else {
            $bp = batasPelanggaran::select('*')
                ->orderBy('poin', 'ASC')
                ->first();
        }
        // return $bp;
        if (request()->ajax()) {
            return Datatables::of(
                pelanggaranSiswa::with('oLanggar', 'oUser')
                    ->where('id_siswa', $id)
                    ->latest()
                    ->get(),
            )
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                    
              
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-xs mb-1'>Batalkan</button>
                    </li>
                     
                </ul>";
                if (Auth::user()->role == 2) {
                    return '-';
                }
                    return $btn;
                })
                ->addColumn('namalanggar', function ($data) {
                    if ($data->oLanggar->level == 1) {
                        $btn = '<span class="badge badge-primary">  Ringan </span>';
                    }
                    if ($data->oLanggar->level == 2) {
                        $btn = '<span class="badge badge-warning">  Sedang </span>';
                    }
                    if ($data->oLanggar->level == 3) {
                        $btn = '<span class="badge badge-danger">  Berat </span>';
                    }
                    $btn .= $data->oLanggar->pelanggaran;
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->created_at->format('d - m - Y');
                    return $btn;
                })
                ->addColumn('tindaklanjutnya', function ($data) {
                    $btn = $data->oLanggar->tindaklanjut;
                    return $btn;
                })
                ->rawColumns(['aksi', 'namalanggar'])
                ->make(true);
        }
        return view('admin.pelanggaran.siswa', compact('user', 'data', 'pt', 'bp'));
    }
    public function pesi()
    {
        if (Auth::user()->role == 3) {
            $t = User::with('oSanksi')
                ->where('role', 2)
                ->where('id_guru', Auth::user()->id)
                ->get();
        } else {
            $t = User::with('oSanksi')
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
                        url('admin/data-pelanggaran/') .
                        '/' .
                        $data->id .
                        "'  class='btn btn-danger btn-xs mb-1'>Riwayat Pelanggaran</a>

                </li>
                <li class='list-inline-item'>
                <a type='button' href='" .
                        url('admin/data-sanksi/') .
                        '/' .
                        $data->id .
                        "'  class='btn btn-danger btn-xs mb-1'>Riwayat Sanksi</a>
                   ";
                    if (Auth::user()->role == 1) {
                        $btn .=
                            "</li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                            $data->id .
                            ")'   class='btn btn-primary btn-xs mb-1'>Reset</button>
                    </li>";
                    }

                    $btn .= '</ul>';
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
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.pelanggaran.index');
    }
    public function pelanggaranupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sanksi' => ['required', 'string', 'max:255'],
            'poin' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = pelanggaran::where('id', $request->id)->first();
        $data->poin = $request->poin;
        $data->level = $request->level;

        $data->tindaklanjut = $request->sanksi;
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function pelanggaranstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => ['required', 'string', 'max:255'],
            'poin' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = pelanggaran::create([
            'pelanggaran' => $request->jenis,
            'poin' => $request->poin,
            'level' => $request->level,
            'tindaklanjut' => $request->tindaklanjut,
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function pelanggaranhapus($id)
    {
        $data = pelanggaran::where('id', $id)->delete();
        if ($data) {
            return 'success';
        }
    }
    public function pelanggaran()
    {
        if (request()->ajax()) {
            return Datatables::of(pelanggaran::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    if (Auth::user()->role == 1) {
                        $btn =
                        "<ul class='list-inline mb-0'>
                    
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='staffupd(" .
                        $dataj .
                        ")'   class='btn btn-success btn-xs mb-1'>Edit</button>
                </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-danger btn-xs mb-1'>Hapus</button>
                    </li>
                     
                </ul>";
                    }else{
                        $btn = '-';
                    }
                  
                    return $btn;
                })
                ->addColumn('levelnya', function ($data) {
                    if ($data->level == 1) {
                        $btn = "<span class='badge badge-info'> Ringan </span>";
                    }
                    if ($data->level == 2) {
                        $btn = "<span class='badge badge-warning'> Sedang </span>";
                    }
                    if ($data->level == 3) {
                        $btn = "<span class='badge badge-danger'> Berat </span>";
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'levelnya'])
                ->make(true);
        }
        return view('admin.pelanggaran');
    }
}
