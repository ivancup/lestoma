<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProtocoloRequest extends FormRequest
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
        $id = $this->route()->parameter('protocolo');
        $protocolo = 'required|string|max:80|unique:protocolos';

        if ($this->method() == 'PUT') {
            $protocolo = 'required|max:80|' . Rule::unique('protocolos')->ignore($id, 'id');
        }

        return [
            'nombre' => 'required|string|max:80',
            'protocolo' => $protocolo,
        ];
    }
}
