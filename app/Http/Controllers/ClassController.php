<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
class ClassController extends Controller
{
    /**
     * Show the list of classes.
     */
    public function index(Request $request)
    {
        $classes = Classe::query();

        if ($search = $request->input('search')) {
            $classes->where('classe', 'like', "%$search%");
        }

        $classes = $classes->paginate(10);

        return view('classes.index', compact('classes'));
    }

    /**
     * Store a newly created class in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classe' => 'required|string|max:255|unique:classes,classe',
        ]);

        // Create the new class
        Classe::create([
            'classe' => $request->input('classe'),
        ]);

        // Redirect back to the classes list with success message
        return redirect()->route('classes.index')->with('success', 'Classe ajoutée avec succès.');
    }

   
}
