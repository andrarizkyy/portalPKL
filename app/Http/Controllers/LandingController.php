<?php

namespace App\Http\Controllers;
use App\Models\DudiProfile;

class LandingController extends Controller
{
    public function index()
    {
        $dudi = DudiProfile::where('status','verified')->latest()->first();
        return view('landing', compact('dudi'));
    }
}
