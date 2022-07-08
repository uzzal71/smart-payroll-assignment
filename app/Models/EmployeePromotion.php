<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'designation_id',
        'promotion_month',
        'promotion_year',
        'effective_date',
        'remarks',
        'status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
