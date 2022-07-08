<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'attendance_month',
        'attendance_year',
        'attendance_date',
        'in_time',
        'out_time',
        'late_time',
        'attendance_status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
