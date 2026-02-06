<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:10',
            'content' => 'sometimes|required|string|min:10',
            'published_at' => 'nullable|date',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }
}
