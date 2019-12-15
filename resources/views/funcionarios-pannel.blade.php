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


<h1>Teste da API de funcionários</h1>


<form action='funcionarios/list/' method='get'>
	<fieldset>
		<legend>Listar todos os registros - /funcionarios/list - método get</legend>
		<input type='submit' value='Listar'/>
	</fieldset>
</form>


<br>


<form name='formShow'>
	<fieldset>
		<legend>Buscar registros - /funcionarios/show/:id - método get</legend>
		<label for='id'>ID do registro</label>
		<input id='id' type='number' value='' name='id' />
		<br>
		<input type='button' value='Buscar'
			onclick="window.location.href='funcionarios/show/'+formShow.id.value" />
	</fieldset>
</form>


<br>


<form action='funcionarios/create' method='post'>
	@csrf
	@method('PUT')
	<fieldset>
		<legend>Criar novo registro - /funcionarios/create - método post</legend>

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
	

	<br>
	

	<fieldset>
		<legend>Modificar registro - /funcionarios/update - método post</legend>
		<label for='id'>Carregar registro ID</label>
		<input id='id' type='number' value='' />
		<button>Carregar</button>
		<hr>
	</fieldset>
	

	<br>

	
	<form action='funcionarios/destroy' method='post' name='formApagar'>
		@csrf
		@method('DELETE')
		<fieldset>
			<legend>Apagar registro - /funcionarios/destroy - método post</legend>
			<label for='id'>ID do registro</label>
			<input id='id' type='number' value='' name='id' required />
			<br>
			<input type='button' value='Apagar' onclick='apagarRegistro()' />
		</fieldset>
	</form>



	
	<script>
		function apagarRegistro() {
			var id = formApagar.id.value
			if( id.length > 0 ) {
				var confirmacao = confirm("Tem certeza que deseja apagar o registro " + id + "?")
				if( confirmacao ) {
					formApagar.submit()
				}
			}
		}
	</script>
@endsection