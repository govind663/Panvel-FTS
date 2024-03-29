<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class organization extends Model
{
    use HasFactory, SoftDeletes, Loggable;

    protected $table='organization_tbl';
    public $timestamps=false;

    protected $fillable = [
        'name','phone_no','email_id','address','pin_code','city','state','country','currency_code','logo','website','status',
        'quotation','invoice','purchase_order','bank_detail','PAN_No','GST_No','inserted_dt', 'inserted_by', 'modify_dt',
        'modify_by', 'deleted_at', 'deleted_by'
    ];
    protected $dates = ['deleted_at'];
}
