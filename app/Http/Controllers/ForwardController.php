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

class ForwardController extends Controller
{
    public function Forward(Request $request)
    {
        $data = file_master::get();
        // $all_data_trx = Forward::get();
        // return $dataclose;
        
        $all_data_trx = DB::select('SELECT
                                fdt.id AS fdt_id,
                                fdt.file_master_no fdt_file_master_no,
                                
                                fdt.user_login AS fdt_name_login,
                                dpt_1.name AS fdt_department_login,
                                fdt.tableno_login AS fdt_tableno_login,
                                
                                dpt_2.name AS forword_dept_name,
                                users.name AS forword_to,
                                fdt.fowto_table_no AS forword_table_no,
                                
                                fdt.method AS forword_method,
                                fdt.Peon AS forword_peon,
                                
                                fdt.remark AS forword_remark,
                                fdt.pdf AS forword_pdf,
                                fdt.tipani_page AS forword_tipani_page,
                                fdt.file_status AS file_fwd_status,
                                fdt.inserted_dt AS forword_file_date
                                
                            FROM
                                forward_data_tbl AS fdt
                            JOIN department_tbl AS dpt_1 ON fdt.dept_login = dpt_1.id
                            JOIN department_tbl AS dpt_2 ON fdt.department_name = dpt_2.id
                            JOIN users ON fdt.forward_to = users.id
                            WHERE
                                fdt.deleted_at IS NULL
                            AND fdt.file_status = "12"
                            AND (fdt.inserted_by = "'.Auth::user()->id.'" OR fdt.forward_to = "'.Auth::user()->id.'")
                            ORDER BY fdt.`id` DESC
                                ');
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        return view('Forward.forward', compact('data', 'all_data_trx', 'path'));
    }
    
    public function forwardsearch(Request $request)
    {
        // $data = file_master::get();
        $department = User::orderBy('id','asc')->pluck('name', 'id');
        $department_name = department::orderBy('id','asc')->where("status" , "Active")->pluck('name', 'id');
        // $forward = Forward::get();
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        // return $department_name;
        
        $log_user  = Auth::user()->id;
        //return $all_data_trx;
        
        // Get the search value from the request
        $search = $request->input('search');

        /// Search in the title and body columns from the posts table
        $posts = file_master::query()
            ->Where('file_master_no',  "{$search}")
            ->get();

        // $data = file_master::where('id', 'LIKE', "%{$search}%")
        //     ->orWhere('file_master_no', 'LIKE', "%{$search}%")->orderBy('id','asc')->pluck('file_master_no');
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
                    file_master_tbl.inserted_dt, file_type_tbl.type, department_tbl.name as department_name,
                    file_master_tbl.current_user_id
                    
                    FROM
                    `file_master_tbl`
                JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
                JOIN department_tbl ON department_tbl.id = file_master_tbl.department
                
                WHERE
                    file_master_tbl.deleted_at IS NULL AND file_master_no = "'.$search.'" ');
            
            $forward = Forward::query()
                ->where('file_master_no', $data)->where('file_fwd_status', 1)->where('forward_to', $log_user)->orderBy('id','desc')
                ->get();
            
            if($forward->IsEmpty())
            {    $forward = file_master::query()
                ->where('file_master_no', $data)->where('inserted_by', $log_user)->where('status', 10)->orderBy('id','desc')
                ->get();
            }
        }
        else{
            $forward = 0;
            $posts_files = 0;
            $data = 0;
        }
        // $forward = Forward::query()
        //     ->where('file_master_no', $data)->where('file_fwd_status', 1)->orderBy('id','desc')->get();
            
        // Return the search view with the resluts compacted
        return view('Forward.Forward_result', compact('posts', 'posts_files', 'department', 'department_name', 'forward', 'data', 'status'));
    }
    
    
    public function DepartmentUser(Request $request)
    {
        $data['user_department'] = User::where("department", $request->department_name)->where("status" , "Active")->get(["name", "id"]);
        
        return response()->json($data);
    }
    
    public function DepartmentUserTableNumber(Request $request)
    {
        $data['department_table_no'] = User::where("id", $request->forward_to)->where("status" , "Active")->get(["table_no", "id"]);
        
        return response()->json($data);
    }
}
