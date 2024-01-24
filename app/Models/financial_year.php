<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class financial_year extends Model
{
    use SoftDeletes;

    protected $table='financial_year_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','status','start_date','end_date','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
