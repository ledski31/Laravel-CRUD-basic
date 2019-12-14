<?php

$f = new App\Funcionario();
$f->id = 1;
$f->nome = "Leandro Lino";
$f->username = "leandro";
$f->nascimento = "31/10/1983";
$f->cargo = "Desenvolvedor PHP";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();

$f = new App\Funcionario();
$f->id = 2;
$f->nome = "Igor Siqueira";
$f->username = "igor";
$f->nascimento = "05/06/1990";
$f->cargo = "Desenvolvedor PHP";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();

$f = new App\Funcionario();
$f->id = 3;
$f->nome = "Stefânia";
$f->username = "stefania";
$f->nascimento = "20/07/1990";
$f->cargo = "RH";
$f->telefone = "31 99238 1729";
$f->carteira = "123123123";
$f->cpf = "123123123";
$f->save();

?>