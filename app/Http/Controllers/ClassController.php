<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Student;
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
        // Valider les données reçues
        $validated = $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe' => 'required|exists:classes,classe', // Valider par le nom de classe
        ]);
    
        // Récupérer l'ID de la classe à partir de son nom
        $classe = Classe::where('classe', $request->classe)->firstOrFail();
    
        // Créer le nouvel étudiant
        $student = new Student();
        $student->cin = $request->cin;
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->classe_id = $classe->id; // Attribuer l'ID correspondant
        $student->save();
    
        // Rediriger vers la liste des étudiants avec le filtre actuel
        return redirect()->route('students.index', ['classe' => $request->classe])
            ->with('success', 'Étudiant ajouté avec succès');
    }
    
   
}
