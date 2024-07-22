<?php

namespace App\Http\Requests\Company;

use App\Enums\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->type === Type::EDITOR->value;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('companies', 'name')->ignore($this->company->id)],
            'logo' => 'required|active_url|max:2048',
            'status' => 'required',
        ];
    }
}
