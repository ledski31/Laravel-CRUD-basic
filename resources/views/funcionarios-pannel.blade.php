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
	input[type="submit"],
	input[type="button"] {
		width: 100%;
	}
	form {
		line-height: 1.6em;
	}
	.alert {
		color: red;
	}
</style>


<h1>Teste da API de funcionários</h1>


<form action='funcionarios/list/' method='get'>
	<fieldset>
		<legend>Listar todos os registros - GET /funcionarios/list</legend>
		<input type='submit' value='Listar'/>
	</fieldset>
</form>


<br>


<form onsubmit="
	event.preventDefault();
	window.location.href='funcionarios/show/'+this.idShow.value
	">
	<fieldset>
		<legend>Buscar registro - GET /funcionarios/show/:id</legend>
		<label for='idShow'>ID do registro</label>
		<input id='idShow' name='idShow' type='number' value='' />
		<br>
		<input type='submit' value='Buscar' />
	</fieldset>
</form>


<br>


<form action='funcionarios/create' method='post' name='formNovo'>
	<!-- cross site request forgery: proeteção contra ataque cross-site -->
	@csrf
	<!-- especificar para o Laravel que o método é PUT, pois os navegadores só
	     entendem GET e POST. Não é necessário, mas é boa prática. -->
	@method('PUT')
	<fieldset>
		<legend>Criar novo registro - POST /funcionarios/create</legend>

		<!-- Mostra o primeiro erro de validação se houver algum -->
		@if (!$errors->isEmpty())
			<p class='alert'>{{ $errors->first() }}</p>
		@endif
		
		<label for='cNome'>Nome</label>
		<input id='cNome' type='text' value='{{ old('nome') }}' name='nome' />
		
		<br>
		<label for='cCargo'>Cargo</label>
		<input id='cCargo' type='number' value='{{ old('cargo') }}' name='cargo' onchange='showCargoNome( this.value,"cCargoNome" ) '/>
		<span id='cCargoNome'></span>
		
		<br>
		<label for='cEndereco'>Endereço</label>
		<input id='cEndereco' type='text' value='{{ old('endereco') }}' name='endereco' />
		
		<br>
		<label for='cTelefone'>Telefone</label>
		<input id='cTelefone' type='text' value='{{ old('telefone') }}' name='telefone' placeholder="(xx) xxxx xxxx" />
		
		<br>
		<label for='cNascimento'>Data de nascimento</label>
		<input id='cNascimento' type='date' value='{{ old('nascimento') }}' name='nascimento' />
		
		<br>
		<input type='submit' value='Criar'>
		<!--
		<button onclick="requestCreate()">AJAX</button>
		-->
	</fieldset>
</form>
	

<br>
	

<form action="funcionarios/update" method="post" name="formModificar">
	@csrf
	@method('PATCH')
	<fieldset>
		<legend>Modificar registro - POST /funcionarios/update</legend>
		<label for='idModificar'>ID do registro</label>
		<input id='idModificar' type='number' value='' name='idModificar' onchange="carregarRegistro( this.value )" />
		<span>ID não pode ser alterdo</span>
		<!--
		<button onclick="event.preventDefault(); carregarRegistro()">Carregar</button>
		-->

		<br>
		<label for='mNome'>Nome</label>
		<input id='mNome' type='text' value='{{ old('nome') }}' name='nome' />
		
		<br>
		<label for='mCargo'>Cargo</label>
		<input id='mCargo' type='number' value='{{ old('cargo') }}' name='cargo' onchange='showCargoNome( this.value,"mCargoNome" )' />
		<span id='mCargoNome'></span>
		
		<br>
		<label for='mEndereco'>Endereço</label>
		<input id='mEndereco' type='text' value='{{ old('endereco') }}' name='endereco' />
		
		<br>
		<label for='mTelefone'>Telefone</label>
		<input id='mTelefone' type='text' value='{{ old('telefone') }}' name='telefone' placeholder="(xx) xxxx xxxx" />
		
		<br>
		<label for='mNascimento'>Data de nascimento</label>
		<input id='mNascimento' type='date' value='{{ old('nascimento') }}' name='nascimento' />

		<br>
		<input type='submit' value='Modificar'>
	</fieldset>
</form>	


<br>

	
<form action='funcionarios/destroy' method='post' name='formApagar'>
<!-- cross site request forgery: proeteção contra ataque cross-site -->
@csrf
<!-- especificar para o Laravel que o método é DELETE, pois os navegadores só
     entendem GET e POST. Não é necessário, principalmente neste caso em que
	  a route é específica para apagar, mas torna o código mais claro. -->
	@method('DELETE')
	<fieldset>
		<legend>Apagar registro - POST /funcionarios/destroy</legend>
		<label for='id'>ID do registro</label>
		<input id='id' type='number' value='' name='id' />
		<br>
		<input type='submit' value='Apagar' />
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




	/**
	*	Carrega o registro ao mudar o ID no fieldset de Update
	*/
	function carregarRegistro(id) {
		if( id.length == 0 ) resetModificarCampos();
		else {
			let xhttp = new XMLHttpRequest();
			xhttp.open("GET", "funcionarios/show/"+id, false);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send()
			let r = JSON.parse( xhttp.responseText )
			if( r.error == null ) {
				r = r.data
				formModificar.nome.value = r.nome
				formModificar.cargo.value = r.cargo
				formModificar.endereco.value = r.endereco
				formModificar.telefone.value = r.telefone
				formModificar.nascimento.value = r.nascimento
				showCargoNome( r.cargo, "mCargoNome" )
			} else resetModificarCampos();
		}
	}




	/**
	*	Limpa todos os campos do fieldset de Update
	*/
	function resetModificarCampos() {
		formModificar.nome.value = ''
		formModificar.cargo.value = ''
		formModificar.endereco.value = ''
		formModificar.telefone.value = ''
		formModificar.nascimento.value = ''
	}




	/**
	*	Exibe o nome do cargo ao lado do campo
	*/
	function showCargoNome( id, fieldId ) {
		let nome = ''
		for( let i = 0; i < window.cargos.length; i++ ) {
			if( window.cargos[i].id == id ) {
				nome = window.cargos[i].nome
				break
			}
		}
		document.getElementById( fieldId ).innerHTML = nome
	}



	
	/**
	*	Carrega a lista de Cargos na memoria ao carregar a página para que fique
	*	fácil de pesquisar o nome do cargo ao alterar os campos de id de cargo.
	*/
	window.onload = function() {
		window.cargos = syncGet( "cargos" )
	}




	/**
	*	Faz uma requisição GET para um dos endpoints da API,
	*	espeificado no parametro uri
	*/
	function syncGet( uri ) {
		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", uri, false);
		xhttp.send()
		return JSON.parse( xhttp.responseText ).data
	}




	function requestCreate() {
		preventDefault();
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "funcionarios/create", false);
		// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// xhttp.send("fname=Henry&lname=Ford");
		xhttp.setRequestHeader("Content-type","application/json;charset=UTF-8")
		xhttp.setRequestHeader("x-requested-with","XMLHttpRequest")
		var body = JSON.stringify({
			_token: formNovo._token.value,
			_method: formNovo._method.value,
			nome: formNovo.nome.value,
			cargo: formNovo.cargo.value,
			endereco: formNovo.endereco.value,
			telefone: formNovo.telefone.value,
			nascimento: formNovo.nascimento.value,
		})
		xhttp.send(body)
		document.innerHTML = xhttp.responseText
	}
</script>

@endsection