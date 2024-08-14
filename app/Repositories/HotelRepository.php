<?php
namespace App\Repositories;

use App\Models\Hotel;

class HotelRepository{
    
    public function index()
    {   
        return Hotel::with('cities')->orderBy('id','asc')->paginate(25);
    }

    public function create(array $storeData)
    {
        return Hotel::create($storeData);
    }

    public function findById($id)
    {
        return Hotel::with('cities')->findOrFail($id);
    }
}