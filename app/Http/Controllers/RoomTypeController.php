<?php

namespace App\Http\Controllers;

use App\Repositories\RoomTypeRepository;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomTypeRepository;

    //iniciacilizacion de Repositories
    public function __construct(RoomTypeRepository $roomTypeRepository)
    {
        $this->roomTypeRepository = $roomTypeRepository;
    }
    //Ver tipos de habitación
    public function index()
    {
        $data = $this->roomTypeRepository->index();
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
}
