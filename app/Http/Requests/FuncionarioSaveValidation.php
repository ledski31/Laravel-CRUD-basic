<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;




class FuncionarioSaveValidation extends FormRequest {




   /**
    * Determine if the user is authorized to make this request.
    * @return bool
    */
	public function authorize() {
   	return true;
   }




   /**
	 * Método chamado pelo framework quando faz a validação do request.
	 * Define as regras para a validação dos campos enviados pelo usuário
	 * para a criação ou update de um Funcionario.
    * @return array Regras de validação para request
    */
	public function rules() {
		# Regras para validação de Update
		if( $this->has('idModificar') )
			return $this->rulesUpdate();

		# Regras para validação de Create
		else
			return $this->rulesCreate();
	}




	/**
	 * Regras comuns tanto às regras de Create quando às regras de Update
	 */
	private $rulesCommon = [
		'cargo' => ['required','exists:cargos,id'],
		'endereco' => ['required','min:10','max:250'],
		'telefone' => ['nullable','min:9','max:14'],
		'nascimento' => 'required',
	];




	/**
	 * Método auxiliar para o método rules().
	 * Combina as regras específicas de Create com as comuns.
	 * @return array Regras de Create
	 */
	private function rulesCreate() {
		$r = [
			'nome' => ['required','unique:funcionarios,nome','min:3','max:100'],
		];
		return array_merge( $r, $this->rulesCommon );
	}




	/**
	 * Método auxiliar para o método rules().
	 * Combina as regras específicas de Update com as comuns.
	 * @return array Regras de Update
	 */
	private function rulesUpdate() {
		$r = [
			'idModificar' => 'exists:funcionarios,id',
			'nome' => [
				'required',
				# A linha abaixo define o nome deve ser unique na tabela funcionarios
				# na coluna 'nome', e não faz a comparação no registro com o id = $id.
				# Isso é importante para que um update não falhe, pois se o campo
				# 'nome' não for alterado, vai conflitar com ele mesmo no DB.
				'unique:funcionarios,nome,'.$this->idModificar.',id',
				'min:3','max:100'
			]
		];
		return array_merge( $r, $this->rulesCommon );
	}




	/**
	 * Definindo esse método, a gente faz override do comportamento padrão do
	 * Laravel que é retornar um redirect para o browser. Então podemos escrever
	 * nosso próprio retorno, que no caso vai ser JSON.
	 * Perceba que tem que importar Validator e HttpResponseException.
	 * @throws HttpResponseException
	 */
	protected function failedValidation( Validator $validator ) {
		// throw new HttpResponseException(response()->json($validator->errors(), 422));
		throw new HttpResponseException(
			response()->json(
				['error' => $validator->messages()->first()],
				422
			)
		);
	}
}
