@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }
    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Edit Organization List</h4>
        </div>
    </div>
    <form method="post" action="{{ route('organization.update', $data->id) }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if (!empty($data->id) || 1 == 1)
            <input type="hidden" name="_method" value="PATCH">
        @endif

        <input type="hidden" id="id" name="id" value="{{ $data['id'] or '' }}">

        <div class="pd-20 card-box mb-30">
            <div class="title">
                <h4 class="text-primary">Organization Basic Details</h4>
                <hr>
            </div>
            <br>
            <div class="form-group row mt-3">
                <label class="col-sm-2">Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $data->name }}" placeholder="Enter Name.">
                </div>
        
                <label class="col-sm-2">Phone Number :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="phone_no" id="phone_no"
                        class="form-control " value="{{ $data->phone_no }}"
                        placeholder="Enter Phone Number.">
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">Email ID :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="email_id" id="email_id"
                        class="form-control" value="{{ $data->email_id }}"
                        placeholder="Enter Email ID.">
                </div>
        
                <label class="col-sm-2">Address :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="address" id="address"
                        class="form-control" value="{{ $data->address }}" placeholder="Enter Address.">
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">Pin Code :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="pin_code" id="pin_code"
                        class="form-control" value="{{ $data->pin_code }}"
                        placeholder="Enter Pin Code.">
                </div>
        
                <label class="col-sm-2">City :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="city" id="city" class="form-control"
                        value="{{ $data->city }}" placeholder="Enter City.">
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2">State :</label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control" name="state" id="state"
                        style="width: 100%; height: 38px;">
                        <option value="">{{ $data->state }} </option>
                        <optgroup label="States">
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Puducherry">Puducherry</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                        </optgroup>
                    </select>
                </div>
        
                <label class="col-sm-2 pt-2">Country :</label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control " name="country"
                        id="country" style="width: 100%; height: 38px;">
                        <option value="">{{ $data->country }}</option>
                        <optgroup label="Country">
                            <option value="India">India</option>
                        </optgroup>
                    </select>
                    
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">Currency Code :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="currency_code" id="currency_code"
                        class="form-control " value="{{ $data->currency_code }}"
                        placeholder="Enter Currency Code.">
                </div>
        
                <label class="col-sm-2">Logo :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="file" name="logo" id="logo" class="form-control"
                        value="" placeholder="Please Select Logo.">
                    <img src="{{ $path.$data->logo }}" class="img-thumbnail" style="height: 80px; width: 80px;" />
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">Website :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="website" id="website"
                        class="form-control" value="{{ $data->website }}"
                        placeholder="Ex : www.https://coding_thunder.com.">
                </div>
        
                <label class="col-sm-2 pt-2">Organization Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control" name="status"
                        id="status" style="width: 100%; height: 38px;">
                        <option value="{{ $data->status }}" selected>{{ $data->status }} </option>
                        <optgroup label="Organization Status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="pd-20 card-box mb-30">
            <div class="title">
                <h4 class="text-primary">Terms & Conditions</h4>
                <hr>
            </div>
            <br>
            <div class="form-group row mt-3">
                <label class="col-sm-2">Quotation :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="quotation" id="quotation"
                        class="form-control" value="{{ $data->quotation }}"
                        placeholder="Enter quotation.">
                </div>
        
                <label class="col-sm-2">Invoice :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="invoice" id="invoice"
                        class="form-control" value="{{ $data->invoice }}" placeholder="Enter Invoice.">
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">Purchase Order :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="purchase_order" id="purchase_order"
                        class="form-control" value="{{ $data->purchase_order }}"
                        placeholder="Enter Purchase Order.">
                </div>
            </div>
        </div>
        
        <div class="pd-20 card-box mb-30">
            <div class="title">
                <h4 class="text-primary">Bank Details</h4>
                <hr>
            </div>
            <br>
            <div class="form-group row mt-3">
                <label class="col-sm-2">Bank Detail :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="bank_detail" id="bank_detail"
                        class="form-control" value="{{ $data->bank_detail }}"
                        placeholder="Enter Bank Detail.">
                </div>
        
                <label class="col-sm-2">PAN No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="PAN_No" id="PAN_No" class="form-control"
                        value="{{ $data->PAN_No }}" placeholder="Enter PAN No.">
                </div>
            </div>
        
            <div class="form-group row mt-3">
                <label class="col-sm-2">GST No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="GST_No" id="GST_No" class="form-control"
                        value="{{ $data->GST_No }}" placeholder="Enter GST No.">
            </div>
        
            <div class="form-group row mt-4">
                <label class="col-md-3"></label>
                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                    <a href="{{ url('organization') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>

@endsection