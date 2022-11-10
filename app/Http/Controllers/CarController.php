<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Модели
use App\User;
use App\Car;

use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function all(Request $r)
    {
        $cars = Car::all();

        return response()->json(['status' => 'success', 'cars' => $cars]);
    }
    
    public function get(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\Car,id',
        ]);
 
        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $car = Car::where('id', $r->id)->first();

        return response()->json(['status' => 'success', 'car' => $car]);
    }

    public function create(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'driver_id' => 'nullable|int'
        ]);
 
        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $car = [];

        if($r->driver_id)
            $car['driver_id'] = $r->driver_id;

        $car = Car::create($car);

        return response()->json(['status' => 'success', 'user' => $car]);
    }

    public function update(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\Car,id',
            'driver_id' => 'nullable|int|exists:App\User,id|unique:App\Car,driver_id'
        ]);

        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $car = [];

        if($r->driver_id)
            $car['driver_id'] = $r->driver_id;

        $car = Car::where('id', $r->id)->update($car);
        $car = Car::where('id', $r->id)->first();

        return response()->json(['status' => 'success', 'car' => $car]);
    }

    public function delete(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\Car,id'
        ]);

        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        Car::where('id', $r->id)->delete();

        return response()->json(['status' => 'success']);
    }
}