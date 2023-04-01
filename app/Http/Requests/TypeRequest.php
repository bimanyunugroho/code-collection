<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => [$this->isUpdate(), 'string', 'unique:types', 'max:100'],
            'type_koding' => [$this->isUpdate(), 'string', 'unique:types', 'max:200'],
        ];
    }

    public function isUpdate(): string {
        return request()->isMethod('POST') ? 'required' : 'sometimes';
    }
}
