<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use PDF;
use App\Models\department;
use App\Models\file_master;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Department_DetailsController extends Controller
{
    public function Department_Details( $id )
    {
        // $data = file_master::where('department', $id)->orderBy('department', 'DESC' )->get();
        $data = DB::select('SELECT file_master_tbl.id, users.name, file_master_tbl.file_type,
                                    file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                    file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                    file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                    file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                    file_master_tbl.date, file_master_tbl.table_no,
                                    file_master_tbl.status, file_master_tbl.inserted_dt, file_master_tbl.modify_dt

                                    FROM `file_master_tbl`
                                    JOIN users ON file_master_tbl.inserted_by=users.id
                                    WHERE file_master_tbl.deleted_at IS NULL
                                    AND file_master_tbl.status != 14
                                    AND file_master_tbl.department = '.$id.'
                        ');



        // return $data1;
        $department = department::where('id', $id)->orderBy('id', 'DESC' )->get();
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";

        return view('Department.Department Details.Department_Details', compact('data', 'department', 'path'));
    }
}
