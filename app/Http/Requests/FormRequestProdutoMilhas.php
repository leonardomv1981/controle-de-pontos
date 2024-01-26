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
            if ($this->request->all()['data']['produtomilhas'] != 'transferencia') {
                $request = [
                    'data.produtomilhas.nome_programa' => 'required',
                    'data.produtomilhas.data_operacao' => 'required',
                    'data.produtomilhas.pontos_operacao' => 'required',
                    'data.produtomilhas.observacao' => 'required',
                ];
            } else {
                $request = [
                    'data.produtomilhas.origem.nome_programa' => 'required',
                    'data.produtomilhas.origem.data_operacao' => 'required',
                    'data.produtomilhas.origem.pontos_operacao' => 'required',
                    
                    'data.produtomilhas.destino.nome_programa' => 'required',
                    'data.produtomilhas.destino.pontos_operacao' => 'required',
                ];
            }
            
        }
        return $request;
    }
}
