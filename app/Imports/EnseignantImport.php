<?php

namespace App\Imports;

use App\Models\Enseignant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EnseignantImport implements ToModel, WithHeadingRow
{
    /**
     * Define the model to be used when importing each row.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Enseignant([
            'cin' => $row['cin'],        // Make sure the column names match those in your Excel file's header
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'email' => $row['email'],
            'specialite' => $row['specialite'],
        ]);
    }
}
