<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'employee_id_card',
        'employee_punch_card',
        'mobile',
        'employee_status',
        'department_id',
        'designation_id',
        'schedule_id',
        'status',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function salary() {
        return $this->hasOne(SalaryInformation::class);
    }

    public function education() {
        return $this->hasOne(EducationInformation::class);
    }

    public function bank() {
        return $this->hasOne(BankInformation::class);
    }

    public function experience() {
        return $this->hasOne(ExperienceInformation::class);
    }
}
