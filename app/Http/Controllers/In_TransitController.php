<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\department;
use App\file_master;
use App\File_Type;
use App\status;
use App\table_no;
use App\User;
use App\Forward;
use App\Inward;
use App\Close;
use App\document_numbering;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class In_TransitController extends Controller
{
    public function index()
    {
        $data1 = Forward::orderBy('id', 'DESC')->get();
        $data2 = DB::select('SELECT * FROM `file_master_tbl` WHERE deleted_at IS NULL ORDER BY `id` DESC');
        $data = DB::select('SELECT file_master_tbl.id, users.name, file_master_tbl.file_type,
                                    file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                    file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                    file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                    file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                    file_master_tbl.date, file_master_tbl.table_no,
                                    file_master_tbl.status, file_master_tbl.inserted_dt

                                    FROM `file_master_tbl`
                                    JOIN users ON file_master_tbl.last_frw_by=users.id
                                    WHERE file_master_tbl.deleted_at IS NULL
                                ');
        DB::enableQueryLog();

        $data6 = DB::select('SELECT file_master_tbl.id, file_type_tbl.type, users.name, forward_data_tbl.id AS forward_id, 
                                forward_data_tbl.forward_to, forward_data_tbl.inserted_by As from_persion, file_master_tbl.file_type,
                                file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                file_master_tbl.date, file_master_tbl.table_no,file_master_tbl.department,
                                file_master_tbl.status, file_master_tbl.inserted_dt, file_master_tbl.inserted_by
                                
                                FROM forward_data_tbl
                                LEFT JOIN `file_master_tbl` ON forward_data_tbl.file_master_no = file_master_tbl.file_master_no
                                LEFT JOIN users ON forward_data_tbl.forward_to=users.id
                                JOIN file_type_tbl ON file_master_tbl.file_type=file_type_tbl.id
                                
                                WHERE file_master_tbl.deleted_at IS NULL 
                                AND file_master_tbl.status = "12"
                                AND forward_data_tbl.file_fwd_status = "0"
                                AND (forward_data_tbl.inserted_by = "'.Auth::user()->id.'" OR forward_data_tbl.forward_to = "'.Auth::user()->id.'")
                                
                                ORDER BY forward_data_tbl.`id` DESC
                            ');
        // return $data6;
        // dd(DB::getQueryLog());
        
        // $datacreated;
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        // return $Standing;
        
        $in_transit_file = DB::select('SELECT
                                            fdt.id AS forward_id,
                                            fdt.file_master_no AS forward_file_master_no,
                                            
                                            fdt.user_login AS from_user,
                                            department_tbl.name AS from_dept_name,
                                            fdt.tableno_login AS from_table_no,
                                            
                                            department_tbl.name AS to_dept_name,
                                            users.name AS to_user_name,
                                            fdt.fowto_table_no AS to_table_no,
                                            
                                            fdt.method AS forward_method,
                                            fdt.Peon AS forward_peon,
                                            
                                            fdt.remark AS forward_remark,
                                            fdt.pdf AS forward_pdf,
                                            fdt.tipani_page AS forward_tipani_page,
                                            fdt.file_status AS forward_file_status,
                                            fdt.file_fwd_status AS file_forw_status
                                        FROM
                                            forward_data_tbl as fdt
                                        JOIN department_tbl ON fdt.dept_login = department_tbl.id
                                        
                                        LEFT JOIN users ON fdt.forward_to = users.id
                                        
                                        WHERE
                                            fdt.deleted_at IS NULL
                                        ORDER BY
                                            fdt.id
                                        DESC
                                    ');
        
        // return $data6;

        return view('In Transit.grid', compact('data', 'path', 'data1', 'data2', 'data6', 'in_transit_file'));
    }

    public function edit($id)
    {
        $data = Forward::find($id);
        
        $data6 = DB::select('SELECT file_master_tbl.id, file_type_tbl.type, users.name, forward_data_tbl.id AS forward_id, file_master_tbl.file_type,
                                file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                file_master_tbl.date, file_master_tbl.table_no,file_master_tbl.department,
                                file_master_tbl.status, file_master_tbl.inserted_dt, file_master_tbl.inserted_by
                                
                                FROM `file_master_tbl`
                                JOIN file_type_tbl ON file_master_tbl.file_type=file_type_tbl.id
                                LEFT JOIN users ON file_master_tbl.current_user_id=users.id
                                LEFT JOIN forward_data_tbl ON file_master_tbl.inserted_by=forward_data_tbl.inserted_by
                                
                                WHERE file_master_tbl.deleted_at IS NULL ORDER BY `id` DESC
                            ');
        
        // $data = file_master::get();
        $department = User::orderBy('id','asc')->pluck('name', 'id');
        $department_name = department::orderBy('id','asc')->where("status" , "Active")->pluck('name', 'id');
        // $forward = Forward::get();
        $status = status::orderBy('id','asc')->pluck('name', 'id');

        return view('In Transit.edit', compact('data', 'data6', 'department', 'department_name', 'status'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     // 'file_master_no' => 'required',
        //     'department_name' => 'required',
        //     'forward_to' => 'required',
        //     'method' => 'required',
        //     'Peon' => 'required',
        //     'fowto_table_no' => 'required',
        //     'remark' => 'required',
        //     // 'pdf' => 'required|mimes:pdf|max:10000',
        //     // 'tipani_page' => 'required',
        //     // 'inward_status' => 'required',
        //     'file_status' => 'required',
          
        // ],[
        //     // 'file_master_no.required' => 'File Master No. is required',
        //     'department_name.required' => 'Department Name is required',
        //     'forward_to.required' => 'Forward to is required',
        //     'method.required' => 'Method is required',
        //     'Peon.required' => 'Peon is required',
        //     'fowto_table_no.required' => 'Table Number is required',
        //     'remark.required' => 'Remark / Tipani is required',
        //     // 'pdf.required' => 'Upload Tipani is required',
        //     // 'tipani_page.required' => 'Number of Tipani Pages is required',
        //     // 'inward_status.required' => 'Inward Status is required.',
        //     'file_status.required' => 'File Status is required',
        //   ]);
          
        $data = Forward::find($id);
        
        if ($request->hasFile('pdf'))
        {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time().'.'.$extension;
            $path =$_SERVER['DOCUMENT_ROOT']."/myfinalimg/";
            $uplaod = $file->move($path,$fileName);

            $data->pdf = $fileName;
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
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->modify_by =  $request->get('inserted_by');
        $data->user_login =  $request->get('user_login');
        $data->dept_login =  $request->get('dept_login');
        $data->tableno_login =  $request->get('tableno_login');
        $data->file_fwd_status =  0;
        $data->save();
        
        $doc_no = DB::select('UPDATE file_master_tbl
                                SET status = "'.$data->file_status.'", last_frw_by = "'.$data->inserted_by.'", current_user_id = "'.$data->forward_to.'",  modify_by = "'.$data->inserted_by.'", modify_dt = "'.$data->inserted_dt.'"
                                WHERE file_master_no = "'.$data->file_master_no.'"
                            ');

        return redirect()->route('in_transit.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = Forward::find($id)->delete();
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('in_transit.index')->with('message', 'Your Record Deleted Successfully.');
    }

}
