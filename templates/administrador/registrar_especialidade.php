<div class='text-center'>
	<h2>Registrar Especialização de Médico</h2>
	<hr />
</div>
<?php  
	var_dump($_POST);
	insert($_POST, 'especializado');

	ob_clean();
	header('LOCATION: '.ADMINISTRADOR.'/listar_especializados');
?>