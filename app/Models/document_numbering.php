<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class document_numbering extends Model
{
    use SoftDeletes;

    protected $table='document_numbering_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','company','document_type','financial_year','prefix','suffix','Start_Doc_No','End_Doc_No','status','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
