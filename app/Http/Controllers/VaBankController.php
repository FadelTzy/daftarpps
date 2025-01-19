<?php

namespace App\Http\Controllers;

use App\Models\gel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\vaBank;
class VaBankController extends Controller
{
    public function deletebank($id)
    {
        vaBank::where('id', $id)->delete();
        return 'success';
    }
    public function bankstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return $request->all();
        $va = 0;
        $data = vaBank::create([
            'bank' => $request->bank,
            'c_bank' => $request->c_bank,
            'fak' => $request->fak,
            'c_fak' => $request->c_fak,
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function bank()
    {
        if (request()->ajax()) {
            return Datatables::of(vaBank::get())
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
               
                </ul>";
                    return $btn;
                })

                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('va.bank');
    }
    public function aktifasi($id)
    {
        gel::where('status', 1)->update([
            'status' => 2,
        ]);
        gel::where('id', $id)->update([
            'status' => 1,
        ]);
        return 'success';
    }
    public function gel()
    {
        // return gel::get();
        if (request()->ajax()) {
            return Datatables::of(gel::get())
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);
                    $btn =
                        "<ul class='list-inline mb-0'>
              
                    <li class='list-inline-item'>
                    <button type='button'  onclick='staffdel(" .
                        $data->id .
                        ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Aktifkan</button>
                    </li>
               
                </ul>";
                    return $btn;
                })

                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('va.gel');
    }
    public function gelstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'string', 'max:255'],
            'gel' => ['required', 'string', 'max:255', 'max:1', 'min:1'],
            'tahun' => ['required', 'string', 'max:10', 'min:4'],
            'semester' => ['required', 'string', 'max:1', 'min:1'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = explode('/', $request->tahun);
        $kodex = substr($data[0], 2, 2) . substr($data[1], 2, 2);
        if ($data[0] == '' || $data[1] == '') {
            return 'warning';
        }
        // return
        // return $request->all();
        $va = 0;
        if ($request->status == 1) {
            gel::where('status', 1)->update([
                'status' => 2,
            ]);
        }
        $data = gel::updateOrCreate(
            [
                'gelombang' => $request->gel,
                'tahun' => $request->tahun,
                'semester' => $request->tahun,
            ],
            [
                'status' => $request->status,
                'kode' => $kodex . $request->semester . $request->gel,
            ]);

        if ($data) {
            return 'success';
        }
    }
}
