<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargo;




class CargoCtrl extends Controller {




	public function readAll() {
		//$c = Cargo::find( $id );
		$c = Cargo::all();
		return response()->json(
			['error' => $c == null ? 'ID não encontrado' : null, 'data' => $c]
		);
	}
}
