<?php

session_start();

	if (array_key_exists('HTTP_USER_AGENT', $_SESSION)) {
		if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
		  /* Acesso inválido. O header User-Agent mudou
		   durante a mesma sessão. */
		  exit;
		}
	} else {
		/* Primeiro acesso do usuário, vamos gravar na sessão um
		hash md5 do header User-Agent */
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	}


	if (isset($_SESSION['webpdv'])){

		session_unset("webpdv"); // Eliminar todas as variáveis da sessão
		session_destroy("webpdv"); // Destruir a sessão
		header('Location: ../administrator/index.php');
	  
	} else {

		header('Location: ../administrator/index.php');
	  
	}
?>