<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminResetRequest;
use App\Http\Requests\AdminForgotRequest;
use App\Http\Requests\AdminRegisterRequest;

class AdminController extends Controller
{
    public function store(AdminRegisterRequest $request)
    {
        try {
            $admin = Admin::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'birthdate' => $request->birthdate,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $admin;
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
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

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

    public function forgot(AdminForgotRequest $request)
    {
        $email = $request->input('email');

        if (Admin::where('email', $email)->doesntExist()) {
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

    public function reset(AdminResetRequest $request)
    {
        $token = $request->input('token');

        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Token invalido!'
            ], 400);
        }

        /**@var User $user */
        if (!$user = Admin::where('email', $passwordResets->email)->first()) {
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