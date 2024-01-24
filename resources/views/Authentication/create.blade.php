@extends('adminlayouts.master')
@section('content')

<style>
    .err {
        color: red;
    }
</style>

<div class="page-header">
    <div class="title">
        <h4 class="text-primary">Add User Role & Permissions</h4>
    </div>
</div>
<div class="pd-20 card-box mb-30">
    <form method="post" action="{{ url('file_master') }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        @foreach ($document_numbering as $key => $file_doctype)
        <input hidden readonly name="file_master_no" id="file_master_no"
            class="form-control  @error('Next_Doc_No') is-invalid @enderror" value="{{$file_doctype->Next_Doc_No}}"
            placeholder="">
        <input hidden readonly name="Doc_Id" id="Doc_Id" class="form-control  @error('Doc_Id') is-invalid @enderror"
            value="{{$file_doctype->Doc_Id}}" placeholder="">
        @endforeach

        <!--begin::Body-->
        <div class="card-body">
            <div class="row">
                <table class="table table-bordered nowrap">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="text-primary">Sr. No.</th>
                            <th scope="col" rowspan="2" class="text-primary">Role</th>
                            <th scope="col" colspan="3" class="text-primary">Action</th>
                        </tr>
                        <tr>
                            <th scope="col" style="width:170px;" class="text-primary">
                                List<br>
                                <div style="font-weight:normal">
                                    <a href="javascript:;" onclick="selectAll('list');">Select All</a> /
                                    <a href="javascript:;" onclick="deselectAll('list');">Deselect
                                        All</a>
                                </div>
                            </th>
                            <th scope="col" style="width:170px;" class="text-primary">Add<br>
                                <div style="font-weight:normal">
                                    <a href="javascript:;" onclick="selectAll('add');">Select All</a> /
                                    <a href="javascript:;" onclick="deselectAll('add');">Deselect
                                        All</a>
                                </div>
                            </th>
                            <th scope="col" style="width:170px;" class="text-primary">Edit / Delete<br>
                                <div style="font-weight:normal">
                                    <a href="javascript:;" onclick="selectAll('edit');">Select All</a> /
                                    <a href="javascript:;" onclick="deselectAll('edit');">Deselect
                                        All</a>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DEBUG-VIEW START 1 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                1 <input type="hidden" name="menu_id[]" value="1">
                                <input type="hidden" name="authorization_id[]" value="1833">
                            </td>
                            <td><a href="javascript:;" onclick="selectRoleAllAction(1);"
                                    title="Click to select all actions">Dashboard</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_1" value="1" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_1" value="1" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_1" value="1" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 1 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 2 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <tr>
                            <td class="text-center">2</td>
                            <td><b class="text-primary">Setup</b></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 2 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <!-- DEBUG-VIEW START 3 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                3 <input type="hidden" name="menu_id[]" value="4">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(4);"
                                    title="Click to select all actions">User</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_4" value="4" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_4" value="4" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_4"
                                        value="4" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 3 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 4 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                4 <input type="hidden" name="menu_id[]" value="5">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(5);"
                                    title="Click to select all actions">Authorization</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_5"
                                        value="5" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_5" value="5" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_5"
                                        value="5" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 4 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 5 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                5 <input type="hidden" name="menu_id[]" value="8">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(8);"
                                    title="Click to select all actions">Financial&nbsp;Year</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_8"
                                        value="8" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_8" value="8" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_8"
                                        value="8" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 5 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 6 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                6 <input type="hidden" name="menu_id[]" value="11">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(11);"
                                    title="Click to select all actions">Department</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_11"
                                        value="11" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_11"
                                        value="11" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_11"
                                        value="11" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 6 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 7 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                7 <input type="hidden" name="menu_id[]" value="13">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(13);"
                                    title="Click to select all actions">Status</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_13"
                                        value="13" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_13"
                                        value="13" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_13"
                                        value="13" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 7 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 8 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                8 <input type="hidden" name="menu_id[]" value="14">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(14);"
                                    title="Click to select all actions">Organization</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_14"
                                        value="14" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_14"
                                        value="14" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_14"
                                        value="14" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 8 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 9 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                9 <input type="hidden" name="menu_id[]" value="15">
                                <input type="hidden" name="authorization_id[]" value="">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(15);"
                                    title="Click to select all actions">Document&nbsp;Numbering</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_15"
                                        value="15" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_15"
                                        value="15" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_15"
                                        value="15" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 9 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 10 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <tr>
                            <td class="text-center">10</td>
                            <td><b class="text-primary">Master</b></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 10 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <!-- DEBUG-VIEW START 11 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                11 <input type="hidden" name="menu_id[]" value="16">
                                <input type="hidden" name="authorization_id[]" value="1834">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(16);"
                                    title="Click to select all actions">File Type</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_16"
                                        value="16" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_16"
                                        value="16" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_16"
                                        value="16" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 11 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 12 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <tr>
                            <td class="text-center">12</td>
                            <td><b class="text-primary">File</b></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 12 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <!-- DEBUG-VIEW START 13 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                13 <input type="hidden" name="menu_id[]" value="18">
                                <input type="hidden" name="authorization_id[]" value="1835">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(18);"
                                    title="Click to select all actions">File Master</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_18"
                                        value="18" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_18"
                                        value="18" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_18"
                                        value="18" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 13 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 14 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                14 <input type="hidden" name="menu_id[]" value="19">
                                <input type="hidden" name="authorization_id[]" value="1836">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(19);"
                                    title="Click to select all actions">Inward</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_19"
                                        value="19" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_19"
                                        value="19" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_19"
                                        value="19" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 14 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 15 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                15 <input type="hidden" name="menu_id[]" value="20">
                                <input type="hidden" name="authorization_id[]" value="1837">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(20);"
                                    title="Click to select all actions">Forward</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_20"
                                        value="20" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_20"
                                        value="20" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_20"
                                        value="20" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 15 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 16 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                16 <input type="hidden" name="menu_id[]" value="23">
                                <input type="hidden" name="authorization_id[]" value="1838">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(23);"
                                    title="Click to select all actions">Close</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_23"
                                        value="23" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_23"
                                        value="23" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_23"
                                        value="23" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 16 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 17 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <tr>
                            <td class="text-center">17</td>
                            <td><b class="text-primary">Report</b></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 17 APPPATH/Config/../Views/admin/role_heading_row.php -->
                        <!-- DEBUG-VIEW START 18 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                18 <input type="hidden" name="menu_id[]" value="22">
                                <input type="hidden" name="authorization_id[]" value="1839">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(22);"
                                    title="Click to select all actions">MIS</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_22"
                                        value="22" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_22"
                                        value="22" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_22"
                                        value="22" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 18 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 19 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                19 <input type="hidden" name="menu_id[]" value="24">
                                <input type="hidden" name="authorization_id[]" value="1840">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(24);"
                                    title="Click to select all actions">MIS - Employee Wise</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_24"
                                        value="24" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_24"
                                        value="24" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_24"
                                        value="24" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 19 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <!-- DEBUG-VIEW START 20 APPPATH/Config/../Views/admin/role_action_row.php -->
                        <tr>
                            <td class="text-center">
                                20 <input type="hidden" name="menu_id[]" value="25">
                                <input type="hidden" name="authorization_id[]" value="1841">
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="selectRoleAllAction(25);"
                                    title="Click to select all actions">File Status</a></td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="list_chkbx" name="is_list[]" id="is_list_25"
                                        value="25" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="add_chkbx" name="is_add[]" id="is_add_25"
                                        value="25" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="checkbox checkbox-lg">
                                    <input type="checkbox" class="edit_chkbx" name="is_edit[]" id="is_edit_25"
                                        value="25" />
                                    <span class="m-auto"></span>
                                </label>
                            </td>
                        </tr>
                        <!-- DEBUG-VIEW ENDED 20 APPPATH/Config/../Views/admin/role_action_row.php -->
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Body-->
        <div class="form-group row mt-4">
            <label class="col-md-3"></label>
            <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                <a href="{{ url('Authentication') }}" class="btn btn-danger"
                    onclick="saveChanges();">Cancel</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">Save
                    Changes</button>
            </div>
        </div>

    </form>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function confirmation() {
                var result = confirm("Are you sure to delete?");
                if (result) {
                    // Delete logic goes here
                }
            }
</script>
<script>
    "use strict";
            // Class definition
            function selectAll(action) {
                $('.' + action + '_chkbx').prop('checked', true);
            }

            function deselectAll(action) {
                $('.' + action + '_chkbx').prop('checked', false);
            }

            function selectRoleAllAction(rno) {
                $('#is_list_' + rno).prop('checked', true);
                $('#is_add_' + rno).prop('checked', true);
                $('#is_edit_' + rno).prop('checked', true);
            }

            function saveChanges() {
                blockPage();
                $('#user_role_form').submit();
            }
</script>
@endsection('scripts')