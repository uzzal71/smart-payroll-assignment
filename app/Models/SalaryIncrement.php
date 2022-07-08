<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryIncrement extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'gross_salary',
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'transport_allowance',
        'food_allowance',
        'increment_month',
        'increment_year',
        'effective_date',
        'remarks',
        'status'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
