<?php

namespace App\Http\Controllers;
use App\Models\pelanggaran;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\batasPelanggaran;
use App\Models\RiwayatQuiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BatasPelanggaranController extends Controller
{   
    public function verif($id)
    {
        $data = RiwayatQuiz::where('id',$id)->first();
        if ($data) {
            $data->status = 1;
            $data->save();
            return 'success';
        }else{
            return 'error';
        }
     
    }
    public function siswa($id)
    {
        $user = User::where('id',$id)->first();
    
        // return $bp;
        if (request()->ajax()) {
            return Datatables::of(RiwayatQuiz::where('id_user',$id)->latest()->get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
                    
              
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-primary btn-xs mb-1'>Setujui</button>
                    </li>
                     
                </ul>";
                if (Auth::user()->role == 2) {
                    return '-';
                }
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->created_at->format('d - m - Y');
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 0) {
                        $btn = "<span class='badge bg-danger'>Belum disetujui</span>";
                    }else{
                        $btn = "<span class='badge bg-success'>Disetujui</span>";

                    }
                    return $btn;
                })
                ->rawColumns(['aksi','statusnya'])
                ->make(true);
        }
        return view('admin.pelanggaran.sanksi',compact('user'));
    }
    public function bpelanggaranupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sanksi' => ['required', 'string', 'max:255'],
            'poin' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = batasPelanggaran::where('id',$request->id)->first();
        $data->poin = $request->poin;
        $data->tindaklanjut = $request->sanksi;
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function bpelanggaranstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sanksi' => ['required', 'string', 'max:255'],
            'poin' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = batasPelanggaran::create([
            'tindaklanjut' => $request->sanksi,
            'poin' => $request->poin,

        ]);

        if ($data) {
            return 'success';
        }
    }
    public function bpelanggaranhapus($id)
    {
        $data = batasPelanggaran::where('id', $id)->delete();
        if ($data) {
            return 'success';
        }
    }
    public function bpelanggaran()
    {
        if (request()->ajax()) {
            return Datatables::of(batasPelanggaran::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
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
                if (Auth::user()->role == 1) {
                    # code...
                    return $btn;
                }else{
                    return '-';
                }
                })
                ->rawColumns(['aksi', 'levelnya'])
                ->make(true);
        }
        return view('admin.bpelanggaran');
    }
}
