<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File_Type;
use App\Models\file_master;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class File_TypeController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `file_type_tbl` WHERE deleted_at IS NULL ORDER BY `file_type_tbl`.`id` ASC ');
        // return $Standing;

        return view('File-Type.grid', compact('data'));
    }

    public function create()
    {
        return view('File-Type.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [

          'type' => 'required',
          'status' => 'required',

        ],[
           'type.required' => 'Type is required',
           'status.required' => 'Status is required',

          ]);
        $data = new File_Type();
        $data->status = $request->get('status');
        $data->type = $request->get('type');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by = Auth::user()->id;
        $data->save();

        return redirect()->route('file_type.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = File_Type::find($id);

        return view('File-Type.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'type' => 'required',
          'status' => 'required',

        ],[
           'type.required' => 'Type is required',
           'status.required' => 'Status is required',
          ]);
        $data = File_Type::find($id);
        $data->status = $request->get('status');
        $data->type = $request->get('type');
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('file_type.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = File_Type::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('file_type.index')->with('message', 'Your Record Deleted Successfully.');
    }

    public function qr($id)
    {
        $data = file_master::find($id);
        $path = "https://".$_SERVER['HTTP_HOST']."/myfinalimg/";
        // return $Standing;
        //echo $data;
        return view( compact('data', 'path'));
    }
}
