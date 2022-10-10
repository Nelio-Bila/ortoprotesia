<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use Illuminate\Http\Request;

class NeighbourhoodController extends Controller
{
    public function index($district_id)
    {
        return Neighbourhood::where('district_id', $district_id)->get();
    }
}