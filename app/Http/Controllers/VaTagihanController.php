<?php

namespace App\Http\Controllers;

use App\Models\vaBank;
use App\Models\vaBayar;
use carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\vaTagihan;
use App\Models\vaTahun;
use App\Models\vaUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\datava;
use App\Exports\reports;
use App\Models\bayarpps;
use App\Models\gel;
use App\Models\ppsmhs;
use App\Models\pvrespon;
use App\Models\pvtagihan;

class VaTagihanController extends Controller
{
    public function ex()
    {
        $tahun = vaTahun::where('status', 1)->first();
        if ($tahun) {
            $data = vaTagihan::with('oB')
                ->where('tahun_akademik', $tahun->tahun)
                ->get();
        }
        return Excel::download(new datava(1), 'invoices.xlsx');

        // return Excel::download(new datava, 'pembayaran.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        return 'wew';
    }
    public function exb()
    {
        $tahun = vaTahun::where('status', 1)->first();
        if ($tahun) {
            $data = vaTagihan::with('oB')
                ->where('tahun_akademik', $tahun->tahun)
                ->get();
        }
        return Excel::download(new datava(2), 'terbayar.xlsx');

        // return Excel::download(new datava, 'pembayaran.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        return 'wew';
    }
    public function check()
    {
        $d = vaTagihan::select('va')->selectRaw('count(va) as qty')->groupBy('va')->orderBy('qty', 'DESC')->get();
        return $d;
        $arr = vaTagihan::get();
        $arr2 = $arr->unique('va');
        $usersDupes = $arr->diff($arr2);
        return $usersDupes;
    }
    public function changeva(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255'],
            'noref' => ['required', 'string', 'max:255'],
            'va' => ['required', 'string', 'max:17', 'min:17'],
            'tagihan' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $ch = vaTagihan::where('id', $request->id)->first();
        if ($ch->status_b == 1) {
            $vau = vaUser::where('id', $ch->iduser)->first();
            $vau->tagihan = $request->tagihan;
            $vau->save();
            $ch->tagihan = $request->tagihan;
            $ch->no_ref = $request->noref;
            $ch->va = $request->va;
            $ch->save();
        } else {
            return ['status' => 'error'];
        }

        // $data = vaUser::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'fak' => $request->fak,
        //     'c_fak' => $request->c_fak,
        //     'tahun' => $dt->tahun,
        //     'c_prodi' => $dt->desc,
        //     'tagihan' => $request->tagihan,
        // ]);

        if ($ch) {
            return 'success';
        }
    }
    public function gettotal()
    {
        $gel = gel::where('status', 1)->first();
        $users = DB::table('va_users')
            ->leftJoin('va_tagihans', 'va_users.id', '=', 'va_tagihans.iduser')
            ->select('va_users.*', 'va_tagihans.va')
            ->where('va_tagihans.va', null)
            ->where('va_users.gel', $gel->kode)
            ->get();
        $cbank = '5941';
        foreach ($users as $key => $value) {
            $prefix = 9;
            $kode = $cbank;
            $nim = $value->nim;
            $va = $prefix . $kode . $nim;

            $data = vaTagihan::updateOrCreate(
                [
                    'iduser' => $value->id,
                ],
                [
                    'nama' => $value->nama,
                    'nim' => $value->nim,
                    'fakultas' => $value->fak,
                    'c_fak' => $value->c_fak,
                    'tahun_akademik' => $value->tahun,
                    'tagihan' => $value->tagihan,
                    'bank' => 'BTN',
                    'c_bank' => $cbank,
                    'status' => 0,
                    'status_b' => 1,
                    'no_ref' => $value->nim,
                    'va' => $value->c_jur,
                    'gel' => $gel->kode,
                ],
            );
        }
        return ['data' => $users, 'total' => count($users), 'status' => 'success'];
        // return $users;
    }
    public function pvcreatesavebayar($r, $id)
    {
        $ok = pvrespon::create([
            'ref' => $r['ref'],
            'va' => $r['va'],
            'nama' => $r['nama'],
            'teller' => $r['teller'],
            'transcode' => $r['transcode'],
            'seq' => $r['seq'],
            'tgl' => $r['tgl'],
            'jam' => $r['jam'],
            'amount' => $r['amount'],
            'revflag' => $r['revflag'],
            'revseq' => $r['revseq'],
            'revjam' => $r['revjam'],
            'tagihan' => $r['tagihan'],
            'terbayar' => $r['terbayar'],
            'idtagihan' => $id,
        ]);
        if ($ok) {
            return 1;
        } else {
            return 0;
        }
        return $r;
    }
    public function createsavebayar($r, $id)
    {
        $ok = vaBayar::create([
            'ref' => $r['ref'],
            'va' => $r['va'],
            'nama' => $r['nama'],
            'teller' => $r['teller'],
            'transcode' => $r['transcode'],
            'seq' => $r['seq'],
            'tgl' => $r['tgl'],
            'jam' => $r['jam'],
            'amount' => $r['amount'],
            'revflag' => $r['revflag'],
            'revseq' => $r['revseq'],
            'revjam' => $r['revjam'],
            'tagihan' => $r['tagihan'],
            'terbayar' => $r['terbayar'],
            'id_tagihan' => $id,
        ]);
        if ($ok) {
            return 1;
        } else {
            return 0;
        }
        return $r;
    }
    public function csb($r, $id, $gel)
    {
        // return $r;

        $ok = vaBayar::updateOrCreate(
            [
                'gel' => $gel,
                'ref' => $r->ref ?? null,
                'va' => $r->va ?? null,
                'id_tagihan' => $id,


            ],
            [
                'nama' => $r->nama ?? null,
                'teller' => $r->teller ?? null,
                'transcode' => $r->transcode ?? null,
                'seq' => $r->seq ?? null,
                'tgl' => $r->tgl ?? null,
                'jam' => $r->jam ?? null,
                'amount' => $r->amount ?? null,
                'revflag' => $r->revflag ?? null,
                'revseq' => $r->revseq ?? null,
                'revjam' => $r->revjam ?? null,
                'tagihan' => $r->tagihan ?? null,
                'terbayar' => $r->terbayar ?? null,
            ]
        );
    }
    public function pvcsb($r, $id, $gel)
    {
        // return $r;
        $cek = pvtagihan::where('id', $id)->first();
        $cek->statusbayar = 1;
        $cek->save();

        $ok = pvrespon::updateOrCreate(
            [
                'idtagihan' => $id,
                'ref' => $r->ref ?? null,
                'va' => $r->va ?? null,


            ],
            [
                'nama' => $r->nama ?? null,
                'teller' => $r->teller ?? null,
                'transcode' => $r->transcode ?? null,
                'seq' => $r->seq ?? null,
                'tgl' => $r->tgl ?? null,
                'jam' => $r->jam ?? null,
                'amount' => $r->amount ?? null,
                'revflag' => $r->revflag ?? null,
                'revseq' => $r->revseq ?? null,
                'revjam' => $r->revjam ?? null,
                'tagihan' => $r->tagihan ?? null,
                'terbayar' => $r->terbayar ?? null,
            ]
        );
    }
    public function pvcallback(Request $request)
    {
        $header = $request->header('Authorization');
        // return $header;
        if ($header == 'frRQAe0JVT7YtpTYD9ih') {
            // return $this->createsavebayar($request->all());

            // return $request->all();
            $data = pvtagihan::where('id', $request->noid)->first();
            if ($data) {
                $data->statusbayar = 2;
                $checking = pvrespon::where('idtagihan', $data->id)->first();
                if ($checking) {
                    return response()->json(['rsp' => '001', 'rspdesc' => 'Data Telah Terinput']);
                } else {
                    $wew = $this->pvcreatesavebayar($request->all(), $data->id);
                    if ($wew == 1) {
                        $data->save();
                        return response()->json(['rsp' => '000', 'rspdesc' => 'Transaction Success.']);
                    } else {
                        return response()->json(['rsp' => '001', 'rspdesc' => 'Gagal Menginput Data']);
                    }
                }

                # code...
            } else {
                return response()->json(['rsp' => '001', 'rspdesc' => 'Data Tidak Ditemukan']);
            }
        } else {
            return response()->json(['rsp' => '001', 'rspdesc' => 'Autentikasi Salah']);
        }

        return $request->all();
        return 'hehe';
    }
    public function callback(Request $request)
    {
        $header = $request->header('Authorization');
        // return $header;
        if ($header == 'frRQAe0JVT7YtpTYD9ih') {
            // return $this->createsavebayar($request->all());

            // return $request->all();
            $data = vaTagihan::where('va', $request->va)->first();
            if ($data) {
                $data->status_b = 2;
                $checking = vaBayar::where('id_tagihan', $data->id)->first();
                if ($checking) {
                    return response()->json(['rsp' => '001', 'rspdesc' => 'Data Telah Terinput']);
                } else {
                    $wew = $this->createsavebayar($request->all(), $data->id);
                    if ($wew == 1) {
                        $data->save();
                        return response()->json(['rsp' => '000', 'rspdesc' => 'Transaction Success.']);
                    } else {
                        return response()->json(['rsp' => '001', 'rspdesc' => 'Gagal Menginput Data']);
                    }
                }

                # code...
            } else {
                return response()->json(['rsp' => '001', 'rspdesc' => 'Data Tidak Ditemukan']);
            }
        } else {
            return response()->json(['rsp' => '001', 'rspdesc' => 'Autentikasi Salah']);
        }

        return $request->all();
        return 'hehe';
    }
    public function deleteuser($id)
    {
        vaTagihan::where('id', $id)->delete();
        return 'success';
    }
    public function cekbayar(Request $request)
    {
        // return $request->id;
        $cek = vaBayar::where('id_tagihan', $request->id)->first();

        if ($cek) {
            return ['status' => 'success', 'message' => $cek];
        } else {
            return ['status' => 'fail', 'message' => 'data tidak ditemukan'];
        }
        // $data = vaTagihan::updateOrCreate(
        //     [
        //         'iduser' => $request->id,
        //     ],
        //     [
        //         'nama' => $request->nama,
        //         'nim' => $request->nim,
        //         'fakultas' => $request->fak,
        //         'c_fak' => $request->c_fak,
        //         'tahun_akademik' => $request->tahun,
        //         'tagihan' => $request->tagihan,
        //         'bank' => $databank->bank,
        //         'c_bank' => $databank->c_bank,
        //         'status' => 0,
        //         'status_b' => 1,
        //         'no_ref' => $request->nim,
        //         'va' => $va,
        //     ],
        // );

        // if ($data) {
        //     return 'success';
        // }
    }
    public function vastore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return $request->all();
        $datacfak = $request->c_fak;
        $databank = vaBank::where('c_fak', $datacfak)->first();

