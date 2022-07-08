<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_leave_id',
        'employee_id',
        'leave_id',
        'leave_date',
        'remarks'
    ];
}
