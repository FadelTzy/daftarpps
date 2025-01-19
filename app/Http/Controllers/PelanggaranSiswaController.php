<?php

namespace App\Http\Controllers;

use App\Models\batasPelanggaran;
use App\Models\historyQuiz;
use Illuminate\Http\Request;
use App\Models\pelanggaranSiswa;
use App\Models\RiwayatQuiz;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PelanggaranSiswaController extends Controller
{
    public function delete($id)
    {
        $data = pelanggaranSiswa::where('id',$id)->first();
        if ($data) {
            $user = User::where('id',$data->id_siswa)->first();
            $maxatas = $user->poin;
            $user->poin = $user->poin - $data->poinpelanggaran;
            $maxbawah = $user->poin;

          $rq =  RiwayatQuiz::where('poin','<=',$maxatas)->where('poin','>=',$maxbawah)->first();
          if ($rq) {
            $rq->delete();
          }
          
            $user->save();
            $data->delete();
            return 'success';
        }
    }
    public function pelanggaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'iduser' => ['required', 'string', 'max:255'],
            'idpelanggaran' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $batas = batasPelanggaran::where('id',$request->idbatas)->first();
        $us = User::where('id',$request->iduser)->first();
        $us->poin = $us->poin + $request->poin;
        $us->save();
        $data = pelanggaranSiswa::create([
            'id_siswa' => $request->iduser,
            'id_pelanggaran' => $request->idpelanggaran,
            'poinpelanggaran' => $request->poin,
            'tindaklanjut' => $request->tindaklanjut
        ]);
        if ($batas->poin <= $us->poin) {
            RiwayatQuiz::create([
                'id_user' => $request->iduser,
                'id_batas' => $request->idbatas,
                'poin' => $batas->poin,
                'tindaklanjut' => $batas->tindaklanjut,
                'status' => 0,
            ]);
            return ['status'=>'warning'];
        }
        if ($data) {
            return ['status'=>'success'];
        }
    }
}
