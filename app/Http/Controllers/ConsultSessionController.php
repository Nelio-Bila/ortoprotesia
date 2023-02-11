<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ConsultSession;
use App\Http\Requests\ConsultSessionRegisterRequest;

class ConsultSessionController extends Controller
{
    public function index()
    {
        return response()->json(ConsultSession::with(['consults'])->orderBy('id', 'desc')->get());
    }

    public function store(ConsultSessionRegisterRequest $request)
    {
        try {
            $consultSession = ConsultSession::create([
                'id' => Str::uuid()->toString(),
                'type' => $request->type,
                'date' => $request->date,
                'admin_id' => $request->admin_id,
            ]);

            return $consultSession;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(ConsultSessionRegisterRequest $request, $id)
    {
        try {
            $consultSession = ConsultSession::find($id);
            $consultSession->type = $request->type;
            $consultSession->date = $request->date;
            $consultSession->accomplished = $request->accomplished;
            $consultSession->admin_id = $request->admin_id;

            $consultSession->save();

            return response()->json($consultSession);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $consultSession = ConsultSession::with(['consults'])->find($id);

            return response()->json($consultSession);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $consultSession = ConsultSession::find($id);
            $consultSession->delete();

            return response()->noContent();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
