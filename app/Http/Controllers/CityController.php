<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;


class CityController extends Controller
{
    protected $cityRepository;

    //iniciacilizacion de Repositories
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    //Ver ciudades
    public function index()
    {
        $data = $this->cityRepository->index();
        return response()->json(['status'=> 'success','data'=> $data],200);
    }

}
