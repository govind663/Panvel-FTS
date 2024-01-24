<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class Error_PageController extends Controller
{
    public function Error_No_400()
    {
        if(Auth::check()){
            return view('Error Pages.400');
        }
        return redirect("login");
    }
    
    public function Error_No_403()
    {
        if(Auth::check()){
            return view('Error Pages.403');
        }
        return redirect("login");
    }
    
    public function Error_No_404()
    {
        if(Auth::check()){
            return view('Error Pages.404');
        }
        return redirect("login");
    }
    
    public function Error_No_500()
    {
        if(Auth::check()){
            return view('Error Pages.500');
        }
        return redirect("login");
    }
    
    public function Error_No_503()
    {
        if(Auth::check()){
            return view('Error Pages.503');
        }
        return redirect("login");
    }
}
