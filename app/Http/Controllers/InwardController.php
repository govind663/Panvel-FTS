<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file_master;
use App\User;
use App\department;
use App\Forward;
use App\status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InwardController extends Controller
{
    
    public function Inward(Request $request)
    {  
        $data = file_master::get();
        return view('Inward.Inward', compact('data'));
    }
    
    public function search(Request $request)
    {
        
        $department = User::orderBy('id','asc')->pluck('name', 'id');
        $department_name = department::orderBy('id','asc')->pluck('name', 'id');
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        
        // Get the search value from the request
        $search = $request->input('search');
        // $log_user = $request->input('curr_user');
        $log_user  = Auth::user()->id;

        // Search in the title and body columns from the posts table
        $posts = file_master::query()
            ->Where('file_master_no',  "{$search}")
            ->get();
        
        
        if($posts->isNotEmpty()){
        $data = file_master::query()->where('file_master_no', "$search")
                ->orderBy('id','asc')->pluck('file_master_no');
            
        $posts_files = DB::SELECT('Select 
                    file_master_tbl.id,
                    file_master_tbl.file_type,
                    file_master_tbl.file_master_no,
                    file_master_tbl.total_pages_of_tipani,
                    file_master_tbl.total_pages_of_docs,
                    file_master_tbl.subject,
                    file_master_tbl.file_detail,
                    file_master_tbl.pdf,
                    file_master_tbl.reference,
                    file_master_tbl.reference_no,
                    file_master_tbl.reference_date,
                    file_master_tbl.created_by,
                    file_master_tbl.date,
                    file_master_tbl.table_no,
                    file_master_tbl.status,
                    file_master_tbl.inserted_dt, file_type_tbl.type, department_tbl.name as department_name
                    
                    FROM
                    `file_master_tbl`
                JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
                JOIN department_tbl ON department_tbl.id = file_master_tbl.department
                
                WHERE
                    file_master_tbl.deleted_at IS NULL AND file_master_no = "'.$search.'" ');
            
            $forward = Forward::query()
                ->where('file_master_no', $data)->where('file_fwd_status', 0)->where('forward_to', $log_user)->orderBy('id','desc')
                ->get();
            
            if($forward->IsEmpty())
            {    $forward = file_master::query()
                ->where('file_master_no', $data)->where('inserted_by', $log_user)->orderBy('id','desc')
                ->get();
            }
        }
        else{
            $forward = 0;
            $posts_files = 0;
            $data = 0;
        } 
        // $posts_files = DB::SELECT('Select 
        //                             file_master_tbl.id,
        //                             file_master_tbl.file_type,
        //                             file_master_tbl.file_master_no,
        //                             file_master_tbl.total_pages_of_tipani,
        //                             file_master_tbl.total_pages_of_docs,
        //                             file_master_tbl.subject,
        //                             file_master_tbl.file_detail,
        //                             file_master_tbl.pdf,
        //                             file_master_tbl.reference,
        //                             file_master_tbl.reference_no,
        //                             file_master_tbl.reference_date,
        //                             file_master_tbl.created_by,
        //                             file_master_tbl.date,
        //                             file_master_tbl.table_no,
        //                             file_master_tbl.status,
        //                             file_master_tbl.inserted_dt, file_type_tbl.type, department_tbl.name as department_name
                                    
        //                             FROM
        //                             `file_master_tbl`
        //                         JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
        //                         JOIN department_tbl ON department_tbl.id = file_master_tbl.department
                                
        //                         WHERE
        //                             file_master_tbl.deleted_at IS NULL AND file_master_no = "'.$search.'" ');
            
        // $data = file_master::query()->where('file_master_no', "$search")
        //         ->orderBy('id','asc')->pluck('file_master_no');
        
        // return $posts_file;
        // $forward = Forward::query()
        //     ->where('file_master_no', $data)->where('file_fwd_status', 0)->orderBy('id','desc')
        //     ->get();
            
        // $forward = Forward::query()
        //     ->where('file_master_no', $data)->where('file_fwd_status', 0)->where('forward_to', $log_user)->orderBy('id','desc')
        //     ->get();
            
        // ->pluck('id','user_login','dept_login','tableno_login');
        //return $forward;
        
        // Return the search view with the resluts compacted
        return view('Inward.Inward_result', compact('posts', 'posts_files', 'department', 'department_name', 'forward', 'status'));
    }
    
    
}
