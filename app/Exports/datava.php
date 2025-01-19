<?php

namespace App\Exports;
use App\Models\vaTahun;
use App\Models\vaTagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\gel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\FromView;
class datava implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }
    public function view(): View
    {
        $gel = gel::where('status',1)->first();
        $tahun = vaTahun::where('status',1)->first();
        if ($this->id == 2) {
            return view('admin.exportb', [
                'data' =>vaTagihan::where('status_b',2)->where('gel',$gel->gelombang)->where('tahun_akademik',$tahun->tahun)->with('oB','oU')->get()
            ]);
        }else{
            return view('admin.export', [
                'data' =>vaTagihan::with('oB','oU')->where('gel',$gel->gelombang)->where('tahun_akademik',$tahun->tahun)->get()
            ]);
        }
    
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
