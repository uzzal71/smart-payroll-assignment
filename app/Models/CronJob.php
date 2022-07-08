<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'cron_job_month',
        'cron_job_year',
        'month_year',
        'status',
    ];
}
