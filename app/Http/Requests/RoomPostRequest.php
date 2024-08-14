<?php

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class RoomPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => 'required|exists:hoteles,id',
            'room_type_id' => 'required|exists:room_types,id',
            'accommodation_id' => 'required|exists:accommodations,id',
            'amount' => 'required|integer|min:1',

            'room_type_id' => function ($value, $fail) {
                if ($value == 1 && !in_array($this->input('accommodation_id'), [1, 2])) {
                    return $fail('La acomodación debe ser Sencilla o Doble para el tipo de habitación Estándar');
                }
                if ($value == 2 && !in_array($this->input('accommodation_id'), [3, 4])) {
                    return $fail('La acomodación debe ser Triple o Cuádruple para el tipo de habitación Junior');
                }
                if ($value == 3 && !in_array($this->input('accommodation_id'), [1, 2, 3])) {
                    return $fail('La acomodación debe ser Sencilla, Doble o Triple para el tipo de habitación Suite');
                }
            },


            'hotel_id' => function ($value, $fail) {
                $habitaciones = Room::where('hotel_id', $value)
                    ->where('room_type_id', $this->input('room_type_id'))
                    ->where('accommodation_id', $this->input('accommodation_id'))
                    ->count();
                if ($habitaciones > 0) {
                    return $fail('No debe existir tipos de habitaciones y acomodaciones repetidas para el mismo hotel');
                }
            },
        ];
    }
}
