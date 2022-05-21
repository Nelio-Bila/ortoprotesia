<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Process;
use Illuminate\Http\Request;
use App\Models\Identification;
use App\Http\Requests\ProcessRequest;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessRequest $request)
    {
        try {
            $address = Adress::create([
                "province" => $request->province,
                "district" => $request->district,
                "neighbourhood" => $request->neighbourhood,
            ]);

            $identification = Identification::create([
                "number" => $request->number,
                "archive" => $request->archive,
                "issueDate" => $request->issueDate,
            ]);

            $process = Process::create([
                "address_id" => $address->id,
                "identification_id" => $identification->id,
                "user_id" => $request->user_id,
                "maritalState" => $request->maritalState,
                "genre" => $request->genre,
                "race" => $request->race,
                "profession" => $request->profession,
                "workPlace" => $request->workPlace,
                "naturality" => $request->naturality,
                "phoneNumber" => $request->phoneNumber,
                "fatherName" => $request->fatherName,
                "motherName" => $request->motherName,
            ]);



            return $process;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        return Process::find($process);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $process)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }
}
