<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Funcionario;
use App\Http\Requests\FuncionarioSaveValidation;

class FuncionarioCtrl extends Controller
{
	/**
	 * Exibe a view da página de teste da API.
	 * @return View
	 */
	public function pannel() {
		return view("funcionarios-pannel");
	}



	
	/**
	 * Retorna uma lista com todos os usuários do banco de dados.
	 * @return JSON
	 */
	public function list() {
		$f = Funcionario::all();
		return response()->json(
			['error' => null, 'data' => $f,],
			200
		);
	}




	/**
	 * Busca o registro do usuário com id especificado.
	 * @param id Id do usuário
	 * @return JSON
	 */
	public function show( $id = null ) {
		// $f = Funcionario::where('id',$id)->get();
		$f = $this->assertGetFuncionarioById( $id );
		return response()->json(
			['error' => null, 'data' => $f,],
			200
		);
	}




	/**
	 * Cria um novo registro de usuário com os dados passados pela requisição
	 * post. A validação é feita pela classe FuncionarioSaveValidation.
	 * Retorna o objeto Funcionário criado ou os erros.
	 * @return JSON
	 */
	public function create( FuncionarioSaveValidation $req ) {
		$f = Funcionario::create( $req->validated() );
		return response()->json(
			['error' => null, 'data' => $f],
			200
		);
	}




	/**
	 * Método de update que usa Form Request Validation.
	 * Note que é preciso importar a classe FuncionarioSaveValidation.
	 * Nesse método a validação do request é feita antes de executá-lo, separando
	 * melhor as responsabilidades.
	 * @return JSON
	 */
	public function update( FuncionarioSaveValidation $req ) {
		$f = Funcionario::find( $req->idModificar );
		$f->update( $req->validated() );
		return response()->json(
			['error' => null, 'data' => $f],
			200
		);
	}




	/**
	 * Retorna um Funcionario da base.
	 * Se não existir o ID, throw um JSON de erro.
	 * @param id Número do ID do funcionário
	 * @return JSON
	 */
	protected function assertGetFuncionarioById( $id ) {
		$f = Funcionario::find( $id );
		if( $f == null ) {
			throw new HttpResponseException(
				response()->json(
					['error' => 'ID not found'],
					404
				)
			);
		}
		return $f;
	}




	/**
	 * Apaga do DB o registo de usuário com ID especificado pela requisição post.
	 * Retorna um JSON com os erros ou com os dados do registro apagado.
	 * @return JSON
	 */
	public function destroy() {
		$id = request('id');
		$f = $this->assertGetFuncionarioById( $id );
		Funcionario::destroy( $id );
		return response()->json(
			['error' => null, 'data' => $f]
		);
	}




