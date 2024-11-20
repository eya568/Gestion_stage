<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentImport;

use App\Http\Requests\StoreStudentRequest;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Classe;  


namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Models\Classe;
use Maatwebsite\Excel\Facades\Excel;
class StudentController extends Controller
{
    public function index(Request $request)
{
    // Get all the classes for the filter dropdown
    $classes = Classe::all();
    
    // Get the selected class name from the request
    $selectedClasse = $request->input('classe'); 

    // Query the students
    $students = Student::when($selectedClasse, function($query) use ($selectedClasse) {
        return $query->whereHas('classe', function($q) use ($selectedClasse) {
            $q->where('classe', $selectedClasse); 
        });
    })->when($request->input('search'), function($query) use ($request) {
        return $query->where('nom', 'like', '%' . $request->input('search') . '%')
                     ->orWhere('prenom', 'like', '%' . $request->input('search') . '%');
    })->paginate(10);
    
    return view('students.index', compact('students', 'classes', 'selectedClasse'));  
}

    


    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id', // Validate the class ID instead of 'classe'
        ]);
    
        // Create the new student
        $student = new Student();
        $student->cin = $request->cin;
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->classe_id = $request->classe_id;  // Use 'classe_id'
        $student->save();
    
        // Redirect to the student list or a success page
        return redirect()->route('students.index')->with('success', 'Étudiant ajouté avec succès');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'classe_id' => 'required|exists:classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->cin = $request->cin;
        $student->nom = $request->nom;
        $student->prenom = $request->prenom;
        $student->classe_id = $request->classe_id;  // Update the class ID
        $student->save();

        return redirect()->route('students.index')->with('success', 'Étudiant modifié avec succès!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Étudiant supprimé avec succès!');
    }

    public function importExcelData(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,csv,xls', // Accept only specific file types
        ]);

        // Import the data
        Excel::import(new StudentImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Importation réussie!');
    }

    public function create()
    {
        $classes = Classe::all();  // Fetch all classes for the dropdown

        return view('students.add', compact('classes'));
    }
}
