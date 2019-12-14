<?php

# Routes gerais
Route::get('/', function () {
    return view('welcome');
});


# Routes para entidade User
Route::get('/users', 'UserCrtl@list');


# ROUTES para entidade Funcionario
Route::get('/funcionarios/list', 'FuncionarioCtrl@list');
Route::get('/funcionarios/show/{id}', 'FuncionarioCtrl@show');

?>