	/*
	============================================================================
	OUTRAS FORMAS DE VALIDAÇÃO E PERSISTENCIA USADAS ANTERIORMENTE.
	SOMENTE REFERÊNCIA DO APRENDIZADO.
	============================================================================




	# Método create com validação manual inline para requisições de redirect
	public function create_inlineValidation1() {
		# A forma de validação usando resquest()->validate([]) é a forma mais rápida de validar,
		# e retorna um array com os campos validados,
		$camposValidados = request()->validate([
			'nome' => ['required','unique:funcionarios','min:3','max:100'],
			'cargo' => 'required',
			'endereco' => ['required','min:10','max:250'],
			'telefone' => ['required','min:9','max:14'],
			'nascimento' => 'required',
		]);
		# A forma acima porém não é a melhor. Caso ocorra um erro na validação, o
		# Laravel vai retornar por padrão um redirect para a mesma view e disponibilizar a varável
		# $error com os erros de cada campo. Portanto não é bom para requisições AJAX.
		# É Possível fazer com que o framework retorne um JSON automaticamente em caso de erro, ao
		# invés do redirect, se no código ajax for especificado o segiunte header:
		# "x-requested-with" = "XMLHttpRequest" como mostrado abaixo:
		#
		# var xhttp = new XMLHttpRequest();
		# xhttp.open("POST", "...url_da_request...", false);
		# xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8")
		# xhttp.setRequestHeader("x-requested-with","XMLHttpRequest")
		# xhttp.send( ...parametros... )
		# 
		# Dessa forma, caso ocorra um erro na validação em vez de retornar um redirect para a view
		# e disponibilizar a variavel $error, o Laravel vai retornar um response de JSON para
		# o navegador, com os erros.
		# Além disso é melhor separar as responsabilidades usando Form Request Validation
		

		# Forma tradicional de persistir
		// $f = new Funcionario();
		// $f->nome = request('nome');
		// $f->cargo = request('cargo');
		// $f->endereco = request('endereco');
		// $f->telefone = request('telefone');
		// $f->nascimento = request('nascimento');
		// $f->save();

		# Forma mass assignment de persistir:
		# Precisa da configuração do membro $fillable ou $guarded no model Funcionario.
		// $f = Funcionario::create([
		// 	'nome' => request('nome'),
		// 	'cargo' => request('cargo'),
		// 	'endereco' => request('endereco'),
		// 	'telefone' => request('telefone'),
		// 	'nascimento' => request('nascimento'),
		// ]);

		# Forma mass assignment com o array validado
		// $f = Funcionario::create( $camposValidados );

		# Outro problema com essa abordagem de validação é que se a validação não tiver problema,
		# o retorno tem que ser especificado, como uma das opções abaixo, ou um redirect ou um json,
		# e problema é que nessa parte o laravel não vai automaticamente retornar um json se a
		# o header da requisição possuir o atributo que o faz o reconhecer uma requisição ajax.
		# Portanto o retorno fica muito inconsistente.
		# Para requisições normais esse método funciona, mas para ajax não é bom.
		
		# Redirecionar a página
		return redirect('funcionarios/list');
		
		# Retorno de JSON
		// return response()->json([
		// 	'error' => null,
		// 	'lastId' => $f->id,
		// ]);
	}




	# Método create com validação inline 2
	public function create_inlineValidation2() {
		# Nessa forma temos controle exato do que vamos retornar, pois
		# o Laravel não faz retorno de redirect automático usando o 
		# Validator::make, portanto é bom  para retornar sempre um JSON
		# Mas ainda assim, é melhor usar Form Resquet Validation.
		$validator = Validator::make(request()->all(), [
			'nome' => ['required','unique:funcionarios','min:3','max:100'],
			'cargo' => 'required',
			'endereco' => ['required','min:10','max:250'],
			'telefone' => ['required','min:9','max:14'],
			'nascimento' => 'required',
		]);
		if( $validator->fails() ) {
			return response()->json([
				'error' => 'validation error',
				'message' => $validator->messages()->first()
			], 400);
		 }
		 else {
			$f = Funcionario::create( $validator->valid() );
		 	return response()->json([
				'error' => null,
				'lastId' => $f->id,
			 ], 200);
		}
	}




	


	# Método de update com validação inline.
	# É melhor separar a lógica de validação usando Form Request Validation
	public function update_ValidationInline() {
		# Procura o registro a ser alterado
		$f = Funcionario::find( request('idModificar') );
		if( $f == null ) {
			return response()->json([
				'error' => 'ID not found'
			], 400);
		}
		# Faz validações no input
		$validator = Validator::make( request()->all(),[
			'nome' => [
				'required',
				'unique:funcionarios,nome,'.$this->id.',id',
				'min:3','max:100'
			],
			'cargo' => 'required',
			'endereco' => ['required','min:10','max:250'],
			'telefone' => ['required','min:9','max:14'],
			'nascimento' => 'required',
		]);
		# Retorna o erro de validação
		if( $validator->fails() ) {
			return response()->json([
				'error' => 'validation error',
				'message' => $validator->messages()->first()
			], 400);
		}
		# Retorna o registro atualizado
		else {
			$f->update( $validator->valid() );
		 	return response()->json([
				'error' => null,
				'data' => $f,
			 ], 200);
		}
	}



	*/
}
