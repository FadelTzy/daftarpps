<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\vaTahun;
class vaTahunController extends Controller
{
    public function aktiftahun($id)
    {
        vaTahun::where('status','1')->update([
            'status' => 2
        ]);
        vaTahun::where('id',$id)->update([
            'status' => 1
        ]);
        return 'success';
    }
    public function deletetahun($id)
    {
        vaTahun::where('id',$id)->delete();
        return 'success';
    }
    public function tahunstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return $request->all();
        $data = vaTahun::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'desc' => $request->desc,
            'status' => 2,
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function tahun()
    {
        if (request()->ajax()) {
            return Datatables::of(vaTahun::get())
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
                    </li>
                    <li class='list-inline-item'>
                    <button type='button'  onclick='aktif(" .
                        $data->id .
                        ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Aktivasi</button>
                    </li>
                </ul>";
                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 1) {
                        $btn = '<span class="badge badge-primary"> Aktif </span>';
                    }else{
                        $btn = '<span class="badge badge-danger"> Non Aktif </span>';

                    }
                    return $btn;
                })
             

                ->rawColumns(['aksi','statusnya'])
                ->make(true);
        }
        return view('va.tahun');
    }
}
