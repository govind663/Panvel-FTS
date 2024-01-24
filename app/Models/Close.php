<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Close extends Model
{
    use SoftDeletes;

    protected $table='close_data_tbl';
    public $timestamps=false;

    protected $fillable = [
        'remark','pdf','name','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
