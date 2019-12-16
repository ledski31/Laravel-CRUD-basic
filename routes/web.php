<?php

# Routes gerais
Route::get('/', function () {
    return view('welcome');
});


# Routes para entidade User
Route::get('/users', 'UserCrtl@list');

# Route para API da entidade Cargo
Route::get( '/cargos', 'CargoCtrl@readAll' );

# Route para a página de Teste da API funcionários
Route::get( '/funcionarios', 'FuncionarioCtrl@pannel' );

# Routes da API funcinários
Route::get( '/funcionarios/list', 'FuncionarioCtrl@list' );
Route::get( '/funcionarios/show/{id?}', 'FuncionarioCtrl@show' );
Route::put( '/funcionarios/create', 'FuncionarioCtrl@create' );
Route::patch( '/funcionarios/update', 'FuncionarioCtrl@update' );
Route::delete( '/funcionarios/destroy', 'FuncionarioCtrl@destroy' );

?>