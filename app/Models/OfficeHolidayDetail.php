<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeHolidayDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'holiday_id',
        'holiday_date',
        'remarks'
    ];
}
