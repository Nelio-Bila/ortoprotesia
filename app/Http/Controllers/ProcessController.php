<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Process;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Identification;
use App\Http\Requests\ProcessRequest;
use App\Models\Neighbourhood;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Process::with(['identification', 'address', 'user', 'consults'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessRequest $request)
    {
        // return $request;
        try {

            $neighbourhood = Neighbourhood::where('name', $request->address['neighbourhood'])->first();

            if (!$neighbourhood) {
                $neighbourhood = Neighbourhood::create([
                    "id" => Str::uuid()->toString(),
                    'name' => $request->address['neighbourhood'],
                    'cod' => $request->address['neighbourhood'],
                    'district_id' => $request->address['district']['id'],

                ]);
            }
            $address = Adress::create([
                "id" => Str::uuid()->toString(),
                "province_id" => $request->address['province']['id'],
                "district_id" => $request->address['district']['id'],
                "neighbourhood_id" => $neighbourhood->id,
            ]);

            $identification = Identification::create([
                "id" => Str::uuid()->toString(),
                "number" => $request->identification['number'],
                "archive" => $request->identification['archive'],
                "issueDate" => $request->identification['issueDate'],
            ]);

            $process = Process::create([
                "id" => Str::uuid()->toString(),
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