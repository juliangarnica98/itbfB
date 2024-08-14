<?php

namespace App\Http\Controllers;


use App\Http\Requests\RoomPostRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Repositories\HotelRepository;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RoomController extends Controller
{
    protected $roomRepository;
    protected $hotelRepository;

    //iniciacilizacion de Repositories
    public function __construct(RoomRepository $roomRepository, HotelRepository $hotelRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
    }
    //Ver habitacion
    public function index($id){
        $hotel = $this->hotelRepository->findById($id);
        $data = $this->roomRepository->index($hotel->id);
        return response()->json(['status'=> 'success','data'=> $data],200);
    }
    //creacion de Habitaciones
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hotels,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'amount' => 'required|integer|min:1',
            'room_type_id' => function ($attribute, $value, $fail) use ($request) {
                if ($value == 1 && !in_array($request->input('accommodation_id'), [1, 2])) {
                    return $fail('La acomodación debe ser Sencilla o Doble para el tipo de habitación Estándar');
                }
                if ($value == 2 && !in_array($request->input('accommodation_id'), [3, 4])) {
                    return $fail('La acomodación debe ser Triple o Cuádruple para el tipo de habitación Junior');
                }
                if ($value == 3 && !in_array($request->input('accommodation_id'), [1, 2, 3])) {
                    return $fail('La acomodación debe ser Sencilla, Doble o Triple para el tipo de habitación Suite');
                }
            },
            'hotel_id' => function ($attribute, $value, $fail) use ($request) {
                $habitaciones = Room::where('hotel_id', $value)
                    ->where('room_type_id', $request->input('room_type_id'))
                    ->where('accommodation_id', $request->input('accommodation_id'))
                    ->count();
                if ($habitaciones > 0) {
                    return $fail('No debe existir tipos de habitaciones y acomodaciones repetidas para el mismo hotel');
                }
            },
            'amount' => function ($attribute, $value, $fail) use ($request) {
                $hotel = Hotel::find($request->input('hotel_id'));
                $habitaciones = Room::where('hotel_id', $request->input('hotel_id'))->sum('amount');
                if ($value+$habitaciones > $hotel->rooms) {
                    return $fail('Exede el número de asignaciones para este hotel');
                }
            },
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = $this->roomRepository->create($request->all());
        return response()->json(['status'=> 'success','data'=> $data],200);
    }

}
