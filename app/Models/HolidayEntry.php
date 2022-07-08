<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_date',
        'to_date',
        'holiday_days',
        'holiday_month',
        'holiday_year',
        'remarks',
        'status'
    ];
}
