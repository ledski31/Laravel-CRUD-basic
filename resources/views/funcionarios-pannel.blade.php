@extends('layout-basic')

@section('body')
<style>
	label {
		display: inline-block;
		width: 10em;
	}
	input {
		display: inline-block;
		width: 20em;
	}
	form {
		line-height: 2em;
	}
	.alert {
		color: red;
	}
</style>
<h1>Gerenciador de Funcionário</h1>
<form action='funcionarios/create' method='post'>
	@csrf
	@method('PUT')
	<fieldset>
		<legend>Criar novo registro de funcionário</legend>

		<!-- Mostra o primeiro erro de validação se houver algum -->
		@if (!$errors->isEmpty())
			<p class='alert'>{{ $errors->first() }}</p>
		@endif
		
		<label for='nome'>Nome</label>
		<input id='nome' type='text' value='{{ old('nome') }}' name='nome' />
		
		<br>
		<label for='cargo'>Cargo</label>
		<input id='cargo' type='number' value='{{ old('cargo') }}' name='cargo' />
		
		<br>
		<label for='endereco'>Endereço</label>
		<input id='endereco' type='text' value='{{ old('endereco') }}' name='endereco' />
		
		<br>
		<label for='telefone'>Telefone</label>
		<input id='telefone' type='text' value='{{ old('telefone') }}' name='telefone' placeholder="(xx) xxxx xxxx" />
		
		<br>
		<label for='nascimento'>Data de nascimento</label>
		<input id='nascimento' type='date' value='{{ old('nascimento') }}' name='nascimento' />
		
		<br>
		<br>
		<input type='submit' value='Criar'>
	</fieldset>	
</form>
@endsection