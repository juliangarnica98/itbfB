<?php
namespace App\Repositories;

use App\Models\City;

class CityRepository{
    
    public function index()
    {   
        return City::orderBy('id','asc')->paginate(25);
    }

}