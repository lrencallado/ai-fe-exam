<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'image' => 'required|active_url|max:2048',
            'title' => 'required|max:255',
            'link' => 'required|url|max:2048',
            'content' => 'required',
            'date' => 'required|date',
            'company' => 'required',
        ];
    }
}
