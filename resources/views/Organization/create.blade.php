@extends('adminlayouts.master')
@section('content')

    <style>
        .err {
            color: red;
        }

    </style>

    <div class="page-header">
        <div class="title">
            <h4 class="text-primary">Add Organization List</h4>
        </div>
    </div>

    <form method="post" action="{{ url('organization') }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="pd-20 card-box mb-30">
            <div class="title">
                <h4 class="text-primary">Organization Basic Details</h4>
                <hr>
            </div>
            <br>
            <div class="form-group row mt-3">
                <label class="col-sm-2">Name :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror"
                        value="" placeholder="Enter Name.">
                    @if ($errors->has('name'))
                        <span class="err">
                            <strong>{{ $errors->first('name') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Phone Number :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="phone_no" id="phone_no"
                        class="form-control  @error('phone_no') is-invalid @enderror" value=""
                        placeholder="Enter Phone Number.">
                    @if ($errors->has('phone_no'))
                        <span class="err">
                            <strong>{{ $errors->first('phone_no') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Email ID :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="email_id" id="email_id"
                        class="form-control  @error('email_id') is-invalid @enderror" value=""
                        placeholder="Enter Email ID.">
                    @if ($errors->has('email_id'))
                        <span class="err">
                            <strong>{{ $errors->first('email_id') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Address :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="address" id="address"
                        class="form-control  @error('address') is-invalid @enderror" value="" placeholder="Enter Address.">
                    @if ($errors->has('address'))
                        <span class="err">
                            <strong>{{ $errors->first('address') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Pin Code :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="pin_code" id="pin_code"
                        class="form-control  @error('pin_code') is-invalid @enderror" value=""
                        placeholder="Enter Pin Code.">
                    @if ($errors->has('pin_code'))
                        <span class="err">
                            <strong>{{ $errors->first('pin_code') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">City :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="city" id="city" class="form-control  @error('city') is-invalid @enderror"
                        value="" placeholder="Enter City.">
                    @if ($errors->has('city'))
                        <span class="err">
                            <strong>{{ $errors->first('city') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2 pt-2">State :</label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('state') is-invalid @enderror" name="state" id="state"
                        style="width: 100%; height: 38px;">
                        <option value="">Please Select States </option>
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
                    @if ($errors->has('state'))
                        <span class="err">
                            <strong>{{ $errors->first('state') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">Country :</label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('country') is-invalid @enderror" name="country"
                        id="country" style="width: 100%; height: 38px;">
                        <option value="">Please Select Country </option>
                        <optgroup label="Country">
                            <option value="Active">India</option>
                        </optgroup>
                    </select>
                    @if ($errors->has('country'))
                        <span class="err">
                            <strong>{{ $errors->first('country') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Currency Code :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="currency_code" id="currency_code"
                        class="form-control  @error('currency_code') is-invalid @enderror" value=""
                        placeholder="Enter Currency Code.">
                    @if ($errors->has('currency_code'))
                        <span class="err">
                            <strong>{{ $errors->first('currency_code') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Logo :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="file" name="logo" id="logo" class="form-control  @error('logo') is-invalid @enderror"
                        value="" placeholder="Please Select Logo.">
                    @if ($errors->has('logo'))
                        <span class="err">
                            <strong>{{ $errors->first('logo') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Website :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="website" id="website"
                        class="form-control  @error('website') is-invalid @enderror" value=""
                        placeholder="Ex : www.https://coding_thunder.com.">
                    @if ($errors->has('website'))
                        <span class="err">
                            <strong>{{ $errors->first('website') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2 pt-2">Organization Status :<span style="color:red;"> *</span></label>
                <div class="col-sm-4 col-md-4">
                    <select class="custom-select2 form-control @error('status') is-invalid @enderror" name="status"
                        id="status" style="width: 100%; height: 38px;">
                        <option value="">Please Select Organization Status </option>
                        <optgroup label="Organization Status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </optgroup>
                    </select>
                    @if ($errors->has('status'))
                        <span class="err">
                            <strong>{{ $errors->first('status') }}.</strong>
                        </span>
                    @endif
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
                        class="form-control  @error('quotation') is-invalid @enderror" value=""
                        placeholder="Enter quotation.">
                    @if ($errors->has('quotation'))
                        <span class="err">
                            <strong>{{ $errors->first('quotation') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">Invoice :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="invoice" id="invoice"
                        class="form-control  @error('invoice') is-invalid @enderror" value="" placeholder="Enter Invoice.">
                    @if ($errors->has('invoice'))
                        <span class="err">
                            <strong>{{ $errors->first('invoice') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">Purchase Order :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="purchase_order" id="purchase_order"
                        class="form-control  @error('purchase_order') is-invalid @enderror" value=""
                        placeholder="Enter Purchase Order.">
                    @if ($errors->has('purchase_order'))
                        <span class="err">
                            <strong>{{ $errors->first('purchase_order') }}.</strong>
                        </span>
                    @endif
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
                        class="form-control  @error('bank_detail') is-invalid @enderror" value=""
                        placeholder="Enter Bank Detail.">
                    @if ($errors->has('bank_detail'))
                        <span class="err">
                            <strong>{{ $errors->first('bank_detail') }}.</strong>
                        </span>
                    @endif
                </div>

                <label class="col-sm-2">PAN No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="PAN_No" id="PAN_No" class="form-control  @error('PAN_No') is-invalid @enderror"
                        value="" placeholder="Enter PAN No.">
                    @if ($errors->has('PAN_No'))
                        <span class="err">
                            <strong>{{ $errors->first('PAN_No') }}.</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mt-3">
                <label class="col-sm-2">GST No. :</label>
                <div class="col-sm-4 col-md-4">
                    <input type="text" name="GST_No" id="GST_No" class="form-control  @error('GST_No') is-invalid @enderror"
                        value="" placeholder="Enter GST No.">
                    @if ($errors->has('GST_No'))
                        <span class="err">
                            <strong>{{ $errors->first('GST_No') }}.</strong>
                        </span>
                    @endif
                </div>
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
