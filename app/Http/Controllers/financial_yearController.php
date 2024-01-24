<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\financial_year;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class financial_yearController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `financial_year_tbl` WHERE deleted_at IS NULL ORDER BY `financial_year_tbl`.`name` DESC');
        // return $Standing;

        return view('Financial-Year.grid', compact('data'));
    }

    public function create()
    {
        return view('Financial-Year.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'status' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
        ],[
           'name.required' => 'Name is required',
           'status.required' => 'Status is required',
           'start_date.required' => 'Start Date is required',
           'end_date.required' => 'End Date is required',
          ]);
        $data = new financial_year();
        $data->name = $request->get('name');
        $data->status = $request->get('status');
        $data->start_date = $request->get('start_date');
        $data->end_date = $request->get('end_date');
        $data->inserted_dt = date("Y-m-d H:i:s");
        $data->inserted_by = Auth::user()->id;
        $data->save();

        return redirect()->route('financial_year.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = financial_year::find($id);

        return view('Financial-Year.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
          'status' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
        ],[
           'name.required' => 'Name is required',
           'status.required' => 'Status is required',
           'start_date.required' => 'Start Date is required',
           'end_date.required' => 'End Date is required',
          ]);
        $data = financial_year::find($id);
        $data->name = $request->get('name');
        $data->status = $request->get('status');
        $data->start_date = $request->get('start_date');
        $data->end_date = $request->get('end_date');
        $data->modify_dt = date("Y-m-d H:i:s");
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('financial_year.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = financial_year::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('financial_year.index')->with('message', 'Your Record Deleted Successfully.');
    }
}
