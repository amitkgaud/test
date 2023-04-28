<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    public $fillable = ['name','department_id','status','created_time','modified_time'];
    public $timestamps = false;
}
