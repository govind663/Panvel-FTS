<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file_master;
use App\Models\department;
use App\Models\User;
use App\Models\Forward;
use App\Models\status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class file_statusController extends Controller
{
    public function file_status()
    {
        // $department = department::orderBy('id', 'DESC')->get();
        $department = DB::Select("SELECT dept.id, dept.name, count(fmt.id) as totalfiles, count(ftc.id) as closed
                                    FROM department_tbl as dept
                                    Left JOIN file_master_tbl as fmt on dept.id = fmt.department
                                    Left JOIN file_master_tbl as ftc on ftc.id = fmt.id and ftc.status = 14

                                    WHERE dept.deleted_at IS NULL
                                    GROUP by dept.id, dept.name
                                    ORDER BY dept.id ASC");
        // return $department;
        return view('Reports.file_status', compact('department'));
    }

    public function check_file_history()
    {
        return view('Reports.file_history');
    }

    public function Check_File_History_Search(Request $request)
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
        return view('Reports.file_history_result', compact('posts', 'posts_files', 'department', 'department_name', 'forward', 'data', 'status'));
    }
}
