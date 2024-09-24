<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_name',
        'agency_status',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
