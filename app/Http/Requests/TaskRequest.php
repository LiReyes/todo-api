<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'TaskEstatus.required' => 'El campo TaskEstatus es obligatorio.',
            'TaskTitle.required' => 'El campo TaskTitle es obligatorio.',
            'TaskDescription.required' => 'El campo TaskDescription es obligatorio.',
            'TaskDescription.max' => 'El campo TaskDescription debe tener un máximo de 512 caracteres.',
            'TaskTitle.string' => 'El campo TaskTitle debe ser una cadena de texto.',
            'TaskUser_id.required' => 'El campo TaskUser_id es obligatorio.',
            'TaskUser_id.exists' => 'El usuario no existe. TaskUser_id debe ser un usuario válido.',
            'TaskStatus.in' => 'El TaskStatus debe ser PENDIENTE o COMPLETADO',
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
            'TaskTitle' => 'required|string:70',
            'TaskDescription' => 'required|string|max:512',
            'TaskStatus' => 'required|in:PENDIENTE,REALIZADA',
            'TaskUser_id' => 'required|exists:users,id',
        ];
    }

    private function rulesForUpdatePut(): array
    {
        return [
            'TaskTitle' => 'required|string:70',
            'TaskDescription' => 'required|string|max:512',
            'TaskStatus' => 'required|in:PENDIENTE,REALIZADA',
            //'TaskUser_id' => 'required|exists:users,id',
        ];
    }

    private function rulesForUpdatePatch(): array
    {
        return [
            'TaskTitle' => 'string:70',
            'TaskDescription' => 'required|string|max:512',
            'TaskStatus' => 'in:PENDIENTE,REALIZADA',
            //'TaskUser_id' => 'exists:users,id',
        ];
    }
}
