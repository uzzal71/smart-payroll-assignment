<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_id',
        'form_date',
        'to_date',
        'leave_days',
        'leave_month',
        'leave_year',
        'active'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function leave() {
        return $this->belongsTo(Leave::class);
    }
}
