<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getlogin()
    {
        if (Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        else{
            return view('admin.login');
        }
    }
    public function postlogin(Request $request)
    {
        $login=[
            'email'=>$request->txtEmail,
            'password' => $request->txtPassword,
        ];

        if (Auth::attempt($login,$request->chkRemember)){
            $user = Auth::user();
            $request->session()->regenerate();
                if ((($user->level==0) || ($user->level==1 && $user->status==1))) {
                    return redirect()->intended(route('admin.dashboard'));
                }
                elseif ($user->level==2 && $user->status=1){
                    return redirect()->intended(route('home'));
                }
                else{
                    return back()->with('message', 'Tài khoản không còn hoạt động');
                }
        }
        else{
            return back()->with('message', 'Email hoặc Password không chính xác');
        }
    }
    public function getlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.getlogin');
    }
}
