<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class file_master extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='file_master_tbl';
    public $timestamps=false;

    protected $fillable = [
        'file_type','total_pages_of_tipani','total_pages_of_docs', 'subject', 'file_detail', 'pdf',
        'reference', 'reference_no', 'reference_date', 'created_by', 'department', 'table_no',
        'status','reminder','date','inserted_dt', 'inserted_by', 'modify_dt', 'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
