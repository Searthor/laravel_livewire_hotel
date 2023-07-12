<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_name',
        'staff_type_id',
        'address',
        'contact_no',
        'salary',
    ];
}
