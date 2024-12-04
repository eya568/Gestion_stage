<?php

namespace App\Imports;

use App\Models\Student; 
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if the student already exists using a unique identifier (like CIN)
            $student = Student::where('cin', $row['cin'])->first();

            if ($student) {
                // Update the existing student
                $student->update([
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'classe' => $row['classe'],
                ]);
            } else {
                // Create a new student record
                Student::create([
                    'cin' => $row['cin'],
                    'nom' => $row['nom'],
                    'prenom' => $row['prenom'],
                    'classe' => $row['classe'],
                ]);
            }
        }
    }
}
