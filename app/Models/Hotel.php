<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rooms',
        'address',
        'nit',
        'city_id',
    ];

    public function cities(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
