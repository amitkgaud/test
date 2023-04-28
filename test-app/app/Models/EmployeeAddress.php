<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    use HasFactory;
    protected $table = 'employee';

    public $fillable = ['name','emp_id','contact_no','address_line_1','address_line_2','city','state','pincode','status','Wcreated_time','modified_time'];


    public $timestamps = false;
}
