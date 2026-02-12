<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'title' => 'required|string|max:10',
            'content' => 'required|string|min:10',
            'published_at' => 'required|date',
            'photo' => 'nullable|array',
            'photo.*' => 'bail|image|mimes:jpeg,png,jpg,webp|max:10240',
            'category_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => "Can't you even write 10 words for title?",
            'content.required' => 'Just write more that 10 words for content dudeee',
            'category_id.required' => 'Select some categories come on!!',
            'published_at.required' => "What's today's date? ",
            'photo.*.image' => 'Only image type is allowed !!',
            'photo.*.mimes' => 'Photos must be jpeg, png, jpg, or webp.',
        ];
    }
}
