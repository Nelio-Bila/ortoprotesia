<?php

namespace App\Http\Controllers;

use App\Models\Consult;
use Illuminate\Support\Str;
use App\Http\Requests\ConsultRegisterRequest;

class ConsultController extends Controller
{
    public function index()
    {
        return response()->json(Consult::with(['consultSession'])->orderBy('id', 'desc')->get());
    }

    public function myConsults($process_id)
    {
        return response()->json(Consult::with(['consultSession'])->where('process_id', $process_id)->orderBy('id', 'desc')->get());
    }

    public function store(ConsultRegisterRequest $request)
    {
        try {
            $consult = Consult::create([
                'id' => Str::uuid()->toString(),
                'process_id' => $request->process_id,
                'accomplished' => $request->accomplished,
                'consult_session_id' => $request->consult_session_id,
            ]);

            return $consult;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(ConsultRegisterRequest $request, $id)
    {
        try {
            $consult = Consult::find($id);
            $consult->process_id = $request->process_id;
            $consult->accomplished = $request->accomplished;
            $consult->consult_session_id = $request->consult_session_id;

            $consult->save();

            return response()->json($consult);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $consult = Consult::find($id);

            return response()->json($consult);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $consult = Consult::find($id);
            $consult->delete();

            return response()->noContent();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
