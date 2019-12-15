<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
	// $fillabe e $guarded significam coisas opostas
	// $fillable determina quais campos podem ser preechidos com mass assignment
	// $guarded determina quais não podem 
	# protected $fillable = ['nome','cargo','endereco','telefone','nascimento'];
	protected $guarded = [];
}
