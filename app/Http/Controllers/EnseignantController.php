<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;
use Illuminate\Support\Facades\DB;
use App\Imports\EnseignantImport;
use Maatwebsite\Excel\Facades\Excel;

class EnseignantController extends Controller
{
    public function listepage()
    {
        $enseignant = Enseignant::all();
        return view('enseignants.liste', compact('enseignant'));
    }

    public function addEnseignant(Request $request)
    {
        $ens = new Enseignant([
            "cin" => $request->input("cin"),
            "nom" => $request->input("nom"),
            "prenom" => $request->input("prenom"),
            "email" => $request->input("email"),
            "specialite" => $request->input("specialite"),

        ]);

        $ens->save();
        return redirect()->route('listeEnseignant')->with('success', 'enseignants added');
    }
    public function allEnseignant()
    {
        $Enseignant = Enseignant::all();
        return view('enseignants.liste')->with("Enseignant", $Enseignant);
    }

    //supprimer enseignant
    public function delete($id)
    {
        // Suppression de l'enseignant dans la base de données
        DB::table('enseignants')->where('id', $id)->delete();
        return redirect()->route('listeEnseignant')->with('success', 'Enseignant supprimé avec succès.');
    }



    public function edit($id)
    {
        $data = Enseignant::select('*')->find($id);
        return view('enseignants.modifier', (['data' => $data]));
    }
    public function update(Request $request, $id)
    {
        $enseignant = [
            "cin" => $request->input("cin"),
            "nom" => $request->input("nom"),
            "prenom" => $request->input("prenom"),
            "email" => $request->input("email"),
            "specialite" => $request->input("specialite"),
        ];
        $row = Enseignant::where('id', $id)->update($enseignant);
        if ($row > 0) {
            return redirect()->route('listeEnseignant')->with('success', 'enseignants updated');
        } else {
            return redirect()->route('listeEnseignant')->with('error', 'failed to update');
        }
    }
    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new EnseignantImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Importation réussie!');
    }


    public function search(Request $request)
    {
        $query = $request->input('query'); // Récupère le terme de recherche

        // Effectue la recherche sur plusieurs colonnes
        $enseignant = Enseignant::where('nom', 'like', "%{$query}%")
            ->orWhere('prenom', 'like', "%{$query}%")
            ->orWhere('cin', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('specialite', 'like', "%{$query}%")
            ->get();

        return view('enseignants.liste', compact('enseignant', 'query'));
    }
    // change1




}
