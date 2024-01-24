<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file_master;
use App\Models\Forward;
use App\Models\User;
use App\Models\status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForwardformController extends Controller
{
    public function index()
    {
        $data = file_master::get();
        $forward = Forward::get();
        $status = status::get();
        $department = User::orderBy('id', 'DESC')->get();
        $user = User::orderBy('id', 'DESC')->get();
        // $all_data_trx = Forward::get();

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

        return view('Forward.forward', compact('data', 'forward', 'department', 'status', 'user', 'all_data_trx', 'path'));
    }


    public function create()
    {
        $user = User::orderBy('id', 'DESC')->get();
        return view('Forward.Forward_result', compact('user'));
    }

    // Store Inword Form data
    public function store(Request $request) {

        $this->validate($request, [
            // 'file_master_no' => 'required',
            'department_name' => 'required',
            'forward_to' => 'required',
            'method' => 'required',
            'fowto_table_no' => 'required',
            'remark' => 'required',
            // 'pdf' => 'required|mimes:pdf|max:10000',
            // 'tipani_page' => 'required',
            // 'inward_status' => 'required',
            'file_status' => 'required',

        ],[
            // 'file_master_no.required' => 'File Master No. is required',
            'department_name.required' => 'Department Name is required',
            'forward_to.required' => 'Forward to is required',
            'method.required' => 'Method is required',
            'fowto_table_no.required' => 'Table Number is required',
            'remark.required' => 'Remark / Tipani is required',
            // 'pdf.required' => 'Upload Tipani is required',
            // 'tipani_page.required' => 'Number of Tipani Pages is required',
            // 'inward_status.required' => 'Inward Status is required.',
            'file_status.required' => 'File Status is required',
          ]);

        $data = new Forward();
        if ($request->hasFile('pdf'))
        {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalName(); // you can also use file name
            $fileName = time().'.'.$extension;
            $path =$_SERVER['DOCUMENT_ROOT']."/myfinalimg/";
            $uplaod = $file->move($path,$extension);

            $data->pdf = $extension;
            //return $fileName;
        }

        $data->file_master_no = $request->get('file_master_no');
        $data->department_name = $request->get('department_name');
        $data->forward_to = $request->get('forward_to');
        $data->method = $request->get('method');
        $data->Peon = $request->get('Peon');
        $data->fowto_table_no = $request->get('fowto_table_no');
        $data->remark = $request->get('remark');
        $data->tipani_page = $request->get('tipani_page');
        $data->file_status = $request->get('file_status');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by =  $request->get('inserted_by');
        $data->user_login =  $request->get('user_login');
        $data->dept_login =  $request->get('dept_login');
        $data->tableno_login =  $request->get('tableno_login');
        $data->file_fwd_status =  0;
        $data->save();


        $doc_no = DB::select('UPDATE file_master_tbl
                                SET status = "'.$data->file_status.'", last_frw_by = "'.$data->inserted_by.'", current_user_id = "'.$data->forward_to.'",  modify_by = "'.$data->inserted_by.'", modify_dt = "'.$data->inserted_dt.'"
                                WHERE file_master_no = "'.$data->file_master_no.'"
                            ');
        // $doc_no = DB::select('UPDATE file_master_tbl
        //                         SET forward_to = "'.$data->forward_to.'",
        //                         WHERE file_master_no = "'.$data->file_master_no.'"
        //                     ');

        return redirect()->route('Forwardform.index')->with('message', 'Your Record Added Successfully.');
    }

    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $data = Forward::find($id);

    //     return view('Forward.edit', compact('data'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //       'department_name' => 'required',
    //       'forward_to' => 'required',
    //       'pdf' => 'required',
    //       'name' => 'required',
    //       'method' => 'required',
    //       'remark' => 'required',
    //     ],[
    //       'department_name.required' => 'Department Name is required',
    //       'forward_to.required' => 'Forward to is required',
    //       'pdf.required' => 'Pdf is required',
    //       'name.required' => 'Number of Tipani Pages is required',
    //       'method.required' => 'Method is required',
    //       'remark.required' => 'Remark / Tipani is required',

    //       ]);
    //     $data = Forward::find($id);
    //     $data->department_name = $request->get('department_name');
    //     $data->forward_to = $request->get('forward_to');
    //     $data->pdf = $request->get('pdf');
    //     $data->name = $request->get('name');
    //     $data->method = $request->get('method');
    //     $data->remark = $request->get('remark');
    //     $data->modify_dt = date('Y-m-d H:i:s');
    //     $data->save();

    //     return redirect()->route('Forwardform.index')->with('flash_message', 'Your Record Updated Successfully');
    // }

    // public function destroy($id)
    // {
    //     $data = Forward::find($id)->delete();

    //     return redirect()->route('Forwardform.index')->with('flash_message', 'Your Record Deleted successfully');
    // }

}
