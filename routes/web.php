<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForwardController;
use App\Http\Controllers\mis_user_wiseController;
use App\Http\Controllers\Error_PageController;

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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password Password
Route::get('forget-password', 'Auth\ForgotPasswordController@getEmail');
Route::post('forget-password', 'Auth\ForgotPasswordController@postEmail');

// Password reset routes...
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'Auth\ResetPasswordController@updatePassword');
/* -------------------------------Authenticate ending here ---------------------------------------- */

Route::group(['middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/index', [HomeController::class, 'index'])->name('index');
    Route::get('/d', 'HomeController@d')->name('d');

    // Profile
    Route::get('/check', 'UserController@userOnlineStatus');

    /* ---------------------------------------Setup start here.----------------------------------- */
    Route::resource('/user', 'Auth\RegisterController');
    Route::resource('/Authentication', 'AuthenticationController');
    Route::resource('/financial_year', 'financial_yearController');
    Route::resource('/department', 'departmentController');
    Route::resource('/status', 'statusController');
    Route::resource('/organization', 'organizationController');
    Route::resource('/document_numbering', 'document_numberingController');


    /* --------------------------------------- File Master ----------------------------------- */
    Route::resource('/file_master', 'file_masterController');
    Route::get('/file_master_log_history/{id}','file_masterController@File_Master_Log_History');
    Route::get('/generate-qrcode/{id}','QrCodeController@index');
    Route::get('/Department_Details/{id}','Department_DetailsController@Department_Details');

    Route::get('/Inward', 'InwardController@Inward');
    Route::get('/Inwardsearch', 'InwardController@search')->name('Inwardsearch');
    Route::resource('/Inwardform', 'InwardformController');

    Route::get('/Forward', 'ForwardController@Forward');
    Route::get('/Forwardsearch', 'ForwardController@forwardsearch')->name('Forwardsearch');
    Route::resource('/Forwardform', 'ForwardformController');
    Route::post('api/department-user', [ForwardController::class, 'DepartmentUser']);
    Route::post('department-table-no', [ForwardController::class, 'DepartmentUserTableNumber']);

    Route::resource('/in_transit', 'In_TransitController');

    Route::get('/Close', 'CloseController@Close');
    Route::get('/Closefilesearch', 'CloseController@Closedsearch')->name('Closefilesearch');
    Route::resource('/close_result', 'CloseformController');

    /* ---------------------------------------Master File start here.----------------------------------- */
    Route::resource('/file_type', 'File_TypeController');

    /* --------------------------------------- Report ----------------------------------- */
    Route::get('/MIS', 'MISController@MIS');
    Route::get('/mis_department_user_wise/{id}', 'MISController@mis_department_user_wise');
    Route::get('/mis_user_wise', 'mis_user_wiseController@mis_user_wise');
    Route::get('/file_status', 'file_statusController@file_status');
    Route::get('/check_file_history', 'file_statusController@check_file_history')->name('check_file_history');
    Route::post('/check_file_history_search', 'file_statusController@Check_File_History_Search')->name('check_file_history_search');

    // ----------------------------- search user management ------------------------------//
    Route::post('search/user/list', [mis_user_wiseController::class, 'searchUser'])->name('search/user/list');

});




/* ---------------------------------------Error Pages start here.---------------------------------- */
Route::get('/400_Error', [Error_PageController::class, '400_Error'])->name('400_Error');
Route::get('/403_Error', [Error_PageController::class, '403_Error'])->name('403_Error');
Route::get('/404_Error', [Error_PageController::class, '404_Error'])->name('404_Error');
Route::get('/500_Error', [Error_PageController::class, '500_Error'])->name('500_Error');
Route::get('/503_Error', [Error_PageController::class, '503_Error'])->name('503_Error');
