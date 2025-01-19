<?php

namespace App\Http\Controllers;

use App\Imports\vauser;
use App\Models\historyQuiz;
use App\Models\pelanggaran;
use App\Models\pelanggaranSiswa;
use App\Models\pembelajaran;
use App\Models\Quiz;
use App\Models\RiwayatQuiz;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Socket;
use App\Models\batasPelanggaran;
use App\Models\konsultasiSiswa;
use App\Models\vaTagihan;
use App\Models\vaTahun;
use App\Models\vaUser as ModelsVaUser;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function reporting($id)
    {
        $id = User::with('oBk')->where('id', $id)->first();
        $ps = pelanggaranSiswa::with('oLanggar')->where('id_siswa', $id->id)->latest()->get();
        $konsul = konsultasiSiswa::with('oGuru')->where('id_siswa', $id->id)->orderBy('created_at', 'DESC')->get();


        return view('reporting', compact('id', 'ps', 'pt', 'bp', 'rs', 'konsul'));
    }
    public function profil()
    {
        return view('admin.profil');
    }
    public function storeprofil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['string', 'max:255', 'unique:users,email,' . $request->id],
        ]);

        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return redirect()
                ->back()
                ->with($data);
        }
        $user = User::findorfail($request->id);
        if ($user) {
            if (request()->file('foto')) {
                $path = 'img/siswa/' . $user->foto;
                $bases = $_SERVER['DOCUMENT_ROOT'];
                if ($user->foto != null) {
                    if (file_exists($bases . '/' . $path)) {
                        unlink($bases . '/' . $path);
                        $user->foto = null;
                    } else {
                        return 'gagal hapus foto';
                    }
                }
                $gmbr = request()->file('foto');
                $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
                $tujuan_upload = 'img/siswa/';
                $gmbr->move($tujuan_upload, $nama_file);
                $user->foto = $nama_file ?? null;
            }
            $user->name = $request->nama;
            $user->no = $request->no;
            $user->username = $request->username;

            $user->email = $request->email;
            if ($request->pass != '' || $request->pass != null) {
                $user->password = Hash::make($request->pass);
            }
            $user->save();
            return redirect()
                ->back()
                ->with('message', 'success');
        }
    }
    public function deleteuser($id)
    {
        $data = User::where('id', $id)->delete();
        if ($data) {
            return 'success';
        }
    }
    public function index()
    {
        $mahasiswa = User::where('role', 2)->count();
        $pembelajaran = pelanggaran::count();
        $dat = vaTahun::where('status', 1)->first();
        $vauser = ModelsVaUser::where('tahun', $dat->tahun)->count();
        $tagihan = ModelsVaUser::where('tahun', $dat->tahun)->sum('tagihan');
        $terbayar = vaTagihan::where('status_b', 2)->where('tahun_akademik', $dat->tahun)->sum('tagihan');
        // return $terbayar;
        // return $dat;
        return view('admin.dashboard', compact('mahasiswa', 'pembelajaran', 'dat', 'vauser', 'tagihan', 'terbayar'));
    }
    public function mahasiswastore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::create([
            'name' => $request->nama,
            'role' => 3,
            'alamat' => $request->alamat,
            'no' => $request->nomor,
            'kode' => $request->nim,
            'status' => 1,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function dosenstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'wali' => $request->wali,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'nowali' => $request->nowali,

            'poin' => 0,
            'id_guru' => $request->bk,
            'role' => 2,
            'kelas' => $request->kelas,
            'no' => $request->nomor,
            'kode' => $request->nis,
            'status' => 1,
            'password' => Hash::make('12345'),
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function dosenupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::where('id', $request->id)->first();
        $data->name = $request->nama;
        $data->username = $request->nis;
        $data->kode = $request->nis;
        $data->id_guru = $request->bk;
        $data->kelas = $request->kelas;
        $data->no = $request->nomor;

        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        if ($data) {
            return 'success';
        }
    }
    public function gurustore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::create([
            'name' => $request->nama,
            'role' => 3,
            'alamat' => $request->alamat,
            'no' => $request->nomor,
            'status' => 1,
            'email' => $request->email,
            'username' => $request->username,

            'password' => Hash::make('password'),
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function guruupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::where('id', $request->id)->first();
        $data->name = $request->nama;
        $data->alamat = $request->alamat;
        $data->username = $request->username;
        $data->no = $request->nomor;
        $data->email = $request->email;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function adminupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::where('id', $request->id)->first();
        $data->name = $request->nama;
        $data->alamat = $request->alamat;
        $data->username = $request->username;
        $data->no = $request->nomor;
        $data->email = $request->email;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->save();
        if ($data) {
            return 'success';
        }
    }
    public function adminstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'nomor' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::create([
            'name' => $request->nama,
            'role' => 1,
            'alamat' => $request->alamat,
            'no' => $request->nomor,
            'status' => 1,
            'email' => $request->email,
            'username' => $request->username,

            'password' => Hash::make('password'),
        ]);

        if ($data) {
            return 'success';
        }
    }
    public function mahasiswaupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = User::where('id', $request->id)->first();
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->name = $request->nama;
        $data->alamat = $request->alamat;
        $data->no = $request->nomor;
        $data->kode = $request->nim;
        $data->email = $request->email;

        $data->save();

        return 'success';
    }
    public function mahasiswa()
    {
        if (request()->ajax()) {
            return Datatables::of(User::where('role', 3)->get())
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
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.mahasiswa');
    }
    public function dosen()
    {
        $guru = User::where('role', 3)->get();
        if (request()->ajax()) {
            return Datatables::of(User::where('role', 2)->get())
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
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.dosen', compact('guru'));
    }
    public function riwayat($id) {}
    public function guru()
    {
        if (request()->ajax()) {
            return Datatables::of(User::where('role', 3)->get())
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
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.guru');
    }
    public function admin()
    {
        if (request()->ajax()) {
            return Datatables::of(User::where('role', 1)->get())
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
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.admin');
    }
}
