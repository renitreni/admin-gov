<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Worker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix_name', 
        'passport_number',
        'passport_expiry_date',
        'visa_type',
        'visa_number',
        'visa_expiry_date',
        'national_id_number',
        'residency_address',
        'emergency_contact_name', 
        'emergency_contact_phone',
        'emergency_contact_relationship'
    ];

    public static function booted() {
        static::creating(function ($model) {
            $model->worker_uuid = Str::uuid();
        });
    }

    public function fullname(): Attribute
    {
        return Attribute::make(get: fn ($value, $row) => $row['first_name'] . ' ' . $row['last_name']);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
