<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class status extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='status_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','follow_up','status','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
