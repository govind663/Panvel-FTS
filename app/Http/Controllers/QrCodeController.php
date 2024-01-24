<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file_master;
use Illuminate\Support\Facades\DB;

class QrCodeController extends Controller
{
    public function index($id)
    {
        $data = file_master::where('id', $id)->orderBy('id', 'DESC' )->get();
        // $data = DB::select('SELECT file_master_tbl.id, department_tbl.name, 
        //                     file_master_tbl.file_type, file_master_tbl.total_pages_of_tipani,
        //                     file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
        //                     file_master_tbl.file_detail, file_master_tbl.pdf,
        //                     file_master_tbl.reference, file_master_tbl.reference_no,
        //                     file_master_tbl.reference_date, file_master_tbl.created_by,
        //                     file_master_tbl.table_no, file_master_tbl.status, 
        //                     file_master_tbl.reminder,file_master_tbl.date
        //                     FROM `file_master_tbl` JOIN department_tbl ON 
        //                     file_master_tbl.department=department_tbl.id 
        //                     WHERE file_master_tbl.deleted_at IS NULL');
                             
        $company = DB::select('SELECT * FROM `organization_tbl` WHERE deleted_at IS NULL ORDER BY `id` DESC');
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        //return $data;


      return view('qrcode', compact('data', 'company', 'path'));
    }
}
