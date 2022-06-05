<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            if (Auth::guard('web')->attempt($request->only('email', 'password'))) {

                /** @var User $user */
                $user = Auth::guard('web')->user();
                $token = $user->createToken('user-token')->accessToken;

                return response([
                    'message' => 'sucess',
                    'token' => $token,
                    'user' => $user
                ]);

                return $user;
            }

            return response()->json([
                'message' => 'As credenciais introduzidas não são válidas'
            ], 401);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->user()->AauthAcessToken()->delete();
        }

        return "Logged out sucessfully";
    }

    public function user()
    {
        return Auth::guard('user')->user();
    }

    public function details($id)
    {
        return User::find($id);
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $user;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }


    public function update(RegisterRequest $request, $id)
    {

        $user = User::find($id);

        try {
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->birthdate = $request->birthdate;
            $user->email = $request->email;

            $user->save();


            return $user;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function index()
    {
        return User::all();
    }
}