<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorize the request
    }

    public function rules()
    {
        return [
            'cin' => 'required|digits:8|unique:students,cin', // CIN must be exactly 8 digits and unique in the students table
            'nom' => 'required|string|max:255', // Name is required
            'prenom' => 'required|string|max:255', // First name is required
            'classe' => 'required|integer|between:1,3', // Class must be an integer between 1 and 3
        ];
    }

    public function messages()
    {
        return [
            'cin.required' => 'Le CIN est requis.',
            'cin.digits' => 'Le CIN doit contenir exactement 8 chiffres.',
            'cin.unique' => 'Le CIN doit être unique.',
            'nom.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'classe.required' => 'La classe est requise.',
            'classe.between' => 'La classe doit être comprise entre 1 et 3.',
        ];
    }
}
