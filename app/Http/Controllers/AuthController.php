<?php

namespace App\Http\Controllers;

use App\Events\AccountRegistered as EventsAccountRegistered;
use App\Mail\AccountRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            "message" => "Success",
            "data" => [
                "token" => $token
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $userExist = User::where('email', $request->email)->first();

        if (!is_null($userExist)) {
            throw ValidationException::withMessages([
                'email' => ['The email has registered.'],
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        event(new EventsAccountRegistered($user));


        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            "message" => "Success",
            "data" => [
                "token" => $token
            ]
        ]);
    }
}
