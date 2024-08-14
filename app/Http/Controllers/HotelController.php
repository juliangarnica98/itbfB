<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelPostRequest;
use App\Models\Hotel;
use App\Repositories\HotelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    protected $hotelRepository;

    //iniciacilizacion de Repositories
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }
    //Ver hoteles
    public function index(){
        $data =$this->hotelRepository->index();
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
    //creacion de Hotel
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1',
            'nit' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'name'=> function ($attribute, $value, $fail) use($request) {
                $hotel = Hotel::where('name',$value)->where('city_id',$request->input('city_id'))->first();
                if($hotel){
                    return $fail("El nombre del  hotel ya existe en esta ciudad");
                }
            }
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $this->hotelRepository->create($request->all());
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
    //consultar hotel {id}
    public function show($id){
        $data = $this->hotelRepository->findById($id);
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
}
