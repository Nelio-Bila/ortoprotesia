<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;

class NeighbourhoodController extends Controller
{
    public function index($district_id)
    {
        return Neighbourhood::where('district_id', $district_id)->get();
    }
}
