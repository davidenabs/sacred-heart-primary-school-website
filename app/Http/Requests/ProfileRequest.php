<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            "first_name" => "required",
            "last_name" => "required",
            "email" => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            "phone" => "required",
            "bio" => "nullable|string",
            "profile" => "nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048",
            "facebook" => "nullable",
            "twitter" => "nullable",
        ];
    }
}
