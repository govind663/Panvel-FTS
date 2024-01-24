<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Error_PageController extends Controller
{
    public function Error_No_400()
    {
        if(Auth::check()){
            return view('Error Pages.400');
        }
        else{
            return redirect('/login')->with('error', 'Please Login First!');
        }
    }

    public function Error_No_403()
    {
        if(Auth::check()){
            return view('Error Pages.403');
        }
        else{
            return redirect('/login')->with('error', 'You do not have permission to access this page Please login as an adminstrator!');
        }
    }

    public function Error_No_404()
    {
        if(Auth::check()){
            return view('Error Pages.404');
        }
        $value = $_SERVER['QUERY_STRING'];  // Get the query string data.
        parse_str($value, $array);   // Parse the query string variables into
        // an associative array called $array.
        $pageName=DB::table('pages') ->where('name','LIKE%'.$array["page"].'%')->first();

        return view('Error Pages.404') -> with ('pageName',$pageName->name) ;

    }

    public function Error_No_500()
    {
        if(Auth::check()){
            return view('Error Pages.500');
        }
        else{
            return redirect('/login')->with('error', 'Please Login First!');
        }
    }

    public function Error_No_503()
    {
        if(Auth::check()){
            return view('Error Pages.503');
        }
        else{
            return redirect('/login')->with('error', 'Please Login First!');
        }
    }
}
