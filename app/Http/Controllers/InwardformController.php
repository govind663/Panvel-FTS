<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file_master;
use App\Models\Inward;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InwardformController extends Controller
{
    public function index()
    {
        $data = file_master::get();
        return view('Inward.Inward', compact('data'));
    }


    public function create()
    {
        return view('Inward.Inward_result');
    }

    // Store Inword Form data
    public function store(Request $request) {

        $this->validate($request, [
            // 'pdf' => 'required|mimes:pdf|max:10000',
            'method' => 'required',
            'remark' => 'required',
            'file_status' => 'required',
            // 'tipani_page' => 'required',
        ],[
            'method.required' => 'Method is required',
            'remark.required' => 'Remark / Tipani is required',
            'file_status.required' => 'Inward File Status is required',
            // 'tipani_page.required' => 'Number of Tipani Pages is required',
            // 'pdf.required' => 'Upload Tipani is required',
          ]);

        $data = new Inward();
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

        $data->from_dept = $request->get('from_dept');
        $data->from_person = $request->get('from_person');
        $data->from_table_no = $request->get('from_table_no');
        $data->file_fwrd_id =  $request->get('file_fwrd_id');

        $data->user_login =  $request->get('user_login');
        $data->dept_login =  $request->get('dept_login');
        $data->tableno_login =  $request->get('tableno_login');

        $data->method = $request->get('method');
        $data->Peon = $request->get('Peon');
        $data->remark = $request->get('remark');
        $data->tipani_page = $request->get('tipani_page');
        $data->file_status = $request->get('file_status');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by =  $request->get('inserted_by');
        $data->save();


        $doc_no = DB::select('UPDATE file_master_tbl
                                SET status = "'.$data->file_status.'",  last_frw_by = "'.$data->inserted_by.'", modify_by = "'.$data->inserted_by.'", modify_dt = "'.$data->inserted_dt.'"
                                WHERE file_master_no = "'.$data->file_master_no.'"
                            ');

        $doc_forwd = DB::select('UPDATE forward_data_tbl
                                SET file_fwd_status = "1",  modify_by = "'.$data->inserted_by.'", modify_dt = "'.$data->inserted_dt.'"
                                WHERE id = "'.$data->file_fwrd_id.'"
                            ');

        return redirect()->route('Inwardform.index')->with('message', 'Your Record Added Successfully.');
    }

    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $data = File_Type::find($id);

    //     return view('File-Type.edit', compact('data'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //       'method' => 'required',
    //       'status' => 'required',
    //     ],[
    //       'method.required' => 'Method is required',
    //       'remark.required' => 'Remark is required',

    //       ]);
    //     $data = Inward::find($id);
    //     $data->method = $request->get('method');
    //     $data->remark = $request->get('remark');
    //     $data->modify_dt = date('Y-m-d H:i:s');
    //     $data->save();

    //     return redirect()->route('Inwardform.index')->with('flash_message', 'Your Record Updated Successfully');
    // }

    // public function destroy($id)
    // {
    //     $data = Inward::find($id)->delete();

    //     return redirect()->route('Inwardform.index')->with('flash_message', 'Your Record Deleted successfully');
    // }

}
