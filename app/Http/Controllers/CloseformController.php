<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file_master;
use App\Close;
use App\User;
use App\status;
use App\Forward;
use Auth;
use Redirect;
use PDF;
use DB;
use Illuminate\Support\Facades\Validator;

class CloseformController extends Controller
{
    public function index()
    {
        $data = file_master::get();
        $forward = Forward::get();
        $status = status::get();
        $department = User::orderBy('id', 'DESC')->get();
        return view('Close.Close', compact('data', 'forward', 'department', 'status'));
    }
    
    
    public function create()
    {
        
        return view('Close.close_result', compact('department'));
    }
    
    // Store Inword Form data
    public function store(Request $request) {

        $this->validate($request, [
          
        //   'pdf' => 'required|mimes:pdf|max:10000',
        //   'tipani_page' => 'required',
          'method' => 'required',
          'remark' => 'required',
          'file_status' => 'required',
        ],[
           
        //   'pdf.required' => 'Tipani File is required',
        //   'tipani_page.required' => 'Number of Tipani Pages is required',
          'method.required' => 'Method is required',
          'remark.required' => 'Remark / Tipani is required',
          'file_status.required' => 'Close File Status is required',
          ]);
        $data = new Close();
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
        
        $data->user_login =  $request->get('user_login');
        $data->dept_login =  $request->get('dept_login');
        $data->tableno_login =  $request->get('tableno_login');
        $data->file_master_no = $request->get('file_master_no');
        
        $data->method = $request->get('method');
        $data->Peon = $request->get('Peon');
        $data->remark = $request->get('remark');
        $data->tipani_page = $request->get('tipani_page');
        $data->file_status = $request->get('file_status');
        
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by =  $request->get('inserted_by');
        $data->save();
        
        $doc_no = DB::select('UPDATE file_master_tbl
                                SET status = "'.$data->file_status.'", last_frw_by = "'.$data->inserted_by.'",  modify_by = "'.$data->inserted_by.'", modify_dt = "'.$data->inserted_dt.'"
                                WHERE file_master_no = "'.$data->file_master_no.'"
                            ');
                            
       
        return redirect()->route('close_result.index')->with('message', 'Your Record Added Successfully.');
    }
    
    
    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $data = Close::find($id);

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
    //     $data->name = $request->get('name');
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
