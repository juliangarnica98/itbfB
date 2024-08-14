<?php

namespace App\Http\Controllers;

use App\Repositories\AccommodationRepository;

class AccommodationController extends Controller
{
    protected $accommodationRepository;

    //iniciacilizacion de Repositories
    public function __construct(AccommodationRepository $accommodationRepository)
    {
        $this->accommodationRepository = $accommodationRepository;
    }
    //Ver comodidades
    public function index()
    {
        $data = $this->accommodationRepository->index();
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
}
