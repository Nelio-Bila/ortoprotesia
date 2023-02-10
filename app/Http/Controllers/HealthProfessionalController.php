<?php

namespace App\Http\Controllers;

use App\Http\Requests\HPForgotRequest;
use App\Http\Requests\HPRegisterRequest;
use App\Http\Requests\HPResetRequest;
use App\Models\HealthProfessional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HealthProfessionalController extends Controller
{
    public function index()
    {
        return HealthProfessional::all();
    }

    public function store(HPRegisterRequest $request)
    {
        try {
            $hp = HealthProfessional::create([
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'carrier' => $request->carrier,
                'category' => $request->category,
                'institution' => $request->institution,
                'department' => $request->department,
                'startingWorkDate' => $request->starting_work_date,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_hp' => true,
            ]);

            return $hp;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function show($id)
    {
        return HealthProfessional::find($id);
    }

    public function hp()
    {
        return Auth::guard('hp-api')->user();
    }

    public function login(Request $request)
    {
        try {
            if (Auth::guard('hp')->attempt($request->only('email', 'password'))) {
                /** @var User $user */
                $user = Auth::guard('hp')->user();
                $token = $user->createToken('hp-token')->accessToken;

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

    public function forgot(HPForgotRequest $request)
    {
        $email = $request->input('email');

        if (HealthProfessional::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'Usuário inexistente',
            ], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            // Send email
            // Mail::send('Mails.forgot', ['token' => $token], function (Message $message) use ($email) {
            //     $message->to($email);
            //     $message->subject("Redefina sua senha");
            // });

            return response([
                'message' => 'Verifica sua caixa de email',
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function reset(HPResetRequest $request)
    {
        $token = $request->input('token');

        if (! $passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Token invalido!',
            ], 400);
        }

        /** @var User $user */
        if (! $user = HealthProfessional::where('email', $passwordResets->email)->first()) {
            return response([
                'message' => 'Usuario inexistente',
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'sucesso',
        ]);
    }

    public function logout()
    {
        if (Auth::guard('hp')->check()) {
            Auth::guard('hp')->user()->AauthAcessToken()->delete();
        }

        return 'Health Professional Logged out sucessfully';
    }
}
