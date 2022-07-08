<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'salary_month',
        'salary_year',
        'employee_name',
        'designation',
        'department',
        'joining_date',
        'gross_salary',
        'basic_salary',
        'house_allowance',
        'medical_allowance',
        'transport_allowance',
        'food_allowance',
        'number_of_days',
        'weekend',
        'holiday',
        'need_to_work',
        'present',
        'late',
        'absent',
        'unpaid_leave',
        'paid_leave',
        'need_to_pay',
        'late_deduction',
        'absent_deduction',
        'tax_deduction',
        'provident_fund_deduction',
        'advance_salary_deduction',
        'others_deduction',
        'stamp_deduction',
        'total_deduction',
        'commission_addition',
        'transport_bill_addition',
        'paid_leave_addition',
        'overtime_addition',
        'others_addition',
        'festival_bonus_addition',
        'total_addition',
        'salary_earn',
        'net_salary',
    ];
}
