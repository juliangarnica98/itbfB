<?php
namespace App\Repositories;

use App\Models\Room;

class RoomRepository{

    public function index($hotel)
    {   
        return Room::where('hotel_id',$hotel)->with(['hotel','type_room','accommodation'])->orderBy('id','asc')->paginate();
    }

    public function create(array $storeData)
    {
        return Room::create($storeData);
    }
}