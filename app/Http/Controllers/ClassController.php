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
        $classe->classe = strtoupper($validated['classe']);  // Convert to uppercase and save

        $classe->save();

        // Redirect back with success message
        return redirect()->route('classes.index')
            ->with('success', 'Classe ajoutée avec succès.');
    }
    public function destroy($id)
    {
        // Find the class by ID
        $class = Classe::findOrFail($id);
    
        // Get the name of the class for the success message
        $className = $class->classe;
    
        // Get the count of students associated with the class
        $studentsCount = $class->students()->count();
    
        // Delete all students associated with this class
        $class->students()->delete();
    
        // Delete the class itself
        $class->delete();
    
        // Return the success message with the number of deleted students
        return redirect()->route('classes.index')
            ->with('success', "La classe '{$className}' et ses {$studentsCount} étudiants ont été supprimés avec succès.");
    }

    public function edit($id)
    {
        // Find the class by ID
        $class = Classe::findOrFail($id);
        
        // Return the edit view with the class data
        return view('classes.edit', compact('class'));
    }

    // Update the class in the database
    public function update(Request $request, $id)
    {
        // Validate the class name
        $validated = $request->validate([
            'classe' => 'required|string|max:255|unique:classes,classe,' . $id, // Ensure it's unique except for the current class
        ]);

        // Find the class by ID and update it
        $class = Classe::findOrFail($id);
        $class->classe = $validated['classe'];
        $class->save();

        // Redirect back to the index with a success message
        return redirect()->route('classes.index')
            ->with('success', 'Classe mise à jour avec succès.');
    }
    
    
    

}
    