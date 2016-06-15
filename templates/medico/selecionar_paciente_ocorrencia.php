<div class='text-center'>
	<h2>Cadastrar Ocorrência Médica</h2>
	<hr />
</div>
<?php  
	$pacientes = run_select_many('select idpaciente, nome from pessoa natural join paciente;');
	// var_dump($pacientes);
?>
<div class='container col-lg-5 center'>
	<form method='post' action='<?php echo MEDICO."/cadastrar_ocorrencia" ?>'>
		<div class="form-group col-lg-12">
			<label for="sel1">Pacientes</label>
			<select class="form-control" name='idpaciente' required>
				<option value='' selected disabled>Selecione um paciente</option>
				<?php foreach($pacientes as $key => $paciente): ?>
				<option value='<?php echo $paciente["idpaciente"]; ?>'>
					<?php echo $paciente["nome"]; ?>	
				</option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class='text-center col-lg-12'>
			<button class='btn btn-danger' type='reset'>Apagar</button>
            <button class='btn btn-primary' type='submit'>Prosseguir</button>
		</div>
	</form>
</div>