<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestProdutoMilhas extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }

    public function rules(): array
    {
        
        $request = [];
        if ($this->method() == "POST") {
            $request = [
                'nome_programa' => 'required',
                'operacao' => 'required',
                'data_operacao' => 'required',
                'pontos_operacao' => 'required',
                'valor_operacao' => 'required',
                'observacao' => 'required',
            ];
        }
        return $request;
    }
}
