<?php
$u = new App\User();
$u->id = 1;
$u->name = 'Leandro Lino';
$u->email = 'ledlino@gmail.com';
$u->password = '00000000';
$u->save();

$u = new App\User();
$u->id = 2;
$u->name = 'Igor Siqueira';
$u->email = 'igorsiqueira@gmail.com';
$u->password = '00000000';
$u->save();

$u = new App\User();
$u->id = 3;
$u->name = 'Stefania';
$u->email = 'stefania@gmail.com';
$u->password = '00000000';
$u->save();

$c = new App\Cargo();
$c->id = 1;
$c->nome = 'Desenvolvedor PHP';
$c->save();

$c = new App\Cargo();
$c->id = 2;
$c->nome = 'Lider de Projeto';
$c->save();

$c = new App\Cargo();
$c->id = 3;
$c->nome = 'Recursos Humanos';
$c->save();

factory(App\Funcionario::class, 10)->create();

/*
$f = new App\Funcionario();
$f->id = 1;
$f->nome = "Leandro Lino";
// $f->username = "leandro";
$f->nascimento = "31/10/1983";
$f->cargo = "Desenvolvedor PHP";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();

$f = new App\Funcionario();
$f->id = 2;
$f->nome = "Igor Siqueira";
// $f->username = "igor";
$f->nascimento = "05/06/1990";
$f->cargo = "Desenvolvedor PHP";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();

$f = new App\Funcionario();
$f->id = 3;
$f->nome = "Stefânia";
// $f->username = "stefania";
$f->nascimento = "20/07/1990";
$f->cargo = "RH";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();
*/
?>