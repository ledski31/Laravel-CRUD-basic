<?php

# Routes gerais
Route::get('/', function () {
    return view('welcome');
});


# Routes para entidade User
Route::get('/users', 'UserCrtl@list');


# ROUTES para entidade Funcionario
Route::get('/funcionarios', 'FuncionarioCtrl@pannel');

Route::get('/funcionarios/list', 'FuncionarioCtrl@list');
Route::get('/funcionarios/show/{id}', 'FuncionarioCtrl@show');

Route::put('/funcionarios/create', 'FuncionarioCtrl@create');
Route::patch('/funcionarios/update', 'FuncionarioCtrl@update');
Route::delete('/funcionarios/destroy', 'FuncionarioCtrl@destroy');

?>