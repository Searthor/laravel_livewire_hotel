<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_type extends Model
{



    use HasFactory;


    protected $fillable = [
        'room_types',
        'price',
    ];


    protected $hidden = [
        "created_at",
        "updated_at",

    ];
}
