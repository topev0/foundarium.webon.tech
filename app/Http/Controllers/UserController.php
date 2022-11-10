<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Модели
use App\User;
use App\Car;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function all(Request $r)
    {
        $users = User::all();

        return response()->json(['status' => 'success', 'users' => $users]);
    }

    public function get(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\User,id',
        ]);
 
        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $user = User::where('id', $r->id)->first();

        return response()->json(['status' => 'success', 'user' => $user]);
    }

    public function create(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'name' => 'required|string|max:30'
        ]);
 
        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $user = ['name' => $r->name];
        $user = User::create($user);

        return response()->json(['status' => 'success', 'user' => $user]);
    }

    public function update(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\User,id',
            'name' => 'required|string|max:30'
        ]);

        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $user = ['name' => $r->name];
        $user = User::where('id', $r->id)->update($user);
        $user = User::where('id', $r->id)->first();

        return response()->json(['status' => 'success', 'user' => $user]);
    }

    public function delete(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\User,id'
        ]);

        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        User::where('id', $r->id)->delete();

        return response()->json(['status' => 'success']);
    }

    public function isDriving(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id' => 'required|int|exists:App\User,id'
        ]);

        if($validator->fails())
            return response()->json(['status' => 'error', 'errors' => $validator->errors()]);

        $user = User::where('id', $r->id)->first();
        $user->car = Car::where('driver_id', $user->id)->first();

        return response()->json(['status' => 'success', 'data' => $user]);
    }
}