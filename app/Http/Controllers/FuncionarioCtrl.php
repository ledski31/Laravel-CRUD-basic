<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionario;

class FuncionarioCtrl extends Controller
{
	public function list() {
		return Funcionario::all();
	}

	public function show($id) {
		return Funcionario::where('id',$id)->get();
	}
}
