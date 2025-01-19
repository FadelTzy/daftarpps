<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\gel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\vaBayar;
use Illuminate\Support\Facades\Http;


class reports implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $tgl_a;
    protected $tgl_r;

    public function view(): View
    {
    
        // $id = 'UNMPPS';
        // $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        // $secret = 'FP8aqyeYI9';
        // $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/report' . $this->tgl_a . '/' . $this->tgl_r;

        // $jsonBody = '{}';

        // $uni = $id . ':' . $jsonBody . ':' . $key;
        // $signature = hash_hmac('sha256', $uni, $secret);

   
        //     $response = Http::withHeaders([
        //         'content-type' => 'application/json',
        //         'id' => $id,
        //         'key' => $key,
        //         'signature' => $signature,
        //     ])->get($url, []);
            $dt = vaBayar::with('oU')->get();

            // return $response['data'];
            return view('admin.exportr', [
                'data' =>$dt
            ]);

    
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
