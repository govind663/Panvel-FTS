<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\LogRepository;

class RegisterController extends Controller
{
    protected $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = User::orderBy('id', 'DESC')->get();
        $data = DB::select('SELECT users.id, department_tbl.name as department_name, users.name,
                                    users.user_type, users.mobile_no,
                                    users.table_no, users.username,
                                    users.email,users.status

                                    FROM `users`

                                    JOIN department_tbl ON users.department=department_tbl.id
                                    WHERE users.deleted_at IS NULL ORDER BY `id` DESC
                                ');
        // return $data1;
        return view('auth.User_Management.register_grid', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = department::orderBy('id','asc')->where('status','=','active')->whereNull('deleted_by')->pluck('name', 'id');
        return view('auth.User_Management.register_create',compact('department'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
          'user_type' => 'required|string:max:5000',
          'mobile_no' => 'required',
          'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
          'department' => 'required|string:max:5000',
          'table_no' => 'required|numeric|string:max:5000',
        //   'username' => 'required|string:max:5000',
          'password' => 'required|string|min:8|confirmed',
          'password_confirmation' => 'required',
          'status' => 'required',
        ],[
          'name.required' => 'Name is required',
          'user_type.required' => 'User Type is required',
          'mobile_no.required' => 'Mobile Number is required',
          'email.required' => 'Email id is required',
        //   'username.required' => 'Username is required',
          'department.required' => 'Department is required',
          'table_no.required' => 'Table Number is required',
          'password.required' => 'Password is required',
          'password_confirmation.required' => 'Password confirmation is required',
          'status.required' => 'Status is required',
          ]);

        $data = new User();
        $data->name = $request->get('name');
        $data->user_type = $request->get('user_type');
        $data->mobile_no = $request->get('mobile_no');
        $data->email = $request->get('email');
        // $data->username = $request->get('username');
        $data->department = $request->get('department');
        $data->table_no = $request->get('table_no');
        $data->password = Hash::make($request->get('password'));
        $data->status = $request->get('status');
        $data->created_at = date('Y-m-d H:i:s');
        $data->inserted_by = Auth::user()->id;
        $data->save();

        $this->logRepository->insertLog(Auth::guard('web')->user()->id, 'users', 'register');

        return redirect()->route('user.index')->with('message', 'Your Record Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // $data1 =  department::orderBy('id', 'DESC')->get();
        $audit_mst = department::orderBy('id','asc')->pluck('name', 'id');
        //return $audit_mst;
        $data = User::find($id);

        return view('auth.User_Management.register_edit', compact('audit_mst', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
          'user_type' => 'required|string:max:5000',
          'mobile_no' => 'required',
          'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
          'department' => 'required|string:max:5000',
          'table_no' => 'required|numeric|string:max:5000',
        //   'username' => 'required|string:max:5000',
        //   'password' => 'required|string|min:8|confirmed',
        //   'password_confirmation' => 'required',
          'status' => 'required',
        ],[
          'name.required' => 'Name is required',
          'user_type.required' => 'User Type is required',
          'mobile_no.required' => 'Mobile Number is required',
          'email.required' => 'Email id is required',
        //   'username.required' => 'Username is required',
          'department.required' => 'Department is required',
          'table_no.required' => 'Table Number is required',
        //   'password.required' => 'Password is required',
        //   'password_confirmation.required' => 'Password confirmation is required',
          'status.required' => 'Status is required',
          ]);
        $data = User::find($id);

        $data->name = $request->get('name');
        $data->user_type = $request->get('user_type');
        $data->mobile_no = $request->get('mobile_no');
        $data->email = $request->get('email');
        // $data->username = $request->get('username');
        $data->department = $request->get('department');
        $data->table_no = $request->get('table_no');
        // $data->password = Hash::make($request->get('password'));
        // $data->password = $request->get('password');
        $data->status = $request->get('status');
        $data->updated_at  = date('Y-m-d H:i:s');
        $data->modify_by = Auth::user()->id;
        $data->save();


        return redirect()->route('user.index')->with('message', 'Your Record Updated Successfully');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->deleted_by = Auth::user()->id;
        $data->deleted_at = date("Y-m-d H:i:s");
        $data->update();

        return redirect()->route('user.index')->with('message', 'Your Record Deleted successfully');
    }

//   public function register()
//   {

//     return view('auth.register');
//   }

//   public function store(Request $request)
//   {
//       $request->validate([
//           'name' => 'required|string|max:255',
//           'email' => 'required|string|email|max:255|unique:users',
//           'password' => 'required|string|min:8|confirmed',
//           'password_confirmation' => 'required',
//       ]);

//       User::create([
//           'name' => $request->name,
//           'email' => $request->email,
//           'password' => Hash::make($request->password),
//       ]);

//       return redirect('login')->with('message', 'You are Register Succefully.');
//   }

}
