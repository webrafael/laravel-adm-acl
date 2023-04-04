<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateRolesRequest extends FormRequest
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
            'role' => 'array',
            'role.name' => 'required|string|max:120',
            'role.details' => 'string|max:255',
            'permissions'  => 'array',
            'permissions.*.create' => ['string', Rule::in(['yes', 'no'])],
            'permissions.*.read' => ['string', Rule::in(['yes', 'no'])],
            'permissions.*.update' => ['string', Rule::in(['yes', 'no'])],
            'permissions.*.delete' => ['string', Rule::in(['yes', 'no'])],
            'permissions.*.name' => 'string|max:120',
            'permissions.*.id' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'permissions.*.create.in' => 'O campo :attribute aceita somente "yes ou no"',
            'permissions.*.read.in' => 'O campo :attribute aceita somente "yes ou no"',
            'permissions.*.update.in' => 'O campo :attribute aceita somente "yes ou no"',
            'permissions.*.delete.in' => 'O campo :attribute aceita somente "yes ou no"',
            'permissions.*.id.numeric' => 'O campo :attribute deve ser somente número.'
        ];
    }
}
