<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminResetRequest;
use App\Http\Requests\AdminForgotRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Category;
use App\Models\HealthProfessional;

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

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin-api')->user()->AauthAcessToken()->delete();
        }

        return "Admin Logged out sucessfully";
    }

    public function registersPerDay()
    {

        $left = User::whereBetween('users.created_at', [now()->subDays(15), now()])
            ->leftJoin('health_professionals', DB::raw("DATE_FORMAT(health_professionals.created_at, '%d-%m-%Y')"), '=', DB::raw("DATE_FORMAT(users.created_at, '%d-%m-%Y')"))
            ->select(DB::raw("(count(health_professionals.id)) as hp_count"), DB::raw("(count(users.id)) as users_count"), DB::raw("(DATE_FORMAT(users.created_at, '%d-%m-%Y')) as days"))
            ->orderBy('users.created_at', 'desc')
            ->groupBy('days');




        $newRegisters = User::whereBetween('users.created_at', [now()->subDays(15), now()])
            ->rightJoin('health_professionals', DB::raw("DATE_FORMAT(health_professionals.created_at, '%d-%m-%Y')"), '=', DB::raw("DATE_FORMAT(users.created_at, '%d-%m-%Y')"))
            ->select(DB::raw("(count(health_professionals.id)) as hp_count"), DB::raw("(count(users.id)) as users_count"), DB::raw("(DATE_FORMAT(users.created_at, '%d-%m-%Y')) as days"))
            ->orderBy('users.created_at', 'desc')
            ->groupBy('days')
            ->union($left)
            ->get();

        $newUsersPerDay = [];
        $newHPsPerDay = [];
        $days = [];

        foreach ($newRegisters as $register) {
            $newUsersPerDay[] = $register->users_count;
            $newHPsPerDay[] = $register->hp_count;
            $days[] = $register->days;
        }



        return response()->json([
            'newUsersPerDay' => array_reverse($newUsersPerDay),
            'newHPsPerDay' => array_reverse($newHPsPerDay),
            'days' => array_reverse($days)
        ]);
    }

    public function readersPerCategory()
    {

        $categories = Category::with(['articles.views'])->get();

        $articlesViewsPerCategory = [];
        $catnames = [];
        $articleviews = 0;

        foreach ($categories as $cat) {
            $catnames[] = $cat->name;
            foreach ($cat->articles as $article) {

                $articleviews += count($article->views);
            }
            $articlesViewsPerCategory[] = $articleviews;
            $articleviews = 0;
        }

        return response()->json([
            'catnames' => $catnames,
            'articlesViewsPerCategory' => $articlesViewsPerCategory,
        ]);
    }
}
