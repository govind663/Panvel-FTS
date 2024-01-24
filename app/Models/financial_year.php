<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class financial_year extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='financial_year_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','status','start_date','end_date','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
