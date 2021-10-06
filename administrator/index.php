<?php
require_once '../domain/Sistema.class.php';

session_start();

$uuid = uniqid();


if (array_key_exists('HTTP_USER_AGENT', $_SESSION)) {
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
        /* Acesso inválido. O header User-Agent mudou
          durante a mesma sessão. */
		  
		$p = "../login.php";
		$userAgent = false;
		
		session_unset("webpdv"); // Eliminar todas as variáveis da sessão
		session_destroy(); // Destruir a sessão
		
    } else {
		$userAgent = true;
	}
} else {

    /* Primeiro acesso do usuário, vamos gravar na sessão um
      hash md5 do header User-Agent */
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	$userAgent = true;
}


if($userAgent) {
	$login = $_SESSION['webpdv'];


	if (!isset($login)) {
		$p = "login.php";
	} else {

		$system = unserialize($_SESSION['sistema']);

		$p = $_GET['p'];
		$p = (!isset($p)) ? "main.php?=home" : "main.php?=".$p;
	}
}

header('Location: ' . $p);

exit;