<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stagePFE extends Controller
{
    public function index()
    {
        return view('stageDePFEinterface'); // Assurez-vous que ce fichier existe dans resources/views
    }
}
