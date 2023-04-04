<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
        $uuid = $this->segment(3);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$uuid},uuid"],
            'password' => 'required|string|min:8',
        ];

        if($this->method() == 'PUT'){
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }
}
