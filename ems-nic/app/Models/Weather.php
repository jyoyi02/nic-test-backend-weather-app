<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Weather extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'location_id',
        'temperature',
        'humidity',
        'wind_speed',
        'precipitation'
    ];

    protected $hidden = ['password'];

    public function location()
{
    return $this->belongsTo(Location::class);
}

}
