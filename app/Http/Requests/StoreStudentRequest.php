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
            'cin' => 'required|digits:8|unique:students,cin', 
            'nom' => 'required|string|max:255', 
            'prenom' => 'required|string|max:255',
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
           
        ];
    }
}
