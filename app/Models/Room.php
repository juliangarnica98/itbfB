<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'accommodation_id',
        'amount',
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function type_room(){
        return $this->belongsTo(RoomType::class);
    }

    public function accommodation(){
        return $this->belongsTo(Accommodation::class);
    }

}
