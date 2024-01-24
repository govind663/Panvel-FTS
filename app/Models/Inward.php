<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inward extends Model
{
    use SoftDeletes;

    protected $table='inward_data_tbl';
    public $timestamps=false;

    protected $fillable = [
        'from_dept','file_master_no','user_login','dept_login','from_table_no','from_person','method','inwto_table_no','remark','pdf','tipani-page','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
