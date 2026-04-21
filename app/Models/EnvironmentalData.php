<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalData extends Model
{
    protected $fillable = [
        'department',
        'municipality',
        'temperature',
        'humidity',
        'air_quality',
        'co2_levels',
        'recommendations',
        'record_date'
    ];
}