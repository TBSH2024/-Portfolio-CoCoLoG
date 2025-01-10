<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'mood',
        'energy_level',
        'sleep_quality',
        'comments'
    ];
}