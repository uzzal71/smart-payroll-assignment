<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_name',
        'office_start',
        'office_late_start',
        'office_late_end',
        'office_end',
        'office_over_time_start',
        'office_over_time_end',
        'status',
    ];
}
