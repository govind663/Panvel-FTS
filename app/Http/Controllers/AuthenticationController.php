<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Authentication;
use Redirect;
use PDF;
use DB;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `users` WHERE deleted_at IS NULL ORDER BY `users`.`name` desc ');
        
        //return $data;
        
        return view('Authentication.grid', compact('data'));
    }

    public function create()
    {
        $document_numbering = DB::select('SELECT id as Doc_Id, Next_Doc_No from document_numbering_tbl where document_type = "File" AND financial_year = "5"');
        
        return view('Authentication.create',compact('document_numbering'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Department Name is required',
           'status.required' => 'Department Status is required',
           
          ]);
        $data = new Authentication();
        $data->status = $request->get('status');
        $data->name = $request->get('name');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('Authentication.index')->with('flash_message', 'Your Record Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Authentication::find($id);

        return view('Authentication.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Department Name is required',
           'status.required' => 'Department Status is required',
           
          ]);
        $data = Authentication::find($id);
        $data->status = $request->get('status');
        $data->name = $request->get('name');
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('Authentication.index')->with('flash_message', 'Your Record Updated Successfully');
    }

    public function destroy($id)
    {
        $data = Authentication::find($id)->delete();

        return redirect()->route('Authentication.index')->with('flash_message', 'Your Record Deleted successfully');
    }
}
