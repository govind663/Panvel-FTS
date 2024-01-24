<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File_Type extends Model
{
    use SoftDeletes;

    protected $table='file_type_tbl';
    public $timestamps=false;

    protected $fillable = [
        'type','status','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
