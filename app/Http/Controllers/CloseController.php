<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file_master;
use App\Models\User;
use App\Models\status;
use App\Models\department;
use App\Models\Forward;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CloseController extends Controller
{
    public function Close(Request $request)
    {
        $data = file_master::get();
        // dd($data);
        return view('Close.Close', compact('data'));
    }

    public function Closedsearch(Request $request)
    {
        // $data = file_master::get();
        $department = User::get();
        $department_name = department::get();
        // $forward = Forward::get();
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        $log_user  = Auth::user()->id;

        // Get the search value from the request
        $search = $request->input('search');

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
                    file_master_tbl.inserted_by,
                    file_master_tbl.inserted_dt, file_type_tbl.type, department_tbl.name as department_name,
                    file_master_tbl.current_user_id

                    FROM
                    `file_master_tbl`
                JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
                JOIN department_tbl ON department_tbl.id = file_master_tbl.department

                WHERE
                    file_master_tbl.deleted_at IS NULL AND file_master_no = "'.$search.'"

            ');


            $forward = Forward::query()
                ->where('file_master_no', $data)->where('file_fwd_status', 1)->where('forward_to', $log_user)->orderBy('id','desc')
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
        //                                 file_master_tbl.id,
        //                                 file_master_tbl.file_type,
        //                                 file_master_tbl.file_master_no,
        //                                 file_master_tbl.total_pages_of_tipani,
        //                                 file_master_tbl.total_pages_of_docs,
        //                                 file_master_tbl.subject,
        //                                 file_master_tbl.file_detail,
        //                                 file_master_tbl.pdf,
        //                                 file_master_tbl.reference,
        //                                 file_master_tbl.reference_no,
        //                                 file_master_tbl.reference_date,
        //                                 file_master_tbl.created_by,
        //                                 file_master_tbl.date,
        //                                 file_master_tbl.table_no,
        //                                 file_master_tbl.status,
        //                                 file_master_tbl.inserted_dt, file_type_tbl.type, department_tbl.name as department_name

        //                                 FROM
        //                                 `file_master_tbl`
        //                             JOIN file_type_tbl ON file_master_tbl.file_type = file_type_tbl.id
        //                             JOIN department_tbl ON department_tbl.id = file_master_tbl.department

        //                             WHERE
        //                                 file_master_tbl.deleted_at IS NULL AND file_master_no = "'.$search.'" ');

        // $data = file_master::query()->where('file_master_no', "$search")
        //         ->orderBy('id','asc')->pluck('file_master_no');

        // $data = file_master::where('id', 'LIKE', "%{$search}%")
        //     ->orWhere('file_master_no', 'LIKE', "%{$search}%")->orderBy('id','asc')->pluck('file_master_no');

        // $forward = Forward::query()
        //     ->where('file_master_no', $data)->where('file_fwd_status', 1)->where('forward_to', $log_user)->orderBy('id','desc')
        //     ->get();

        // Return the search view with the resluts compacted
        return view('Close.close_result', compact('posts', 'posts_files',  'department', 'department_name', 'status', 'forward'));
    }
}
