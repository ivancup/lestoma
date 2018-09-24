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
     * @return array
     */
    public function rules()
    {
        $password = 'required|min:3';
        $estado = 'required|numeric|exists:estados,id';
        $id = $this->route()->parameter('usuario');
        $roles = 'required';

        if ($this->method() == 'PUT') {
            $password = '';
        }
        return [
            'email' => 'required|email|' . Rule::unique('users')->ignore($id),
            'password' => $password,
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'id_estado' => $estado,
            'roles' => $roles
        ];
    }
}
