<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                    'user' => $user,
                ]);

                return $user;
            }

            return response()->json([
                'message' => 'As credenciais introduzidas não são válidas',
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
            // Auth::guard('web')->user()->authAcessToken()->delete();
            Auth::guard('user')->user()->token()->revoke();
        }

        if (Auth::guard('user')->check()) {
            Auth::guard('user')->user()->token()->revoke();
        }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->token()->revoke();
        }

        return 'Logged out sucessfully';
    }

    public function user()
    {
        return Auth::guard('user')->user();
    }

    public function details()
    {
        return User::with('process')->find(Auth::guard('user')->user()->id);
    }

    public function process($user_id)
    {
        $user = User::with('process')->find($user_id);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $user;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(UpdateRequest $request, $id)
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
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function index()
    {
        return User::all();
    }

    public function userByDate()
    {
        //          MYSQL
        $users = User::select('id', DB::raw('(count(id)) as count'), DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as users_to_month"))
            ->orderBy('created_at', 'desc')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->get();

        foreach ($users as $user) {
            $usersPerMonth[] = $user['count'];
            $months[] = $user['users_to_month'];
        }

        return response()->json([
            'usersPerMonth' => array_reverse($usersPerMonth), 'months' => array_reverse($months),
        ]);
    }
}
