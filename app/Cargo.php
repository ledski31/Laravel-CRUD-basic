<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model {

	public function getFuncionarios() {
		return $this->hasMany( Funcionario::class, 'cargo' );
	}
}
