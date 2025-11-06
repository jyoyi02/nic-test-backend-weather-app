<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Location extends Authenticatable

{
    use HasFactory, HasApiTokens;

    protected $fillable = ['name', 'latitude', 'longitude'];

    protected $hidden = ['password'];

    public function weather()
    {
        return $this->hasMany(Weather::class);
    }
}
