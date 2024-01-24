<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class department extends Model
{
    use SoftDeletes;

    protected $table='department_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','status','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
