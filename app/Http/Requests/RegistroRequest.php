<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed', // en registro ambos password tienen q ser iguales
                PasswordRules::min(8)->letters()->symbols()->numbers() // ciertas validaciones en un password de min 8 caracteres
            ]
        ];
    }

    public function messages()
    {
        return [
            'name'              => 'El nombre es obligatrio',
            'email.required'    => 'El email es obligatorio',
            'email.email'       => 'El email no es valido',
            'email.unique'      => 'El usuario ya esta registrado',
            'password'          => 'El password debe contener al menos 8 caracteres, un simbolo y un número'
        ];
    }
}
