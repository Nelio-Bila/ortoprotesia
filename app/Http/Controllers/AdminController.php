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
    public function index()
    {
        return Admin::all();
    }

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

    public function admin()
    {
        return Auth::guard('admin-api')->user();
    }
    public function update(AdminRegisterRequest $request, $id)
    {
        try {
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->surname = $request->surname;
            $admin->birthdate = $request->birthdate;

            $admin->save();


            return $admin;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function show()
    {
        return Auth::guard('admin-api')->user();
    }

    public function getAdmin($id)
    {
        return Admin::find($id);
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        return response()->noContent();
    }

    public function login(Request $request)
    {
        try {
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

                /** @var User $user */
                // $user = Auth::user();
                $user = Auth::guard('admin')->user();
                $token = $user->createToken('admin-token')->accessToken;

                return response([
                    'message' => 'sucess',
                    'token' => $token,
                    'user' => $user
                ]);

                return $user;
            }

            return response()->json([
                'message' => 'Introduziste credenciais inv??lidas'
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
                'message' => "Usu??rio inexistente"
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

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin-api')->user()->AauthAcessToken()->delete();
        }

        return "Admin Logged out sucessfully";
    }
}