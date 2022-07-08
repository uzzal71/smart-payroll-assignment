<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'attendance_month',
        'attendance_year',
        'need_to_work',
        'present',
        'absent',
        'unpaid_leave',
        'paid_leave',
        'need_to_pay'
    ];
}
