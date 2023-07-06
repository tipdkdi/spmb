<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PmbAkun;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function konfirmasi($username, $password)
    {
        return view('konfirmasi-akun', [
            'username' => $username,
            'password' => $password,
        ]);
    }

    // public function username()
    // {
    //     return 'username';
    // }

    public function authenticate(Request $request)
    {
        // return "gg";
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // $role  = Auth::user()->roleDefault()->role->nama_role;
            $role = Auth::user()->userRole->nama_role;
            // return $role;
            if ($role == "admin") {
                // session(['role' => $role, 'fakultasData' => $data]);
                return redirect()->intended(route('dashboard'));
            } else if ($role == "peserta") {
                // session(['role' => $role, 'fakultasData' => $data]);
                return redirect()->intended(route('peserta.dashboard'));
            } else if ($role == "pengawas") {
                // session(['role' => $role]);
                return redirect()->intended(route('pengawas.dashboard'));
            }
        }
        return back()->withInput()->with('fail', 'Login Gagal, pastikan username dan password sesuai');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index');
    }
    // public function indexApi()
    // {
    //     return view('login-api');
    // }



    // public function sessionDirect(Request $request, $role)
    // {
    // return $request->all();
    // return redirect()->route('create.session');
    // return array('datanya inimi' => );
    // $check = PplPendaftar::where([
    //     'iddata' => $request->iddata,
    //     // 'is_update' => 0
    //     // ])->first();
    // ])->first();
    // return $check;
    // if ($role == "mahasiswa") {
    //     $credentials = [
    //         'email' => 'mhs@mail.com',
    //         'password' => '1234qwer'
    //     ];
    //     if (Auth::attempt($credentials)) {

    // $request->session()->regenerate();
    // $prodi = MasterProdi::with('masterFakultas')->where('prodi_kode', $request->idprodi)->first();
    // session(
    //     [
    //         'iddata' => $request->iddata,
    //         'fakultas_id' => $prodi->masterFakultas->id
    //     ]
    // );
    //             $check = PplPendaftar::where([
    //                 'iddata' => $request->iddata,
    //                 // 'is_update' => 0
    //                 // ])->first();
    //             ]);
    //             return $check;
    //             if (!empty($check)) {
    //                 if ($check->is_update == 0)

    //                     return redirect()->intended(route('mahasiswa.dashboard'));
    //             }
    //             // return $request->session()->get('role');

    //             return redirect()->intended(route('mahasiswa.dashboard'));
    //         }
    //     } else {
    //         $credentials = [
    //             'email' => 'pembimbing@mail.com',
    //             'password' => '1234qwer'
    //         ];
    //         if (Auth::attempt($credentials)) {
    //             $request->session()->regenerate();
    //             session(
    //                 [
    //                     'role' => "pembimbing",
    //                     'data' => $id
    //                 ]
    //             );
    //             return redirect()->intended(route('pembimbing.dashboard'));
    //         }
    //     }
    //     // return $request->session()->get('role');
    //     // return Auth::user()->userRole->nama_role;
    // }
    // public function createSession(Request $request)
    // {
    //     return redirect()->route('create.session');
    //     // return array('datanya inimi' => );
    //     if ($request->role == "mahasiswa") {
    //         $credentials = [
    //             'email' => 'mhs@mail.com',
    //             'password' => '1234qwer'
    //         ];
    //         if (Auth::attempt($credentials)) {
    //             $request->session()->regenerate();
    //             session(
    //                 [
    //                     'role' => "mahasiswa",
    //                     'data' => json_decode($request->data)
    //                 ]
    //             );

    //             // return redirect()->intended(route('dashboard'));
    //         }
    //     } else {
    //         session(
    //             [
    //                 'role' => "pembimbing",
    //             ]
    //         );
    //     }
    //     return $request->session()->get('data');
    //     return Auth::user()->userRole->nama_role;
    // }


}
