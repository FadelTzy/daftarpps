<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Topik;
use Illuminate\Support\Facades\Validator;
class TopikController extends Controller
{
    public function topik()
    {
        if (request()->ajax()) {
            return Datatables::of(Topik::get())
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
                    } else {
                        $btn = '-';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.topik');
    }
    public function topikupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topik' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = topik::where('id', $request->id)->first();

        $data->topik = $request->topik;
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function topikstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topik' => ['required', 'string', 'max:255'],
           
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = topik::create([
            'topik' => $request->topik,
        
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function topikhapus($id)
    {
        $data = topik::where('id', $id)->delete();
        if ($data) {
            return 'success';
        }
    }
}
