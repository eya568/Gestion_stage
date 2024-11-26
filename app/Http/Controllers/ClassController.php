<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of classes.
     */
    public function index(Request $request)
    {
        $classes = Classe::query();

        if ($search = $request->input('search')) {
            $classes->where('id', 'like', "%$search%");
        }

        $classes = $classes->paginate(10);

        return view('classes.index', compact('classes'));
    }

    /**
     * Store a newly created class in the database.
     */
    public function store(Request $request)
    {
        // Validate the class name field
        $validated = $request->validate([
            'classe' => 'required|string|max:255|unique:classes,classe', // Ensure 'classe' is unique
        ]);

        // Create a new class
        $classe = new Classe();
        $classe->classe = $validated['classe'];
        $classe->save();

        // Redirect back with success message
        return redirect()->route('classes.index')
            ->with('success', 'Classe ajoutée avec succès.');
    }
}
