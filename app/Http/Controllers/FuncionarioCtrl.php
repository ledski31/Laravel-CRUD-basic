<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionario;

class FuncionarioCtrl extends Controller
{
	public function pannel() {
		return view("funcionarios-pannel");
	}



	
	public function list() {
		return Funcionario::all();
	}




	public function show($id) {
		return Funcionario::where('id',$id)->get();
	}




	public function create() {
		# validação
		$v = request()->validate([
			'nome' => ['required','unique:funcionarios','min:3','max:100'],
			'cargo' => 'required',
			'endereco' => ['required','min:10','max:250'],
			'telefone' => ['required','min:9','max:14'],
			'nascimento' => 'required',
		]);

		# forma tradicional de persistir
		// $f = new Funcionario();
		// $f->nome = request('nome');
		// $f->cargo = request('cargo');
		// $f->endereco = request('endereco');
		// $f->telefone = request('telefone');
		// $f->nascimento = request('nascimento');
		// $f->save();

		# forma mass assignment de persistir
		# (Precisa da configuração do membro $fillable no model Funcionario)
		// $f = Funcionario::create([
		// 	'nome' => request('nome'),
		// 	'cargo' => request('cargo'),
		// 	'endereco' => request('endereco'),
		// 	'telefone' => request('telefone'),
		// 	'nascimento' => request('nascimento'),
		// ]);

		# forma mass assignment mas com o array validado
		$f = Funcionario::create( $v );

		# Se for uma página que faz requerimento via form,
		# deve-se redirecionar a página
		//return redirect('funcionarios/list');

		# No caso de uma página que faz requerimento asíncrono,
		# é melhor retornar um JSON
		return response()->json([
			'errors' => null,
			'lastId' => $f->id,
		]);

	}


}
