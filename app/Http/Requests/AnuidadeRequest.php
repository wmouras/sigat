<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnuidadeRequest extends FormRequest
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
                'anuidadeInicial'=>'required|numeric',
                'anuidadeFinal'=>'required|numeric',
                'valorOriginario'=>'required|numeric',
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
            "anuidadeInicial.required"=>"O Campo 'Anuidade inicial' é obrigatório",
            "anuidadeFinal.required"=>"O Campo 'Anuidade final' é obrigatório",
            "valorOriginario.required"=>"O Campo 'Valor originário' é obrigatório",
            "valorAtualizado.required"=>"O Campo 'Valor atualizado' é obrigatório",
            "anuidadeInicial.numeric"=>"O campo 'Anuidade Inicial' tem que ser numérico",
            "anuidadeFinal.numeric"=>"O campo 'Anuidade Final' tem que ser numérico",
            "valorOriginario.numeric"=>"O campo 'Valor originario' tem que ser numérico",
        ];
    }
}
