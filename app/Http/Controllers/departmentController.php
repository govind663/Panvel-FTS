<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\department;
use Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class departmentController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `department_tbl` WHERE deleted_at IS NULL ORDER BY `department_tbl`.`name` ASC');
        //return $data;

        return view('Department.grid', compact('data'));
    }

    public function create()
    {
        return view('Department.create');
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

        $data = new department();
        $data->status = $request->get('status');
        $data->name = $request->get('name');
        $data->inserted_dt = date("Y-m-d H:i:s");
        $data->inserted_by = Auth::user()->id;
        $data->save();

        return redirect()->route('department.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = department::find($id);

        return view('Department.edit', compact('data'));
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
        $data = department::find($id);
        $data->status = $request->get('status');
        $data->name = $request->get('name');
        $data->modify_dt = date("Y-m-d H:i:s");
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('department.index')->with('flash_message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = department::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('department.index')->with('flash_message', 'Your Record Deleted Successfully.');
    }
}
