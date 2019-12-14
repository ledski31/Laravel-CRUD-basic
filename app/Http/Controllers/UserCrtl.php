<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserCrtl extends Controller
{
   public function list() {
		return User::all(); 
	}
}
