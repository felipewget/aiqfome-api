<?php

namespace App\Http\Requests;

class UpdateUserRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->route('user')->id,
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Este e-mail já está sendo usado.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ];
    }
}