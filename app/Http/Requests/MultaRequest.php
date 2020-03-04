<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultaRequest extends FormRequest
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
        return [
                'nome' => 'required',
                'cpf_cnpj'=>'required|numeric',
                'processo'=>'required',
                'data_debito' =>'required',
                'ef' =>'required',
                'valorOriginario'=>'required|numeric',
                'valorAtualizado'=>'required|numeric'
        ];
    }
    public function messages(){
        return [
            "nome.required"=>"O Campo 'Nome' é obrigatório",
            "cpf_cnpj.required"=>"O Campo 'Cpf/Cnpj' é obrigatório",
            "cpf_cnpj.numeric"=>"Digite o Campo cpf/cnpj sem pontos, traços ou barra Ex: Ex1234567891011",
            "processo.required"=>"O Campo 'Processo' é obrigatório",
            "data_debito.required"=>"O Campo 'Data do débito' é obrigatório",
            "ef.required"=>"O Campo 'Ef' é obrigatório",
            "valorOriginario.required"=>"O Campo 'Valor originário' é obrigatório",
            "valorAtualizado.required"=>"O Campo 'Valor atualizado' é obrigatório",
            "valorOriginario.numeric"=>"O campo 'Valor originario' tem que ser numérico",
            "valorAtualizado.numeric"=>"O campo 'Valor atualizado' tem que ser numérico"
        ];
    }
}
