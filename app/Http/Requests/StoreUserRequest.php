<?php

namespace App\Http\Requests;

class StoreUserRequest extends AbstractFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|string|in:admin,client'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'O email já está cadastrado',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha precisa ter no mínimo 6 caracteres',
            'password.confirmed' => 'A confirmação da senha devem ser iguais',
            'type' => 'Tipo do user precisar ser admin ou client'
        ];
    }
}
