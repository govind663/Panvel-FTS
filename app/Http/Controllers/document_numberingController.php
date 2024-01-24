<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document_numbering;
use App\Models\financial_year;
use App\Models\organization;
use Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class document_numberingController extends Controller
{
    public function index()
    {
        //$data = DB::select('SELECT * FROM `document_numbering_tbl` WHERE deleted_at IS NULL ORDER BY `id` DESC');
        $data = DB::select ('SELECT dnt.*, fyt.name  as financial_year, ot.name  as company

                             FROM document_numbering_tbl as dnt

                             left JOIN financial_year_tbl as fyt on fyt.id = dnt.financial_year
                             left JOIN organization_tbl as ot on ot.id = dnt.company

                             WHERE dnt.deleted_at IS NULL
                             ORDER BY `dnt`.`id` ASC
                            ');
        // return $data;

        return view('Document Numbering.grid', compact('data'));
    }

    public function create()
    {
        $financial_year = financial_year::orderBy('id','asc')->pluck('name', 'id');
        $organization = organization::orderBy('id', 'asc')->pluck('name', 'id');

        return view('Document Numbering.create', compact('financial_year', 'organization'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'company' => 'required',
          'document_type' => 'required',
          'financial_year' => 'required',
          'prefix' => 'required',
          'suffix' => 'required',
          'Start_Doc_No' => 'required',
          'End_Doc_No' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Name is required',
           'company.required' => 'Company Name is required',
           'document_type.required' => 'Document Type is required',
           'financial_year.required' => 'Financial Year is required',
           'prefix.required' => 'Prefix is required',
           'suffix.required' => 'Suffix is required',
           'Start_Doc_No.required' => 'Start Document Number is required',
           'End_Doc_No.required' => 'End Document Number is required',
           'status.required' => 'Status is required',
          ]);

        $data = new document_numbering();
        $data->name = $request->get('name');
        $data->company = $request->get('company');
        $data->document_type = $request->get('document_type');
        $data->financial_year = $request->get('financial_year');
        $data->prefix = $request->get('prefix');
        $data->suffix = $request->get('suffix');
        $data->Start_Doc_No = $request->get('Start_Doc_No');
        $data->Next_Doc_No = $request->get('Start_Doc_No');
        $data->End_Doc_No = $request->get('End_Doc_No');
        $data->status = $request->get('status');
        $data->inserted_dt = date('Y-m-d H:i:s');
        $data->inserted_by = Auth::user()->id;
        $data->save();

        return redirect()->route('document_numbering.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = document_numbering::find($id);
        $financial_year = financial_year::orderBy('id','asc')->pluck('name', 'id');
        $organization = organization::orderBy('id', 'asc')->pluck('name', 'id');
        // return $financial_year;
        // return $organization;

        return view('Document Numbering.edit', compact('data', 'financial_year', 'organization'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
          'company' => 'required',
          'document_type' => 'required',
          'financial_year' => 'required',
          'prefix' => 'required',
          'suffix' => 'required',
          'Start_Doc_No' => 'required',
          'End_Doc_No' => 'required',
          'status' => 'required',
        ],[
           'name.required' => 'Name is required',
           'company.required' => 'Company Name is required',
           'document_type.required' => 'Document Type is required',
           'financial_year.required' => 'Financial Year is required',
           'prefix.required' => 'Prefix is required',
           'suffix.required' => 'Suffix is required',
           'Start_Doc_No.required' => 'Start Document Number is required',
           'End_Doc_No.required' => 'End Document Number is required',
           'status.required' => 'Status is required',
          ]);
        $data = document_numbering::find($id);
        $data->name = $request->get('name');
        $data->company = $request->get('company');
        $data->document_type = $request->get('document_type');
        $data->financial_year = $request->get('financial_year');
        $data->prefix = $request->get('prefix');
        $data->suffix = $request->get('suffix');
        $data->Start_Doc_No = $request->get('Start_Doc_No');
        $data->End_Doc_No = $request->get('End_Doc_No');
        $data->Next_Doc_No += $request->get('Start_Doc_No');
        $data->status = $request->get('status');
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('document_numbering.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = document_numbering::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('document_numbering.index')->with('message', 'Your Record Deleted Successfully.');
    }
}
