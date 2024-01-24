<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\status;
use Redirect;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class statusController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `status_tbl` WHERE deleted_at IS NULL ORDER BY `id` DESC');
        // return $Standing;
        
        return view('Status.grid', compact('data'));
    }

    public function create()
    {
        return view('Status.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
        //   'follow_up' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Name is required',
        //   'follow_up.required' => 'Follow Up is required',
           'status.required' => 'Status is required',
           
          ]);
        $data = new status();
        $data->status = $request->get('status');
        // $data->follow_up = $request->get('follow_up');
        $data->name = $request->get('name');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by = Auth::user()->id;
        $data->save();

        return redirect()->route('status.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = status::find($id);

        return view('Status.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
        //   'follow_up' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Name is required',
        //   'follow_up.required' => 'Follow Up is required',
           'status.required' => 'Status is required',
           
          ]);
        $data = status::find($id);
        $data->status = $request->get('status');
        // $data->follow_up = $request->get('follow_up');
        $data->name = $request->get('name');
        $data->modify_dt = date("Y-m-d H:i:s");
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('status.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = status::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('status.index')->with('message', 'Your Record Deleted Successfully.');
    }
}
