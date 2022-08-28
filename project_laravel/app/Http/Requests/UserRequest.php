<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200',
            'email' => ['required','email',Rule::unique('users')->ignore($this->route('user.id'))],
            'password' => [ $this->route('user.id') ? 'nullable' : 'required','string','confirmed','min:6','max:200' ],
            'roles' => 'required|array|min:1',
            'roles.*' => 'required|numeric|exists:roles,id',
        ];
    }
}
