<div class='text-center'>
	<h2>Cadastrar Recepcionista</h2>
	<hr />
</div>
<script>
	jQuery(function($){
		$("#telefone").mask("(00) 00000-0000");
		$("#cpf").mask("000.000.000-00");
		$('#salario').mask("###0.00", {reverse: true});
		$("#data").mask("00");
	});
</script>
<div class='container col-lg-5 center'>
	<form method='post'>
		<div class='form-group col-lg-12'>
		    <label for='nome'>Nome</label>
		    <input type='text' name='nome' class='form-control' placeholder='Digite o nome aqui' required />
		</div>
		<div class='form-group col-lg-7'>
		    <label for='email'>Email</label>
		    <input type='email' name='email' class='form-control' placeholder='Digite aqui o email' required />
		</div>
		<div class='form-group  col-lg-5'>
		    <label for='telefone'>Telefone</label>
		    <input id="telefone" type='text' name='telefone' class='form-control' placeholder='Digite aqui o telefone' required />
		</div>
		<div class='form-group col-lg-7'>
		    <label for='cpf'>CPF</label>
		    <input id="cpf" type='text' name='cpf' class='form-control' placeholder='Digite o cpf aqui' required />
		</div>
		<div class='form-group col-lg-5'>
		    <label for='data'>Data de Nascimento</label>
		    <input type='date' name='data_nascimento' class='form-control' placeholder='Digite a data de nascimento aqui' required />
		</div>
		<div class='form-group col-lg-7'>
		    <label for='salario'>Salário</label>
		    <input id='salario' type='number' step='any' name='salario' class='form-control' placeholder='Digite aqui o salário' min='500' required />
		</div>
		<div class='form-group col-lg-5'>
		    <label for='data_pagamento'>Data de Pagamento</label>
		    <input id='data' type='number' name='data_pagamento' class='form-control' placeholder='Digite aqui a data' min='03' max='20' required />
		</div>
		<div class='text-center col-lg-12'>
			<button class='btn btn-danger' type='reset'>Apagar</button>
            <button class='btn btn-primary' type='submit'>Cadastrar</button>
		</div>
	</form>
</div>
<?php  
	if(count($_POST) > 0){
		// var_dump($_POST); echo '<br><br>';
		/* CADASTRO DE PESSOA OU VERIFICAÇÃO */
		$pessoa = run_select('select * from pessoa where email=\''.$_POST['email'].'\';');
		if($pessoa){ 
			/* PESSOA JÁ EXISTE */
			// var_dump($pessoa);

			$funcionario = run_select('select * from funcionario where idpessoa='.$pessoa['idpessoa'].';');
			if(!$funcionario){
				$funcionario = array();
				$funcionario['idpessoa'] = $pessoa['idpessoa'];
				$funcionario['salario'] = $_POST['salario'];
				$funcionario['data_pagamento'] = $_POST['data_pagamento'];

				insert($funcionario, 'funcionario');
				$funcionario['idfuncionario'] = run_select('select max(idfuncionario) from funcionario;')['max(idfuncionario)'];
			}
			
			$recepcionista = run_select('select * from recepcionista where idfuncionario='.$funcionario['idfuncionario'].';');
			if(!$recepcionista){
				$recepcionista = array();
				$recepcionista['idfuncionario'] = $funcionario['idfuncionario'];

				insert($recepcionista, 'recepcionista');

				ob_clean();
				header('LOCATION: '.ADMINISTRADOR.'/listar_recepcionistas');
			}
			else{
				swal('Erro!', 'Essa pessoa já está cadastrada como um recepcionista', 'error', ADMINISTRADOR.'/cadastrar_recepcionista', 'btn-danger');
			}
		}
		else{
			/* CADASTRO PESSOA */
			$pessoa = array();
			$pessoa['nome'] = $_POST['nome'];
			$pessoa['data_nascimento'] = $_POST['data_nascimento'];
			$pessoa['telefone'] = $_POST['telefone'];
			$pessoa['email'] = $_POST['email'];
			$pessoa['cpf'] = $_POST['cpf'];

			insert($pessoa, 'pessoa');
			$idpessoa = run_select('select max(idpessoa) from pessoa;');

			$funcionario = array();
			$funcionario['idpessoa'] = $idpessoa['max(idpessoa)'];
			$funcionario['salario'] = $_POST['salario'];
			$funcionario['data_pagamento'] = $_POST['data_pagamento'];

			insert($funcionario, 'funcionario');
			$idfuncionario = run_select('select max(idfuncionario) from funcionario;');

			$recepcionista = array();
			$recepcionista['idfuncionario'] = $idfuncionario['max(idfuncionario)'];

			insert($recepcionista, 'recepcionista');

			ob_clean();
			header('LOCATION: '.ADMINISTRADOR.'/listar_recepcionistas');
		}
	}
?>