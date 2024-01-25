<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\financial_yearController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\organizationController;
use App\Http\Controllers\document_numberingController;
use App\Http\Controllers\file_masterController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Department_DetailsController;
use App\Http\Controllers\InwardController;
use App\Http\Controllers\InwardformController;
use App\Http\Controllers\ForwardController;
use App\Http\Controllers\ForwardformController;
use App\Http\Controllers\mis_user_wiseController;
use App\Http\Controllers\Error_PageController;
use App\Http\Controllers\In_TransitController;
use App\Http\Controllers\CloseController;
use App\Http\Controllers\CloseformController;
use App\Http\Controllers\File_TypeController;
use App\Http\Controllers\MISController;
use App\Http\Controllers\file_statusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

/* -------------------------------Authenticate starting here -------------------------------------- */
// User Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

// User Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/store', [LoginController::class, 'authenticate'])->name('login.store');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('dept_logout');

// Forgot Password Password
Route::get('/forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('/forget-password/store', [ForgotPasswordController::class, 'postEmail'])->name('forget-password.store');

// Password reset routes...
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->where('token','[0-9a-zA-Z]+')->name('reset-password');
Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset-password.update');

/* -------------------------------Authenticate ending here ---------------------------------------- */

Route::group(['middleware' => ['auth', 'preventBackHistoryMiddleware']], function() {

    // Dashboard
    Route::get('/index', [HomeController::class, 'index'])->name('admin_dashboard');

    // Upload File Directory
    Route::get('/d', [HomeController::class, 'd'])->name('upload_file_d');

    /* ------------User Online Status ------------ */
    Route::get('/check', [UserController::class, 'userOnlineStatus'])->name('UserOnlineStatus');

    /* ---------------------------------------Setup start here.----------------------------------- */
    Route::resource('/users', RegisterController::class);
    Route::resource('/financial_year', financial_yearController::class);
    Route::resource('/department', departmentController::class);
    Route::resource('/status', statusController::class);
    Route::resource('/organization', organizationController::class);
    Route::resource('/document_numbering', document_numberingController::class);


    /* --------------------------------------- File Master ----------------------------------- */
    Route::resource('/file_master', file_masterController::class);
    Route::get('/file_master_log_history/{id}', [file_masterController::class, 'File_Master_Log_History'])->name('File_Master_Log_History');

    Route::get('/generate-qrcode/{id}', [QrCodeController::class, 'index'])->name('generate-qrcode');
    Route::get('/Department_Details/{id}', [Department_DetailsController::class, 'Department_Details'])->name('Department_Details');

    Route::get('/Inward', [InwardController::class, 'Inward'])->name('Inward');
    Route::get('/Inwardsearch', [InwardController::class, 'search'])->name('Inwardsearch');
    Route::resource('/Inwardform', InwardformController::class);

    Route::get('/Forward', [ForwardController::class, 'Forward'])->name('Forward');
    Route::get('/Forwardsearch', [ForwardController::class, 'forwardsearch'])->name('Forwardsearch');
    Route::resource('/Forwardform', ForwardformController::class);
    Route::post('api/department-user', [ForwardController::class, 'DepartmentUser']);
    Route::post('department-table-no', [ForwardController::class, 'DepartmentUserTableNumber']);

    Route::resource('/in_transit', In_TransitController::class);

    Route::get('/Close', [CloseController::class, 'Close'])->name('Close');
    Route::get('/Closefilesearch', [CloseController::class, 'Closedsearch'])->name('Closefilesearch');
    Route::resource('/close_result', CloseformController::class);

    /* ---------------------------------------Master File start here.----------------------------------- */
    Route::resource('/file_type', File_TypeController::class);

    /* --------------------------------------- Report ----------------------------------- */
    Route::get('/MIS', [MISController::class, 'MIS'])->name('MIS');
    Route::get('/mis_department_user_wise/{id}', [MISController::class, 'mis_department_user_wise'])->name('mis_department_user_wise');
    Route::get('/mis_user_wise', [mis_user_wiseController::class, 'mis_user_wise'])->name('mis_user_wise');
    Route::get('/file_status', [file_statusController::class, 'file_status'])->name('file_status');
    Route::get('/check_file_history', [file_statusController::class, 'check_file_history'])->name('check_file_history');
    Route::post('/check_file_history_search', [file_statusController::class, 'check_file_history_search'])->name('check_file_history_search');

    // ----------------------------- search user management ------------------------------//
    Route::post('search/user/list', [mis_user_wiseController::class, 'searchUser'])->name('search/user/list');

});

/* ---------------------------------------Error Pages start here.---------------------------------- */
Route::get('/400_Error', [Error_PageController::class, '400_Error'])->name('400_Error');
Route::get('/403_Error', [Error_PageController::class, '403_Error'])->name('403_Error');
Route::get('/404_Error', [Error_PageController::class, '404_Error'])->name('404_Error');
Route::get('/500_Error', [Error_PageController::class, '500_Error'])->name('500_Error');
Route::get('/503_Error', [Error_PageController::class, '503_Error'])->name('503_Error');
