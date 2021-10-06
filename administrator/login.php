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
		$p = "../login.php";
	} else {

		$system = unserialize($_SESSION['sistema']);

		$p = $_GET['p'];
		$p = (!isset($p)) ? "home.php" : $p . ".php";
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0.1 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="../estilo/login.css" />
		
        <link rel="stylesheet" type="text/css" href="../estilo/jquery-ui-1.8.23.custom.css" />
		<link href="../estilo/flexigrid.css" rel="stylesheet" type="text/css" />
        <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>-->
        <script type="text/javascript" src="../js/jquery-1.5.2.min.js"></script>
        <!--<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>-->
        <script type="text/javascript" src="../js/jquery.form.js"></script>

        <script type="text/javascript" src="../js/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="../js/ui/jquery-ui-1.8.23.custom.js"></script>
		<script type="text/javascript" src="../js/ui/jquery.ui.autocomplete.js"></script>
		<script type="text/javascript" src="../js/ui.selectmenu.js"></script>

        <title>WebPDV - Ponto de Venda</title>
		
    </head>
    <body>
		<div id="login-container">
        <?php if (!isset($login)) { ?>
            <div id="logo">
				<a href="?"><img width="200px" src="../images/logo.png" /></a>
			</div>
                   
                
        <?php include_once $p; ?>
	<?php } else { ?>
			
	<?php } ?>
	</div>
    </body>
</html>
