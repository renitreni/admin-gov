<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rescue extends Model
{
    use HasFactory;

    protected $fillable = [
        'passport',
        'rescue_description',
        'location',
        'rescue_status',
        'rescue_remarks',
        'edited_by',
    ];
}
