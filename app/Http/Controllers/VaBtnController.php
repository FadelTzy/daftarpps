<?php

namespace App\Http\Controllers;

use App\Models\gel;
use App\Models\vaBank;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\vaTagihan;
use App\Models\vaTahun;
use Illuminate\Support\Facades\Http;
class VaBtnController extends Controller
{
    public function index()
    {
        // return vaUser::with('oT')->get();
        $dt = vaTahun::where('status',1)->first();
        $gel = gel::where('status',1)->first();
        // return $gel;
        if ($gel) {
            $tahun = Date('Y');
            if (request()->ajax()) {
                return Datatables::of(vaTagihan::where('tahun_akademik',$dt->tahun ?? $tahun)->where('gel',$gel->gelombang)->get())
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn = "<ul class='list-inline mb-0'>";
    
                        if($data->status_b == 2){
      
                            $btn .=
                                "<li class='list-inline-item'>
                            <button type='button'  onclick='generatee(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Cek Pembayaran</button>
                            </li>";
                        }else{
    
                        }
                        $btn .=
                        "<li class='list-inline-item'>
                    <button type='button'  onclick='inquiryva(" .
                        $dataj .
                        ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
                    </li>";
                      
    
                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('vanya', function ($data) {
                        $dataj = json_encode($data);
                        // return $data->oT->va;
                        // return $data;
                        if ($data->va) {
                            $btn = '<span class="badge badge-primary"> <i>' . $data->va . '</i> </span>';
                        } else {
                            $btn = '-';
                        }
                        // if ($data->oT) {
                      
                        // } else {
                        //     $btn = '-';
                        // }
    
                        return $btn;
                    })
                    ->addColumn('statusnya', function ($data) {
                        $dataj = json_encode($data);
                        $btn = '';
                      
                            if ($data->status_b == 1) {
                                $btn .= '<span class="badge badge-primary"> Belum Terbayar </span>';
                            }
                            if ($data->status_b == 2) {
                                $btn .= '<span class="badge badge-success"> Terbayar </span>';
                            }
                 
    
                        return $btn;
                    })
    
                    ->rawColumns(['aksi', 'statusnya', 'vanya'])
                    ->make(true);
            }
            return view('va.pembayaran');
        }else{
            return 'Aktifkan Gelomabang';
        }
      
    }
}
