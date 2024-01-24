<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\department;
use App\file_master;
use Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $data = DB::select('SELECT dpt.id, dpt.inserted_by, dpt.name, count(fmt.id) as totalfiles
            FROM `department_tbl` as dpt
            Left JOIN file_master_tbl as fmt on dpt.id = fmt.department
            WHERE dpt.deleted_at IS NULL
            AND fmt.status != 14
            GROUP by dpt.id, dpt.name, dpt.inserted_by
            ORDER BY dpt.id ASC');
            
            // return $data;
            
            return view('index', compact('data'));
        }
        return redirect("login");
    }

    public function d()
    {
       echo $_SERVER['DOCUMENT_ROOT']."/upload/";
    }
}
