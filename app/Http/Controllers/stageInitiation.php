<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stageInitiation extends Controller
{
    public function index()
    {
        return view('stageDinitationInterface'); // Assurez-vous que le fichier est dans le dossier resources/views
    }
}
