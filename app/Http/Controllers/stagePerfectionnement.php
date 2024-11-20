<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stagePerfectionnement extends Controller
{
    public function index()
    {
        return view('stageDePerfectionnemantInterface'); // Le nom de la vue sans ".blade.php"
    }
}
