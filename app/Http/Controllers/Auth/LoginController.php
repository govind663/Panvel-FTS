<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repository\LogRepository;

class LoginController extends Controller
{
    protected $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/index');
        } else {
            return view('auth.login');
        }

    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ],[
           'email.required' => 'Email Id is required',
           'password.required' => 'Password is required',
          ]);

        $email = $request->only('email');

        $email_str = implode(" ",$email);

        // $res = DB::select('
        //           SELECT *
        //           FROM users
        //           WHERE email ="'.$email_str.'"
        //           AND users.deleted_at IS NULL
        //             ');

       $res = DB::table('users')->where('email', "'.$email_str.'")->pluck('user_type')->first();

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_token') ? true : false;
        // $user = Auth::user()->user_type;
        // return $user;

        if (Auth::attempt($credentials, $remember_me)) {
            Session::put('user_type', Auth::user()->user_type);
            $user_type = Auth::user()->user_type;
            $user_email = Auth::user()->email;
            $user_password = Auth::user()->password;
            $user_deleted_at = Auth::user()->deleted_at;
            $res = DB::table('users')->where('email', "'.$email_str.'")->pluck('user_type')->first();

            $this->logRepository->insertLog(Auth::guard('web')->user()->id, 'users', 'login');

            return redirect()->intended('index')->with('message', 'You are login successful.');

        }
        else{
            return redirect()->back()->with(['Input' => $request->only('email', 'remember'), 'error' => 'Your Email and Password do not match our records!']);
        }

    }

    public function logout(Request $request) {
        $this->logRepository->insertLog(Auth::guard('web')->user()->id, 'users', 'logout');
        $request->session()->flush();
        Auth::logout();
        return redirect('/')->with('message', 'You are logout successful.');
    }
}
