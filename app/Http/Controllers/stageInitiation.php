<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soutenance; // Include your Soutenance model

class StageInitiation extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $soutenances = Soutenance::all();

        // Pass the data to the view
        return view('stageDinitationInterface', compact('soutenances'));
    }
}
