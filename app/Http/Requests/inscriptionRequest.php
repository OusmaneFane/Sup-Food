<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class inscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array< string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'matricule' => 'required|numeric|min:7|unique:users,matricule|max:7',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis.',
            'name.min' => 'Le nom doit contenir au moins 3 chiffres.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être une adresse e-mail valide.',
            'email.unique' => 'L\'email existe déja.',
            'matricule.unique' => 'Le matricule existe déja.',
            'matricule.min' => 'Le matricule doit contenir au moins 7 chiffres.',
            'matricule.max' => 'Le matricule doit contenir maximum 7 chiffres.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ];
    }
}
