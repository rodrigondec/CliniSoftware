<?php

	define('ARQUIVOS', $_SERVER['DOCUMENT_ROOT']);
	define('BASE', 'CliniSoftware/'); // XAMPP
	define('TEMPLATES', ARQUIVOS.'/'.BASE.'templates/');
	
	define('LOGIN', ARQUIVOS.'/'.BASE.'login.php');

	define('SISTEMA', '/'.BASE.'index.php/sistema/');

	define('DB_NAME', 'CliniSoftware'); //Mudar para o nome do banco
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_HOST', 'localhost');

	define('LINK', mysql_connect(DB_HOST, DB_USER, DB_PASS));
	mysql_select_db(DB_NAME, LINK);
	mysql_set_charset('utf8', LINK);

	ob_start(); //Criando Buffer
	session_start();
	date_default_timezone_set('America/Recife');
	include_once('functions.php');
	include_once('banco.php');
?>