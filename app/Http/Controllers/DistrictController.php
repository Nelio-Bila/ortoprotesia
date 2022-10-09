<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index($province_id)
    {
        return District::where('province_id', $province_id)->get();
    }
}