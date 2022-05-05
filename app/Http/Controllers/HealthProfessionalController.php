<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HealthProfessional;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\HPResetRequest;
use App\Http\Requests\HPForgotRequest;
use App\Http\Requests\HPRegisterRequest;

class HealthProfessionalController extends Controller
{
    public function store(HPRegisterRequest $request)
    {
        try {
            $hp = HealthProfessional::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'carrier' => $request->category,
                'institution' => $request->institution,
                'department' => $request->department,
                'startingWorkDate' => $request->startingWorkDate,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $hp;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function show()
    {
        return Auth::user();
    }

    public function login(Request $request)
    {
        try {
            if (Auth::guard('hp')->attempt($request->only('email', 'password'))) {

                /** @var User $user */
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message' => 'sucess',
                    'token' => $token,
                    'user' => $user
                ]);

                return $user;
            }

            return response()->json([
                'message' => 'Introduziste credenciais inválidas'
            ], 401);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => "Houve um erro desconhecido, por favor aguarde um pouco e tente de novo"
            ]);
        }
    }

    public function forgot(HPForgotRequest $request)
    {
        $email = $request->input('email');

        if (HealthProfessional::where('email', $email)->doesntExist()) {
            return response([
                'message' => "Usuário inexistente"
            ], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            // Send email
            // Mail::send('Mails.forgot', ['token' => $token], function (Message $message) use ($email) {
            //     $message->to($email);
            //     $message->subject("Redefina sua senha");
            // });

            return response([
                'message' => 'Verifica sua caixa de email'
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function reset(HPResetRequest $request)
    {
        $token = $request->input('token');

        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Token invalido!'
            ], 400);
        }

        /**@var User $user */
        if (!$user = HealthProfessional::where('email', $passwordResets->email)->first()) {
            return response([
                'message' => 'Usuario inexistente'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'sucesso'
        ]);
    }
}