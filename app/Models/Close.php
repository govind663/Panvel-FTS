<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Close extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='close_data_tbl';
    public $timestamps=false;

    protected $fillable = [
        'remark','pdf','name','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
