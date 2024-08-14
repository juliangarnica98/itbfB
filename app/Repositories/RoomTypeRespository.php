<?php
namespace App\Repositories;

use App\Models\RoomType;

class RoomTypeRepository{
    
    public function index()
    {   
        return RoomType::orderBy('id','asc')->paginate(25);
    }

}