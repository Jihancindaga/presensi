<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);
        if(Auth::guard('karyawan')->attempt(['nik' => $request->nik,'password' => $request->password])){
             // echo "Berhasil Login";
             return redirect('/dashboard');
         }else {
             return redirect('/')->with(['warning' => 'NIK / Password Salah']);
         }
    }

    public function prosesLogout ()
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        if(Auth::guard('user')->attempt(['email' => $request->email,'password' => $request->password])){
             return redirect('/dashboardadmin');
         }else {
             return redirect('/panel')->with(['warning' => 'Username atau Password Salah']);
         }
    }
}

