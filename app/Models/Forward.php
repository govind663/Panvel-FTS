<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Forward extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='forward_data_tbl';
    public $timestamps=false;

    protected $fillable = [
        'department_name','file_master_no','user_login','dept_login','tableno_login','forward_to','method','fowto_table_no','remark','pdf','tipani-page','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
