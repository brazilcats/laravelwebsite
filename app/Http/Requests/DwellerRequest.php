<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DwellerRequest extends FormRequest
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
        //$lot = isset($requestAll['lot']) ? ','.$requestAll['lot'].',lot':'';
        return [
            'lot'         => 'required|unique:user_dwellers'
        ];
    }

    public function messages()
    {
    	return [
    		'required' => 'Este campo é obrigatório',
    		'unique' => 'Este lote já existe, tente outro',
			'min' => 'Campo :attribute deve ter no mínimo :min caracteres',
		    'image'    => 'Arquivo não é uma imagem válida!'
	    ];
    }
}
