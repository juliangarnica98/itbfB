<?php
namespace App\Repositories;

use App\Models\Accommodation;

class AccommodationRepository{
    
    public function index()
    {   
        return Accommodation::orderBy('id','asc')->paginate(25);
    }

}