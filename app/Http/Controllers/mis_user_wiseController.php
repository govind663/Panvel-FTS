<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file_master;
use App\department;
use App\User;
use Illuminate\Support\Facades\DB;

class mis_user_wiseController extends Controller
{
    public function mis_user_wise()
    {
        $data = DB::select('SELECT
                                file_master_tbl.id AS emp_id,
                                file_master_tbl.file_master_no AS emp_file_no,
                                file_type_tbl.type AS emp_file_type,
                                file_master_tbl.subject AS emp_subject,
                                file_master_tbl.status AS emp_file_status, 
                                file_master_tbl.inserted_dt AS emp_inserted_date, 
                                file_type_tbl.inserted_dt AS emp_created_dt,
                                close_data_tbl.inserted_dt AS emp_close_dt,
                                DATEDIFF(date(close_data_tbl.inserted_dt), date(file_master_tbl.inserted_dt)) total_days
                                
                                
                            FROM
                                `file_master_tbl`
                            LEFT JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
                            LEFT JOIN close_data_tbl ON file_master_tbl.file_master_no = close_data_tbl.file_master_no
                            
                            WHERE
                                file_master_tbl.deleted_at IS NULL
                            
                            ORDER BY
                                `emp_id` DESC
                        ');
        
        $employee_name = User::orderBy('id','asc')->where("status" , "Active")->pluck('name', 'id');
        
        return view('Reports.MIS_Employee', compact('data', 'employee_name'));
    }
    
    // search user
    public function searchUser(Request $request)
    {
        DB::enableQueryLog();
        // search by name and role name and status
        if($request->from_date && $request->to_date && $request->user)
        {
            $data = DB::select('SELECT
                                file_master_tbl.id AS emp_id,
                                file_master_tbl.file_master_no AS emp_file_no,
                                file_type_tbl.type AS emp_file_type,
                                file_master_tbl.subject AS emp_subject,
                                file_master_tbl.status AS emp_file_status, 
                                file_master_tbl.inserted_dt AS emp_inserted_date, 
                                file_type_tbl.inserted_dt AS emp_created_dt,
                                close_data_tbl.inserted_dt AS emp_close_dt,
                                DATEDIFF(date(close_data_tbl.inserted_dt), date(file_master_tbl.inserted_dt)) total_days
                                
                                
                            FROM
                                `file_master_tbl`
                            LEFT JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
                            
                            LEFT JOIN close_data_tbl ON file_master_tbl.file_master_no = close_data_tbl.file_master_no
                            
                            WHERE
                                file_master_tbl.deleted_at IS NULL
                            AND (file_master_tbl.inserted_by = "'.$request->user.'" OR file_master_tbl.current_user_id = "'.$request->user.'")
                            AND file_master_tbl.inserted_dt between "'.$request->from_date.'" AND "'.$request->to_date.'"
                            
                            ORDER BY
                                `emp_id` DESC
                            ');
            //             $post_param = array([
            //                     'User'=>$request->user,
            //                     'From'=>$request->from_date,
            //                     'To'=>$request->to_date
            //                     ]
            //                 );    
            // dd(DB::getQueryLog());
            // return $post_param; exit();
            // return $this->db->last_query(); exit();
            // return $data;
            
                    $employee_name = User::orderBy('id','asc')->where("status" , "Active")->pluck('name', 'id');
        
            return view('Reports.MIS_Employee',compact('data', 'employee_name'));
                            
        }
        
        

    }
}
