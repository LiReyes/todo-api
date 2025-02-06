<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return $this->getRulesMethod();
    }

    public function messages()
    {
        return [
            'UserUsername.required' => 'El campo UserUsername es obligatorio.',
            'UserUsername.string' => 'El campo UserUsername debe ser una cadena de texto.',
            'UserPassword.required' => 'El campo UserPassword es obligatorio.',
            'UserPassword.min' => 'El campo UserPassword debe tener al menos 8 caracteres.',
            'UserEmail.required' => 'El campo UserEmail es obligatorio.',
            'UserEmail.email' => 'El campo UserEmail debe ser una dirección de correo electrónico válida.',
            'UserEmail.unique' => 'El email ya está en uso.',
        ];
    }

    private function getRulesMethod(): array
    {
        if ($this->isMethod('post')) {
            return $this->rulesForStore();
        } elseif ($this->isMethod('put')) {
            return $this->rulesForUpdatePut();
        } elseif ($this->isMethod('patch')) {
            return $this->rulesForUpdatePatch();
        }
        return [];
    }

    private function rulesForStore(): array
    {
        return [
            'UserUsername' => 'required|string|max:50|unique:users,username',
            'UserPassword' => 'required|string|min:8',
            'UserEmail' => 'required|email|unique:users,email',
        ];
    }

    private function rulesForUpdatePut(): array
    {
        
        return [
            'UserUsername' => 'required|string|max:255',
            'UserPassword' => 'required|string|min:8',
            'UserEmail' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore(request()->route('user.id')),
            ],
        ];
    }

    private function rulesForUpdatePatch(): array
    {
        return [
            'UserUsername' => 'sometimes|string|max:255',
            'UserPassword' => 'sometimes|string|min:8',
            'UserEmail' => [
                'sometimes',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore(request()->route('user.id')),
            ],
        ];
    }
}
