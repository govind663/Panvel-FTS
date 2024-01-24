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
use App\financial_year;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class file_masterController extends Controller
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
        
        $data6 = DB::select('SELECT file_master_tbl.id, file_type_tbl.type, users.name, file_master_tbl.file_type,
                                file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                file_master_tbl.date, file_master_tbl.table_no,file_master_tbl.department,
                                file_master_tbl.status, file_master_tbl.inserted_dt, file_master_tbl.inserted_by
                                
                                FROM `file_master_tbl`
                                JOIN file_type_tbl ON file_master_tbl.file_type=file_type_tbl.id
                                LEFT JOIN users ON file_master_tbl.current_user_id=users.id
                                
                                WHERE file_master_tbl.deleted_at IS NULL ORDER BY `id` DESC
                            ');
                            
        // $datacreated;
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        // return $Standing;
        
        

        return view('File Master.grid', compact('data', 'path', 'data1', 'data2', 'data6'));
    }

    public function create()
    {
        $file_type = File_Type::orderBy('id','asc')->where("status" , "Active")->pluck('type', 'id');
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        $financial_year = financial_year::orderBy('id','asc')->pluck('name', 'id');
        
        $document_numbering = DB::select('SELECT id as Doc_Id, Next_Doc_No from document_numbering_tbl where document_type = "File" AND financial_year = "14"');
        // $document_numbering = document_numbering::orderBy('id','asc')->pluck('Next_Doc_No', 'id');
        
        

        return view('File Master.create',compact('file_type', 'status', 'document_numbering', 'financial_year'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_type' => 'required',
            'total_pages_of_tipani' => 'required',
            'total_pages_of_docs' => 'required',
            'subject' => 'required',
            'file_detail' => 'required',
            'financial_year' => 'required'
            // 'pdf' => 'required|mimes:pdf|max:10000',
            // 'reference' => 'required',
            // 'reference_no' => 'required',
            // 'reference_date' => 'required',
            // 'created_by' => 'required',
            // 'department' => 'required',
            // 'table_no' => 'required',
            // 'status' => 'required',
            // 'date' => 'required',
        ],[
            'file_type.required' => 'File Type is required',
            'total_pages_of_tipani.required' => 'Total Pages Of Tipani is required',
            'total_pages_of_docs.required' => 'Total Pages Of Docs is required',
            'subject.required' => 'Subject is required',
            'file_detail.required' => 'File Detail is required',
            'financial_year' => 'Financial Year is required',
            // 'pdf.required' => 'File Upload is required',
            // 'reference.required' => 'Reference is required',
            // 'reference_no.required' => 'Reference Number is required',
            // 'reference_date.required' => 'Reference Date is required',
            // 'created_by.required' => 'Created By Name is required',
            // 'department.required' => 'Department Name is required',
            // 'table_no.required' => 'Table Number is required',
            // 'status.required' => 'Status is required',
            // 'date.required' => 'Date is required',
          ]);
        $data = new file_master();


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
        
        //   $fy_year =  "SELECT name FROM `financial_year_tbl`
        //                 where start_date <='".date('Y-m-d')."' And end_date >='".date('Y-m-d')."' 
        //                 ";
        //  $cur = $fy-ye
        
        // $current_financialyear = DB::select("SELECT t2.prefix 
        //                                         FROM `financial_year_tbl` AS t1 
        //                                         JOIN document_numbering_tbl AS t2 ON t1.id = t2.financial_year 
        //                                     ");
                                            
        // $current_financialyear = document_numbering::orderBy('id','asc')->pluck('prefix');    
        
        // return $current_financialyear;
        
        $data->file_type = $request->get('file_type');
            $data->total_pages_of_tipani = $request->get('total_pages_of_tipani');
            $data->total_pages_of_docs = $request->get('total_pages_of_docs');
            $data->subject = $request->get('subject');
            $data->file_detail = $request->get('file_detail');
            $data->reference = $request->get('reference');
            $data->reference_no = $request->get('reference_no');
            $data->reference_date = $request->get('reference_date');
            $data->created_by = $request->get('created_by');
            $data->department = $request->get('department');
            $data->table_no = $request->get('table_no');
            $data->current_user_id = Auth::user()->id;
            $data->status = $request->get('status');
            $data->reminder = $request->get('reminder');
            $data->date = $request->get('date');
            $data->inserted_dt = date('Y-m-d H:i:s');
            $data->inserted_by = Auth::user()->id;
            $data->file_master_no = "FTS".date('Y').'/'.$request->get('file_master_no');
            $data->financial_year = $request->get('financial_year');
            $data->save();

            $Next_Doc_No = $request->get('file_master_no')+1;
            $Doc_id =  $request->get('Doc_Id');
            $doc_no = DB::select('UPDATE document_numbering_tbl
                                  SET Next_Doc_No = "'.$Next_Doc_No.'"
                                  WHERE id = "'.$Doc_id.'"
                                 ');
            session(['file_master_msg' => 'File Master Number is : '.$data->file_master_no.' ']);
        
        
        return redirect()->route('file_master.index')->with('message', 'Your File Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = file_master::find($id);
        // return $data;
        $datafile = $data->file_master_no;
        // $datatrx = array();


        $datatrxfw = DB::select('SELECT * from forward_data_tbl Where file_master_no ="'.$datafile.'"');
        $datatrxinw = DB::select('SELECT * from close_data_tbl Where file_master_no ="'.$datafile.'"');

        //return $datatrx1;
        // return $data1;

        $datacreated = DB::select('SELECT file_master_tbl.id, department_tbl.name, file_master_tbl.file_type,
                                                   file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                                   file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                                   file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                                   file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                                   file_master_tbl.last_frw_by, file_master_tbl.table_no,
                                                   file_master_tbl.status, file_master_tbl.inserted_dt

                                                   FROM `file_master_tbl`
                                                   JOIN department_tbl ON file_master_tbl.department=department_tbl.id
                                                   WHERE file_master_tbl.deleted_at IS NULL AND file_master_tbl.file_master_no ="'.$datafile.'"');
        // return $datacreated;

        $dataclosed = DB::select('SELECT close_data_tbl.id, department_tbl.name, close_data_tbl.file_master_no,

                                    close_data_tbl.user_login,  close_data_tbl.tableno_login,
                                    close_data_tbl.method, close_data_tbl.remark, close_data_tbl.pdf,
                                    close_data_tbl.file_status, close_data_tbl.tipani_page,
                                    close_data_tbl.inserted_dt

                                    FROM `close_data_tbl`
                                    JOIN department_tbl ON close_data_tbl.dept_login=department_tbl.id
                                    WHERE close_data_tbl.deleted_at IS NULL AND close_data_tbl.file_master_no ="'.$datafile.'"');
        //return $dataclosed;

        $all_data_trx = DB::select('
                        SELECT COALESCE(forward_data_tbl.id, inward_data_tbl.id) id,

                        COALESCE(forward_data_tbl.file_master_no, inward_data_tbl.file_master_no) file_master_no,
                        COALESCE(forward_data_tbl.user_login, inward_data_tbl.from_person) from_emp,
                        COALESCE(forward_data_tbl.dept_login, inward_data_tbl.from_dept) from_dept,
                        COALESCE(forward_data_tbl.tableno_login, inward_data_tbl.from_table_no) from_tableno,

                        COALESCE(forward_data_tbl.forward_to, inward_data_tbl.user_login) for_emp,
                        COALESCE(forward_data_tbl.department_name, inward_data_tbl.dept_login ) for_dept ,
                        COALESCE(forward_data_tbl.fowto_table_no, inward_data_tbl.tableno_login ) for_tableno,

                        COALESCE(forward_data_tbl.file_status, inward_data_tbl.file_status ) file_status,
                        COALESCE(forward_data_tbl.method, inward_data_tbl.method ) method,
                        COALESCE(forward_data_tbl.Peon, inward_data_tbl.Peon ) user_details,
                        COALESCE(forward_data_tbl.tipani_page, inward_data_tbl.tipani_page ) tipani_page,
                        COALESCE(forward_data_tbl.pdf, inward_data_tbl.pdf ) tipani_file,

                        COALESCE(forward_data_tbl.remark, inward_data_tbl.remark ) remark,
                        COALESCE(forward_data_tbl.inserted_dt, inward_data_tbl.inserted_dt) inserted_dt,

                        dpt_1.name as from_departmentname,
                        dpt_2.name as for_departmentname,
                        dpt_3.name as for_usersname

                        FROM (
                            SELECT "forward__tbl" AS source, id FROM forward_data_tbl where file_master_no ="'.$datafile.'"
                            UNION
                            SELECT "inward__tbl" AS source, id FROM inward_data_tbl where file_master_no ="'.$datafile.'"
                            ) ad
                        LEFT JOIN forward_data_tbl ON ad.id = forward_data_tbl.id AND ad.source = "forward__tbl"
                        LEFT JOIN inward_data_tbl ON ad.id = inward_data_tbl.id AND ad.source = "inward__tbl"
                        left join department_tbl dpt_1 on forward_data_tbl.dept_login = dpt_1.id OR inward_data_tbl.from_dept = dpt_1.id
                        left join department_tbl dpt_2 on inward_data_tbl.dept_login = dpt_2.id OR forward_data_tbl.department_name = dpt_2.id

                        left join users dpt_3 on forward_data_tbl.forward_to = dpt_3.id OR inward_data_tbl.inserted_by = dpt_3.id

                        ORDER BY inserted_dt DESC'
                    );

        //return $all_data_trx;

        $file_type = File_Type::orderBy('id','asc')->where("status" , "Active")->pluck('type', 'id');
        //return $file_type;
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        //return $status;
        $document_numbering = document_numbering::orderBy('id','asc')->pluck('Next_Doc_No', 'id');
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";

        $financial_year = financial_year::orderBy('id','asc')->pluck('name', 'id');
        //return $data;

        return view('File Master.edit', compact('data', 'file_type', 'status', 'path', 'datatrxfw', 'datatrxinw', 'all_data_trx', 'document_numbering', 'datacreated', 'dataclosed', 'financial_year'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file_type' => 'required',
            'total_pages_of_tipani' => 'required',
            'total_pages_of_docs' => 'required',
            'subject' => 'required',
            'file_detail' => 'required',
            'financial_year' => 'required'
            // 'pdf' => 'required|mimes:pdf|max:10000',
            // 'reference' => 'required',
            // 'reference_no' => 'required',
            // 'reference_date' => 'required',
            // 'created_by' => 'required',
            // 'department' => 'required',
            // 'table_no' => 'required',
            // 'status' => 'required',
            // 'date' => 'required',
        ],[
            'file_type.required' => 'File Type is required',
            'total_pages_of_tipani.required' => 'Total Pages Of Tipani is required',
            'total_pages_of_docs.required' => 'Total Pages Of Docs is required',
            'subject.required' => 'Subject is required',
            'file_detail.required' => 'File Detail is required',
            'financial_year' => 'Financial Year is required',
            // 'pdf.required' => 'File Upload is required',
            // 'reference.required' => 'Reference is required',
            // 'reference_no.required' => 'Reference Number is required',
            // 'reference_date.required' => 'Reference Date is required',
            // 'created_by.required' => 'Created By Name is required',
            // 'department.required' => 'Department Name is required',
            // 'table_no.required' => 'Table Number is required',
            // 'status.required' => 'Status is required',
            // 'date.required' => 'Date is required',
          ]);

        $data = file_master::find($id);

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

        $data->file_type = $request->get('file_type');
        $data->total_pages_of_tipani = $request->get('total_pages_of_tipani');
        $data->total_pages_of_docs = $request->get('total_pages_of_docs');
        $data->subject = $request->get('subject');
        $data->file_detail = $request->get('file_detail');
        $data->reference = $request->get('reference');
        $data->reference_no = $request->get('reference_no');
        $data->reference_date = $request->get('reference_date');
        $data->created_by = $request->get('created_by');
        $data->department = $request->get('department');
        $data->table_no = $request->get('table_no');
        $data->status = $request->get('status');
        $data->reminder = $request->get('reminder');
        $data->date = $request->get('date');
        $data->file_master_no = $request->get('file_master_no');
        $data->financial_year = $request->get('financial_year');
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('file_master.index')->with('message', 'Your File Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = file_master::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('file_master.index')->with('message', 'Your File Deleted Successfully.');
    }
    
    
    public function File_Master_Log_History($id)
    {
        $data = file_master::find($id);
        // return $data;
        $datafile = $data->file_master_no;
        // $datatrx = array();


        $datatrxfw = DB::select('SELECT * from forward_data_tbl Where file_master_no ="'.$datafile.'"');
        $datatrxinw = DB::select('SELECT * from close_data_tbl Where file_master_no ="'.$datafile.'"');

        //return $datatrx1;
        // return $data1;

        $datacreated = DB::select('SELECT file_master_tbl.id, department_tbl.name, file_master_tbl.file_type,
                                                   file_master_tbl.file_master_no, file_master_tbl.total_pages_of_tipani,
                                                   file_master_tbl.total_pages_of_docs, file_master_tbl.subject,
                                                   file_master_tbl.file_detail, file_master_tbl.pdf, file_master_tbl.reference,
                                                   file_master_tbl.reference_no, file_master_tbl.reference_date, file_master_tbl.created_by,
                                                   file_master_tbl.last_frw_by, file_master_tbl.table_no,
                                                   file_master_tbl.status, file_master_tbl.inserted_dt

                                                   FROM `file_master_tbl`
                                                   JOIN department_tbl ON file_master_tbl.department=department_tbl.id
                                                   WHERE file_master_tbl.deleted_at IS NULL AND file_master_tbl.file_master_no ="'.$datafile.'"');
        // return $datacreated;

        $dataclosed = DB::select('SELECT close_data_tbl.id, department_tbl.name, close_data_tbl.file_master_no,

                                    close_data_tbl.user_login,  close_data_tbl.tableno_login,
                                    close_data_tbl.method, close_data_tbl.remark, close_data_tbl.pdf,
                                    close_data_tbl.file_status, close_data_tbl.tipani_page,
                                    close_data_tbl.inserted_dt

                                    FROM `close_data_tbl`
                                    JOIN department_tbl ON close_data_tbl.dept_login=department_tbl.id
                                    WHERE close_data_tbl.deleted_at IS NULL AND close_data_tbl.file_master_no ="'.$datafile.'"');
        //return $dataclosed;

        $all_data_trx = DB::select('
                        SELECT COALESCE(forward_data_tbl.id, inward_data_tbl.id) id,

                        COALESCE(forward_data_tbl.file_master_no, inward_data_tbl.file_master_no) file_master_no,
                        COALESCE(forward_data_tbl.user_login, inward_data_tbl.from_person) from_emp,
                        COALESCE(forward_data_tbl.dept_login, inward_data_tbl.from_dept) from_dept,
                        COALESCE(forward_data_tbl.tableno_login, inward_data_tbl.from_table_no) from_tableno,

                        COALESCE(forward_data_tbl.forward_to, inward_data_tbl.user_login) for_emp,
                        COALESCE(forward_data_tbl.department_name, inward_data_tbl.dept_login ) for_dept ,
                        COALESCE(forward_data_tbl.fowto_table_no, inward_data_tbl.tableno_login ) for_tableno,

                        COALESCE(forward_data_tbl.file_status, inward_data_tbl.file_status ) file_status,
                        COALESCE(forward_data_tbl.method, inward_data_tbl.method ) method,
                        COALESCE(forward_data_tbl.Peon, inward_data_tbl.Peon ) user_details,
                        COALESCE(forward_data_tbl.tipani_page, inward_data_tbl.tipani_page ) tipani_page,
                        COALESCE(forward_data_tbl.pdf, inward_data_tbl.pdf ) tipani_file,

                        COALESCE(forward_data_tbl.remark, inward_data_tbl.remark ) remark,
                        COALESCE(forward_data_tbl.inserted_dt, inward_data_tbl.inserted_dt) inserted_dt,

                        dpt_1.name as from_departmentname,
                        dpt_2.name as for_departmentname,
                        dpt_3.name as for_usersname

                        FROM (
                            SELECT "forward__tbl" AS source, id FROM forward_data_tbl where file_master_no ="'.$datafile.'"
                            UNION
                            SELECT "inward__tbl" AS source, id FROM inward_data_tbl where file_master_no ="'.$datafile.'"
                            ) ad
                        LEFT JOIN forward_data_tbl ON ad.id = forward_data_tbl.id AND ad.source = "forward__tbl"
                        LEFT JOIN inward_data_tbl ON ad.id = inward_data_tbl.id AND ad.source = "inward__tbl"
                        left join department_tbl dpt_1 on forward_data_tbl.dept_login = dpt_1.id OR inward_data_tbl.from_dept = dpt_1.id
                        left join department_tbl dpt_2 on inward_data_tbl.dept_login = dpt_2.id OR forward_data_tbl.department_name = dpt_2.id

                        left join users dpt_3 on forward_data_tbl.forward_to = dpt_3.id OR inward_data_tbl.inserted_by = dpt_3.id

                        ORDER BY inserted_dt DESC'
                    );

        //return $all_data_trx;

        $file_type = File_Type::orderBy('id','asc')->where("status" , "Active")->pluck('type', 'id');
        //return $file_type;
        $status = status::orderBy('id','asc')->pluck('name', 'id');
        //return $status;
        $document_numbering = document_numbering::orderBy('id','asc')->pluck('Next_Doc_No', 'id');
        
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        // return $path;
        
        $financial_year = financial_year::orderBy('id','asc')->pluck('name', 'id');
        //return $data;

        return view('File Master.log_history', compact('data', 'file_type', 'status', 'path', 'datatrxfw', 'datatrxinw', 'all_data_trx', 'document_numbering', 'datacreated', 'dataclosed', 'financial_year'));
    }

}
