<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Obtenez toutes les classes pour le filtre
        $classes = Classe::all();

        // Obtenez le nom de la classe sélectionnée depuis la requête
        $selectedClasse = $request->input('classe');

        // Requête des étudiants en filtrant par nom de classe
        $students = Student::when($selectedClasse, function ($query) use ($selectedClasse) {
            return $query->whereHas('classe', function ($q) use ($selectedClasse) {
                $q->where('classe', $selectedClasse); // Filtrer par nom
            });
        })->when($request->input('search'), function ($query) use ($request) {
            return $query->where('nom', 'like', '%' . $request->input('search') . '%')
                ->orWhere('prenom', 'like', '%' . $request->input('search') . '%');
        })->paginate(10);

        return view('students.index', compact('students', 'classes', 'selectedClasse'));
    }

    public function store(Request $request)
    {
        // Valider les données reçues
        $validated = $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id', // Valider l'ID de la classe
        ]);
    
        // Créer le nouvel étudiant
        $student = new Student();
        $student->cin = $request->cin;
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->classe_id = $request->classe_id; // Utiliser l'ID de la classe
        $student->save();
    
        // Rediriger vers la liste des étudiants avec le filtre actuel
        return redirect()->route('students.index', ['classe' => $student->classe->classe])
            ->with('success', 'Étudiant ajouté avec succès');
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
        ]);
    
        // Recherche et mise à jour de l'étudiant
        $student = Student::findOrFail($id);
        $student->cin = $request->cin;
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->classe_id = $request->classe_id;
        $student->save();
    
        return redirect()->back()->with('success', 'Étudiant modifié avec succès!');
    }
    
    public function destroy(Request $request, $id)
    {
        // Trouver et supprimer l'étudiant
        $student = Student::findOrFail($id);
        $student->delete();
    
        // Récupérer la classe pour redirection
        $classe = $request->input('classe');
    
        // Redirection vers la liste filtrée
        return redirect()->route('students.index', ['classe' => $classe])
            ->with('success', 'Étudiant supprimé avec succès!');
    }
    

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new StudentImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Importation réussie!');
    }

    public function create()
    {
        $classes = Classe::all();

        return view('students.add', compact('classes'));
    }
    public function edit($id)
{
    $student = Student::findOrFail($id);

    // Retourne les données sous format JSON
    return response()->json($student);
}

}
