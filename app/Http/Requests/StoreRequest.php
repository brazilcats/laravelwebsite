<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
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
    public function rules(Request $requestAll)
    {
        $name = isset($requestAll['name']) ? ','.$requestAll['name'].',name':'';
        return [
            'name'         => 'required|unique:stores,name'.$name,
            'description'  => 'required',
            'phone'        => 'required',
            'mobile_phone' => 'required',
	        'logo'         => 'image'
        ];
    }

    public function messages()
    {
    	return [
    		'required' => 'Este campo é obrigatório',
    		'unique' => 'Este nome já existe, tente outro',
			'min' => 'Campo :attribute deve ter no mínimo :min caracteres',
		    'image'    => 'Arquivo não é uma imagem válida!'
	    ];
    }
}
