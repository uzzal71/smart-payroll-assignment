<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'payment_month',
        'payment_year',
        'amount',
        'status',
        'remarks'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
