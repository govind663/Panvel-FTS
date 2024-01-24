<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file_master;
use App\department;
use Illuminate\Support\Facades\DB;

class MISController extends Controller
{
    public function MIS()
    {
        // $data = DB::select('SELECT * FROM `department_tbl` ORDER BY `department_tbl`.`deleted_at` DESC');
        $data = DB::select('SELECT dpt.id, dpt.name, count(fmt.id) as totalfiles, count(ftt.id) as transit, count(ftc.id) as closed
                            FROM `department_tbl` as dpt 
                            Left JOIN file_master_tbl as fmt on dpt.id = fmt.department 
                            Left JOIN file_master_tbl as ftt on ftt.id = fmt.id and (ftt.status = 12)
                            Left JOIN file_master_tbl as ftc on ftc.id = fmt.id and ftc.status = 14 
                            
                            WHERE dpt.deleted_at IS NULL
                            GROUP BY dpt.id,dpt.name
                            ORDER BY dpt.`name` ASC
                        ');
            
        // return $count;
        return view('Reports.MIS', compact('data'));
    }
    
    public function mis_department_user_wise($id)
    {
        // $data = file_master::where('department', $id)->orderBy('id', 'DESC' )->get();
        $data = DB::select('SELECT ust.id, ust.name, fmt.created_by, count(fmt.id) as totalfiles, count(ftt.id) as transit, count(ftc.id) as closed
                            FROM `users` as ust
                            Left JOIN file_master_tbl as fmt on ust.id = fmt.inserted_by
                            Left JOIN file_master_tbl as ftt on ftt.id = fmt.id and (ftt.status = 12)
                            Left JOIN file_master_tbl as ftc on ftc.id = fmt.id and ftc.status = 14   
                            
                            WHERE fmt.department = '.$id.'
                            GROUP by ust.id, ust.name, fmt.created_by
                            ORDER BY ust.id ASC
                        ');
        $department = department::where('id', $id)->orderBy('id', 'DESC' )->get();
        // return $data;
        return view('Reports.mis_department_user_wise', compact('data', 'department'));
    }
}