        $va = 0;
        // return $request->all();
        if ($databank->c_bank == '5941') {
            $prefix = 9;
            $kode = $databank->c_bank;
            $nim = $request->nim;
            $va = $prefix . $kode . $nim;
        }
        $data = vaTagihan::updateOrCreate(
            [
                'iduser' => $request->id,
            ],
            [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'fakultas' => $request->fak,
                'c_fak' => $request->c_fak,
                'tahun_akademik' => $request->tahun,
                'tagihan' => $request->tagihan,
                'bank' => $databank->bank,
                'c_bank' => $databank->c_bank,
                'status' => 0,
                'status_b' => 1,
                'no_ref' => $request->nim,
                'va' => $va,
            ],
        );

        if ($data) {
            return 'success';
        }
    }
    public function vaustore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // return $request->all();
        $datacfak = $request->c_fak;
        $databank = vaBank::where('c_fak', $datacfak)->first();

        $va = 0;
        if ($databank->c_bank == '5941') {
            $prefix = 9;
            $kode = $databank->c_bank;
            $nim = $request->nim;
            $va = $prefix . $kode . $nim;
        }

        // return $this->deleteva($request, $va);

        $data = vaTagihan::updateOrCreate(
            [
                'iduser' => $request->id,
            ],
            [
                'nama' => $request->nama,
                'nim' => $request->nim,

                'fakultas' => $request->fak,
                'c_fak' => $request->c_fak,
                'tahun_akademik' => $request->tahun,
                'tagihan' => $request->tagihan,
                'bank' => $databank->bank,
                'c_bank' => $databank->c_bank,
                'status' => 1,
                'status_b' => 1,
                'no_ref' => $request->nim,
                'va' => $va,
            ],
        );

        if ($data) {
            return 'success';
        }
    }
    public function proses(Request $request)
    {
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $datacfak = $request->id['c_fak'];
        $databank = vaBank::where('c_fak', $datacfak)->first();
        $va = 0;
        if ($databank->c_bank == '5941') {
            $prefix = 9;
            $kode = $databank->c_bank;
            $nim = $request->id['nim'];
            $va = $prefix . $kode . $nim;
        }
        // return $request->id;
        // return $nim;
        if ($request->type == 1) {
            return $this->createva($request->id, $va);
        }
        if ($request->type == 2) {
            // return $request->all();
            if ($request->esteh) {
                $dv = vaTagihan::where('iduser', $request->id['iduser'])->first();
                // return $request->all();
                $va = $dv->va;
            } else {
                $dv = vaTagihan::where('iduser', $request->id['id'])->first();
                // return $request->all();
                $va = $dv->va;
            }

            // return $va;
            return $this->inquiryva($request->id, $va);
        }
        if ($request->type == 3) {
            return $this->updateva($request->id, $va);
        }
        if ($request->type == 4) {
            // return $request->all();
            return $this->deleteva($request->id, $va);
        }
        if ($request->type == 5) {
            return $this->bayarva($request->id, $va);
        }
        // $data = vaTagihan::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'fakultas' => $request->fak,
        //     'c_fak' => $request->c_fak,
        //     'tahun_akademik' => $request->tahun,
        //     'tagihan' => $request->tagihan,
        //     'bank' => $databank->bank,
        //     'c_bank' => $databank->c_bank,
        //     'status' => 0,
        //     'status_b' => 1,
        //     'no_ref' => $request->nim,
        //     'va' => $va,
        // ]);

        // if ($data) {
        //     return 'success';
        // }
    }
    public function proses2(Request $request)
    {
        // return $request->all();

        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        // $datacfak = $request->id['c_fak'];
        // $databank = vaBank::where('c_fak', $datacfak)->first();
        $va = 0;
        // if ($databank->c_bank == '5941') {
        //     $prefix = 9;
        //     $kode = $databank->c_bank;
        //     $nim = $request->id['nim'];
        //     $va = $prefix . $kode . $nim;
        // }
        // return $request->id;
        // return $nim;
        if ($request->type == 1) {
            return $this->pvcreateva($request->id, $va);

            // return $this->createva2($request->id, $va);
        }
        if ($request->type == 7) {
            // return $this->createva2($request->id, $va);
            return $this->pvcreateva($request->id, $va);
        }
        if ($request->type == 2) {
            // return $request->all();
            // if ($request->esteh) {
            //     $dv = vaTagihan::where('iduser', $request->id['iduser'])->first();
            //     // return $request->all();
            //     $va = $dv->va;
            // } else {
            //     $dv = vaTagihan::where('iduser', $request->id['id'])->first();
            //     // return $request->all();
            //     $va = $dv->va;
            // }

            // return $va;
            return $this->pvinquiryva($request->id, $va);

            // return $this->inquiryva2($request->id, $va);
        }
        if ($request->type == 3) {
            return $this->pvupdateva($request->id, $va);

            // return $this->updateva2($request->id, $va);
        }
        if ($request->type == 4) {
            // return $request->all();
            return $this->pvdeleteva($request->id, $va);

            // return $this->deleteva2($request->id, $va);
        }
        if ($request->type == 5) {
            return $this->bayarva($request->id, $va);
        }
        // $data = vaTagihan::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'fakultas' => $request->fak,
        //     'c_fak' => $request->c_fak,
        //     'tahun_akademik' => $request->tahun,
        //     'tagihan' => $request->tagihan,
        //     'bank' => $databank->bank,
        //     'c_bank' => $databank->c_bank,
        //     'status' => 0,
        //     'status_b' => 1,
        //     'no_ref' => $request->nim,
        //     'va' => $va,
        // ]);

        // if ($data) {
        //     return 'success';
        // }
    }
    public function signature()
    {
        $body = '{"ref":"500000","va":"123123"}';
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $uni = $id . ':' . $body . ':' . $key;
        return hash_hmac('sha256', $uni, $secret);
    }
    public function createva2($r, $va)
    {
        // return $r['nim'];
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/createVA';
        $body['ref'] = $r['o_b']['ref'];
        $body['va'] = $r['o_b']['va'];
        $body['nama'] = $r['nama'];
        $body['layanan'] =  $r['o_b']['layanan'];
        $body['kodelayanan'] = $r['o_b']['kodelayanan'];
        $body['jenisbayar'] = $r['periode'];
        $body['kodejenisbyr'] = $r['jenis'];
        $body['nogiro'] = '';
        $body['noid'] = $r['o_b']['noid'];
        $body['tagihan'] =  $r['o_b']['tagihan'];
        $body['flag'] =  $r['o_b']['flag'];
        $body['reserve'] = '';
        $body['angkatan'] = $r['o_b']['angkatan'];
        $body['expired'] =  $r['o_b']['expired'];
        $body['description'] =  $r['o_b']['description'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        // return $datanya;
        $ret = json_decode($datanya);
        if ($ret->rsp == '000') {
            $this->changestatus2($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            // return $ret->rsp;
            if ($ret->rsp == '006') {
                // return 1;
                $d = $this->deleteva2($r, $va = 0);
                // return $this->createva
                return $this->createva2($r, $va = 0);
            }
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function pvcreateva($r, $va)
    {
        // return $r['nim'];
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/createVA';
        $body['ref'] = $r['ref'];
        $body['va'] = $r['va'];
        $body['nama'] = $r['nama'];
        $body['layanan'] =  substr($r['layanan'], 0, 5);
        $body['kodelayanan'] = $r['kodelayanan'];
        $body['jenisbayar'] = $r['jenisbayar'];
        $body['kodejenisbyr'] = $r['kodejenisbayar'];
        $body['nogiro'] = '';
        $body['noid'] = $r['id'];
        $body['tagihan'] =  $r['tagihan'];
        $body['flag'] =  $r['flag'];
        $body['reserve'] = $r['periode'] . '-' . $r['gel'] ?? '0';
        $body['angkatan'] = $r['angkatan'];
        $body['expired'] =  $r['expired'];
        $body['description'] =  $r['description'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        // return $datanya;
        $ret = json_decode($datanya);
        if ($ret->rsp == '000') {

            $this->pvchangestatus($r, $ret, 2);

            return ['status' => 'success', 'message' => $ret];
        } else {
            // return $ret->rsp;
            if ($ret->rsp == '006') {
                // return 1;
                $d = $this->pvdeleteva($r, $va = 0);
                // return $this->createva
                return $this->pvcreateva($r, $va = 0);
            }
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function inquiryva2($r, $va)
    {
        // return $va;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/inqVA';
        $body['ref'] = $r['o_b']['ref'];
        $body['va'] = $r['o_b']['va'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        if ($ret->terbayar == $ret->tagihan) {
            $this->csb($ret, $r['id'], $r['gel_buka']);
        }
        // return Date('d m y', strtotime( $ret->createtime) );
        if ($ret->rsp == '000') {
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function pvinquiryva($r, $va)
    {
        // return $va;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/inqVA';
        $body['ref'] = $r['ref'];
        $body['va'] = $r['va'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        if ($ret->terbayar == $ret->tagihan) {
            $this->pvcsb($ret, $r['id'], null);
        }
        // return Date('d m y', strtotime( $ret->createtime) );
        if ($ret->rsp == '000') {
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function deleteva2($r, $va)
    {
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/deleteVA';

        $body['ref'] = $r['o_b']['ref'];
        $body['va'] = $r['o_b']['va'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        // return $ret;
        // return $ret->rsp;
        if ($ret->rsp == '000') {
            $this->changestatus2($r, $ret, 3);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function pvdeleteva($r, $va)
    {
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/deleteVA';

        $body['ref'] = $r['ref'];
        $body['va'] = $r['va'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        // return $ret;
        // return $ret->rsp;
        if ($ret->rsp == '000') {
            $this->pvchangestatus($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function updateva2($r, $va)
    {
        // return $r;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        // return $r['nim'];
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/updVA';
        $body['ref'] = $r['o_b']['ref'];
        $body['va'] = $r['o_b']['va'];
        $body['nama'] = $r['nama'];
        $body['layanan'] =  $r['o_b']['layanan'];
        $body['kodelayanan'] = $r['o_b']['kodelayanan'];
        $body['jenisbayar'] = $r['periode'];
        $body['kodejenisbyr'] = $r['jenis'];
        $body['nogiro'] = '';
        $body['noid'] = $r['o_b']['noid'];
        $body['tagihan'] =  $r['o_b']['tagihan'];
        $body['flag'] =  $r['o_b']['flag'];
        $body['reserve'] = '';
        $body['angkatan'] = $r['o_b']['angkatan'];
        $body['expired'] =  $r['o_b']['expired'];
        $body['description'] =  $r['o_b']['description'];
        // return 'tes';
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);

        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);

        $response = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($response);
        if ($ret->rsp == '000') {
            $this->changestatus($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function pvupdateva($r, $va)
    {
        // return $r;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        // return $r['nim'];
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/updVA';
        $body['ref'] = $r['ref'];
        $body['va'] = $r['va'];
        $body['nama'] = $r['nama'];
        $body['layanan'] =  $r['layanan'];
        $body['kodelayanan'] = $r['kodelayanan'];
        $body['jenisbayar'] = $r['jenisbayar'];
        $body['kodejenisbyr'] = $r['kodejenisbayar'];
        $body['nogiro'] = '';
        $body['noid'] = $r['id'];
        $body['tagihan'] =  $r['tagihan'];
        $body['flag'] =  $r['flag'];
        $body['reserve'] = $r['periode'] . '-' . $r['gel'] ?? '0';
        $body['angkatan'] = $r['angkatan'];
        $body['expired'] =  Carbon::now()->addMonths(3)->format('ymdHi');
        $body['description'] =  $r['description'];
        // return 'tes';
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);

        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);

        $response = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($response);
        if ($ret->rsp == '000') {
            $this->pvchangestatus($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function createva($r, $va)
    {
        // return $r['nim'];
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/createVA';
        $body['ref'] = $r['o_t']['no_ref'];
        $body['va'] = $r['o_t']['va'];
        $body['nama'] = $r['nama'];
        $body['layanan'] = '';
        $body['kodelayanan'] = '';
        $body['jenisbayar'] = $r['jenis'];
        $body['kodejenisbyr'] = '01';
        $body['nogiro'] = '';
        $body['noid'] = $r['nim'];
        $body['tagihan'] = $r['tagihan'];
        $body['flag'] = 'F';
        $body['reserve'] = '';
        $body['angkatan'] = $r['tahun'];
        $body['expired'] = '';
        $body['description'] = '';
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        // return $datanya;
        $ret = json_decode($datanya);
        if ($ret->rsp == '000') {
            $this->changestatus($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function deleteva($r, $va)
    {
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/deleteVA';

        $body['ref'] = $r['nim'];
        $body['va'] = $r['o_t']['va'];
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        // return $ret;
        // return $ret->rsp;
        if ($ret->rsp == '000') {
            $this->changestatus($r, $ret, 3);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
        if ($r['o_t']['status_b'] == 1) {
            $id = 'UNMPPS';
            $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
            $secret = 'FP8aqyeYI9';
            $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/deleteVA';

            $body['ref'] = $r['nim'];
            $body['va'] = $r['o_t']['va'];
            $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
            $uni = $id . ':' . $jsonBody . ':' . $key;
            $signature = hash_hmac('sha256', $uni, $secret);
            $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
            $ret = json_decode($datanya);

            // return $ret->rsp;
            if ($ret->rsp == '000') {
                $this->changestatus($r, $ret, 3);
                return ['status' => 'success', 'message' => $ret];
            } else {
                return ['status' => 'fail', 'message' => $ret];
            }
        } else {
            return ['status' => 'fail2', 'message' => 'Sudah Terbayar'];
        }
    }
    public function pembayaranok($r, $va) {}
    public function bayarva($r, $va)
    {
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn-dev.btn.co.id:9021/bayar/' . $r['o_t']['va'];
        $response = Http::get($url);
        $ret = json_decode($response);
        if ($ret->rsp == '000') {
            $this->pembayaranok($r, $ret);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function inquiryva($r, $va)
    {
        // return $va;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/inqVA';
        $body['ref'] = $r['nim'];
        $body['va'] = $va;
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);
        $datanya = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($datanya);
        if ($ret->terbayar == $ret->tagihan) {
            $this->csb($ret, $r['id'], $r['gel_buka']);
        }
        // return Date('d m y', strtotime( $ret->createtime) );
        if ($ret->rsp == '000') {
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function updateva($r, $va)
    {
        // return $r;
        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        // return $r['nim'];
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/updVA';
        $body['ref'] = $r['nim'];
        $body['va'] = $va;
        $body['nama'] = $r['nama'];
        $body['layanan'] = 'Registrasi';
        $body['kodelayanan'] = '001';
        $body['jenisbayar'] = 'Maba T.A 2023/2024 Tahap 1';
        $body['kodejenisbyr'] = '';
        $body['nogiro'] = '';
        $body['noid'] = $r['nim'];
        $body['tagihan'] = $r['tagihan'];
        $body['flag'] = 'F';
        $body['reserve'] = '';
        $body['angkatan'] = '';
        $body['expired'] = '';
        $body['description'] = 'SPP';
        // return 'tes';
        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);

        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);

        $response = $this->apibtn($id, $key, $signature, $url, $jsonBody);
        $ret = json_decode($response);
        if ($ret->rsp == '000') {
            $this->changestatus($r, $ret, 1);
            return ['status' => 'success', 'message' => $ret];
        } else {
            return ['status' => 'fail', 'message' => $ret];
        }
    }
    public function reports()
    {
        $tgl_a = request()->input('tgla');
        $tgl_r = request()->input('tglr');

        $id = 'UNMPPS';
        $key = 'Saz0As7ewGgY0ok8noSXBpVHp7CIZalH';
        $secret = 'FP8aqyeYI9';
        $url = 'https://vabtn.btn.co.id:9022/v1/unmpps/report' . $tgl_a . '/' . $tgl_r;

        $jsonBody = '{}';

        $uni = $id . ':' . $jsonBody . ':' . $key;
        $signature = hash_hmac('sha256', $uni, $secret);

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'id' => $id,
            'key' => $key,
            'signature' => $signature,
        ])->get($url, []);
        // $headers = ['content-type: application/json', 'id: ' . $id, 'key: ' . $key, 'signature: ' . $signature];
        $ak = [];
        foreach ($response['data'] as $key => $value) {
            $d = vaTagihan::where('va', $value['va'])->first();
            if ($d == null) {
                $ak[] = $value['va'];
            }
            vaBayar::updateOrCreate(
                [
                    'va' => $value['va'],
                ],
                [
                    'nama' => $value['nama'],
                    'teller' => $value['teller'],
                    'transcode' => $value['transcode'],
                    'seq' => $value['seq'],
                    'tgl' => $value['tgl'],
                    'jam' => $value['jam'],
                    'amount' => $value['amount'],
                    'revseq' => $value['revseq'],
                    'revjam' => $value['revjam'],
                    'tagihan' => $value['tagihan'],
                    'terbayar' => $value['terbayar'],
                    'id_tagihan' => $d->id,
                    'ref' => $d->nim,
                ],
            );
        }
        return Excel::download(new reports(), 'terbayar.xlsx');

        // $dd = vaBayar::with('oU')->get();
        // return $dd;

        return Excel::download(new reports(), 'terbayar.xlsx');

        return 'wew';
    }
    public function statusdata()
    {

        $gel = gel::where('status', 1)->first();
        $datava =    ppsmhs::with('oB')
            ->where('gel_buka', $gel->kode)
            ->get();
        // return $gel;
        if ($gel) {
            # code...
            if (request()->ajax()) {
                return Datatables::of(
                    ppsmhs::with('oB')
                        ->where('gel_buka', $gel->kode)
                        ->get(),
                )
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn = "<ul class='list-inline mb-0'>";

                        if ($data->oB) {
                            if ($data->oB->statusva == NULL) {
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='createva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Send VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                            <button type='button'  onclick='deleteva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                            </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                    <button type='button'  onclick='inquiryva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
                    </li>";
                            }
                            if ($data->oB->statusva == 1) {
                                // $btn .=
                                //     "<li class='list-inline-item'>
                                // <button type='button'  onclick='createva(" .
                                //     $dataj .
                                //     ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Send VA</button>
                                // </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='updateva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Update VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='deleteva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                            <button type='button'  onclick='inquiryva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
                            </li>";
                                //         $btn .=
                                //             "<li class='list-inline-item'>
                                // <button type='button'  onclick='bayarva(" .
                                //             $dataj .
                                //             ")'   class='btn btn-sm btn-info btn-xs mb-1'>bayar VA</button>
                                // </li>";
                            }
                            if ($data->oB->statusva == 2 || $data->oB->statusva == 3) {
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='createva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Send VA  </button>
                                </li>";
                            }
                        } else {
                            $btn .=
                                "<li class='list-inline-item'>
                            <button type='button'  onclick='generate(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Generate VA</button>
                            </li>";
                        }

                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('vanya', function ($data) {
                        $dataj = json_encode($data);
                        // return $data->oT->va;
                        if ($data->oT) {
                            if ($data->oT->va) {
                                $btn = "<span class='badge badge-primary' onclick='changeva(" . $data->oT . ")'> " . $data->oT->va . ' </span>';
                                // $btn = '<span onclick="changeva('.(string)$data->oT->va .',' . $data->oT->id . ','. $data->oT->tagihan .',' . $data->oT->no_ref.')" class="badge badge-primary"> <i>' . $data->oT->va . '</i> </span>';
                            } else {
                                $btn = '-';
                            }
                        } else {
                            $btn = '-';
                        }

                        return $btn;
                    })
                    ->addColumn('statusnya', function ($data) {
                        $dataj = json_encode($data);
                        if ($data->oB) {
                            if ($data->oB->statusva == NULL) {
                                $btn = '<span class="badge badge-primary"> VA Not Set </span>';
                            }
                            if ($data->oB->statusva == 1) {
                                $btn = '<span class="badge badge-success"> VA Created </span>';
                            }
                            if ($data->oB->statusva == 2) {
                                $btn = '<span class="badge badge-warning"> VA Failed </span>';
                            }
                            if ($data->oB->statusva == 3) {
                                $btn = '<span class="badge badge-danger"> VA Deleted </span>';
                            }
                            if ($data->oB->statusbayar == NULL) {
                                $btn .= '<span class="badge badge-warning"> Belum Membayar </span>';
                            }
                            if ($data->oB->statusbayar == 1) {
                                $btn .= '<span class="badge badge-success"> Sudah Membayar </span>';
                            }
                        } else {
                            $btn = '<span class="badge badge-primary"> VA Not Set </span>';
                        }

                        return $btn;
                    })

                    ->rawColumns(['aksi', 'statusnya', 'vanya'])
                    ->make(true);
            }
            return view('va.tagihan2', compact('datava'));
        } else {
            return 'aktifkan Gelombang dlu';
        }
        // return $datava;
        // return $datava;
    }
    public function va()
    {
        $gel = gel::where('status', 1)->first();
        $datava = vaUser::with('oT')
            ->where('gel', $gel->kode)
            ->get();
        // return $gel;
        if ($gel) {
            # code...
            if (request()->ajax()) {
                return Datatables::of(
                    vaUser::with('oT')
                        ->where('gel', $gel->kode)
                        ->get(),
                )
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($data) {
                        $dataj = json_encode($data);
                        $btn = "<ul class='list-inline mb-0'>";

                        if ($data->oT) {
                            if ($data->oT->status == 0) {
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='createva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Send VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                            <button type='button'  onclick='deleteva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                            </li>";
                            }
                            if ($data->oT->status == 1) {
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='createva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Send VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='updateva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Update VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='deleteva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-danger btn-xs mb-1'>Delete VA</button>
                                </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                            <button type='button'  onclick='inquiryva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-info btn-xs mb-1'>Inquiry VA</button>
                            </li>";
                                $btn .=
                                    "<li class='list-inline-item'>
                        <button type='button'  onclick='bayarva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-info btn-xs mb-1'>bayar VA</button>
                        </li>";
                            }
                            if ($data->oT->status == 2 || $data->oT->status == 3) {
                                $btn .=
                                    "<li class='list-inline-item'>
                                <button type='button'  onclick='createva(" .
                                    $dataj .
                                    ")'   class='btn btn-sm btn-warning btn-xs mb-1'>Send VA  </button>
                                </li>";
                            }
                        } else {
                            $btn .=
                                "<li class='list-inline-item'>
                            <button type='button'  onclick='generate(" .
                                $dataj .
                                ")'   class='btn btn-sm btn-primary btn-xs mb-1'>Generate VA</button>
                            </li>";
                        }

                        $btn .= '</ul>';
                        return $btn;
                    })
                    ->addColumn('vanya', function ($data) {
                        $dataj = json_encode($data);
                        // return $data->oT->va;
                        if ($data->oT) {
                            if ($data->oT->va) {
                                $btn = "<span class='badge badge-primary' onclick='changeva(" . $data->oT . ")'> " . $data->oT->va . ' </span>';
                                // $btn = '<span onclick="changeva('.(string)$data->oT->va .',' . $data->oT->id . ','. $data->oT->tagihan .',' . $data->oT->no_ref.')" class="badge badge-primary"> <i>' . $data->oT->va . '</i> </span>';
                            } else {
                                $btn = '-';
                            }
                        } else {
                            $btn = '-';
                        }

                        return $btn;
                    })
                    ->addColumn('statusnya', function ($data) {
                        $dataj = json_encode($data);
                        if ($data->oT) {
                            if ($data->oT->status == 0) {
                                $btn = '<span class="badge badge-primary"> VA Not Set </span>';
                            }
                            if ($data->oT->status == 1) {
                                $btn = '<span class="badge badge-success"> VA Created </span>';
                            }
                            if ($data->oT->status == 2) {
                                $btn = '<span class="badge badge-warning"> VA Failed </span>';
                            }
                            if ($data->oT->status == 3) {
                                $btn = '<span class="badge badge-danger"> VA Deleted </span>';
                            }
                        } else {
                            $btn = '<span class="badge badge-primary"> VA Not Set </span>';
                        }

                        return $btn;
                    })

                    ->rawColumns(['aksi', 'statusnya', 'vanya'])
                    ->make(true);
            }
            return view('va.tagihan', compact('datava'));
        } else {
            return 'aktifkan Gelombang dlu';
        }
        // return $datava;
        // return $datava;
    }
    public function apibtn($id, $key, $signature, $url, $jsonBody)
    {
        $ch = curl_init($url);
        $headers = ['content-type: application/json', 'id: ' . $id, 'key: ' . $key, 'signature: ' . $signature];
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret ?? $err;
    }
    public function changestatus($r, $ret, $stat)
    {
        return vaTagihan::where('va', $ret->va)
            ->where('no_ref', $ret->ref)
            ->update([
                'status' => $stat,
            ]);
    }
    public function changestatus2($r, $ret, $stat)
    {
        return bayarpps::where('noid', $r['id'])
            ->where('ref', $ret->ref)
            ->update([
                'statusva' => $stat,
            ]);
    }
    public function pvchangestatus($r, $ret, $stat)
    {
        return pvtagihan::where('id', $r['id'])
            ->where('ref', $ret->ref)
            ->update([
                'statustagihan' => $stat,
            ]);
    }
}
