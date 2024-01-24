<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\organization;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class organizationController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM `organization_tbl` WHERE deleted_at IS NULL ORDER BY `id` DESC');
        $path="https://".$_SERVER['HTTP_HOST']."/umc-fts/image/";
        // return $Standing;

        return view('Organization.grid', compact('data', 'path'));
    }

    public function create()
    {
        return view('Organization.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000000',
          'status' => 'required',
        ],[
           'name.required' => 'Organization Name is required',
           'status.required' => 'Organization Status is required',
           'logo.required' => 'Organization logo is required',
          ]);

        $data = new organization();
        if ($request->hasFile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time().'.'.$extension;
            $path = $_SERVER['DOCUMENT_ROOT']."/umc-fts/image/";
            $uplaod = $file->move($path,$fileName);

            $data->logo = $fileName;
            $data->name = $request->get('name');
            $data->phone_no = $request->get('phone_no');
            $data->email_id = $request->get('email_id');
            $data->address = $request->get('address');
            $data->pin_code = $request->get('pin_code');
            $data->city = $request->get('city');
            $data->state = $request->get('state');
            $data->country = $request->get('country');
            $data->currency_code = $request->get('currency_code');
            $data->website = $request->get('website');
            $data->status = $request->get('status');
            $data->quotation = $request->get('quotation');
            $data->invoice = $request->get('invoice');
            $data->purchase_order = $request->get('purchase_order');
            $data->bank_detail = $request->get('bank_detail');
            $data->PAN_No = $request->get('PAN_No');
            $data->GST_No = $request->get('GST_No');
            $data->inserted_dt = date('Y-m-d H:i:s');
            $data->inserted_by = Auth::user()->id;
            $data->save();
        }

        return redirect()->route('organization.index')->with('message', 'Your Record Added Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = organization::find($id);
        $path = "https://".$_SERVER['HTTP_HOST']."/umc-fts/image/";

        return view('Organization.edit', compact('data', 'path'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //   'name' => 'required',
        //   'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000000',
        //   'status' => 'required',
        // ],[
        //   'name.required' => 'Organization Name is required',
        //   'status.required' => 'Organization Status is required',
        //   'logo.required' => 'Organization logo is required',
        //   ]);

        $data = organization::find($id);
        if ($request->hasFile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time().'.'.$extension;
            $path = $_SERVER['DOCUMENT_ROOT']."/umc-fts/image/";
            $uplaod = $file->move($path,$fileName);
            //echo $fileName;
            // exit;

            $data->logo = $fileName;

        }

        $data->name = $request->get('name');
        $data->phone_no = $request->get('phone_no');
        $data->email_id = $request->get('email_id');
        $data->address = $request->get('address');
        $data->pin_code = $request->get('pin_code');
        $data->city = $request->get('city');
        $data->state = $request->get('state');
        $data->country = $request->get('country');
        $data->currency_code = $request->get('currency_code');
        $data->website = $request->get('website');
        $data->status = $request->get('status');
        $data->quotation = $request->get('quotation');
        $data->invoice = $request->get('invoice');
        $data->purchase_order = $request->get('purchase_order');
        $data->bank_detail = $request->get('bank_detail');
        $data->PAN_No = $request->get('PAN_No');
        $data->GST_No = $request->get('GST_No');
        $data->modify_dt = date('Y-m-d H:i:s');
        $data->modify_by = Auth::user()->id;
        $data->save();

        return redirect()->route('organization.index')->with('message', 'Your Record Updated Successfully.');
    }

    public function destroy($id)
    {
        $data = organization::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('organization.index')->with('message', 'Your Record Deleted Successfully.');
    }
}
