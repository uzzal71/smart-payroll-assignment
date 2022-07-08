<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_full_name',
        'company_short_name',
        'owner_name',
        'phone',
        'email',
        'address'
    ];
}
