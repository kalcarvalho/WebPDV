<?php
require_once '../domain/Sistema.class.php';
include_once '../domain/Modulo.class.php';
include_once '../persistence/ModuloDAO.class.php';

session_start();

$uuid = uniqid();


if (array_key_exists('HTTP_USER_AGENT', $_SESSION)) {
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
        /* Acesso inválido. O header User-Agent mudou
          durante a mesma sessão. */
		  
		$p = "login.php?msg=1";
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
		$p = "login.php?msg=2";
		header('Location: '.$p);
		exit;
	} 
	
	$system = unserialize($_SESSION['sistema']);

	$p = $_GET['p'];
	$p = (!isset($p)) ? "home.php" : $p . ".php";

} else {
	header('Location: '.$p);
	exit;
}



?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="../css/bootstrap-responsive.css" rel="stylesheet">
    	<link href="../css/bootstrap.css" rel="stylesheet">
    	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilo/estilo.css" />
        <link rel="stylesheet" type="text/css" href="../estilo/jquery-ui-1.8.23.custom.css" />
		<link href="../estilo/flexigrid.css" rel="stylesheet" type="text/css" />
        

        <title>WebPDV - Ponto de Venda</title>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../js/bootstrap.min.js"></script>

		<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.2.min.js"></script>-->
        <script type="text/javascript" src="../js/jquery-1.5.2.min.js"></script>
        <!--<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>-->
        <script type="text/javascript" src="../js/jquery.form.js"></script>

        <script type="text/javascript" src="../js/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.ui.position.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="../js/ui/jquery-ui-1.8.23.custom.js"></script>
        <script type="text/javascript" src="../js/flexigrid.js"></script>

		
        <!--<script type="text/javascript" src="../js/flexigrid.pack.js"></script>-->
		<script type="text/javascript" src="../js/jquery.progressbar.js"></script>
		<script type="text/javascript" src="../js/ui/jquery.ui.autocomplete.js"></script>
		<script type="text/javascript" src="../js/ui.selectmenu.js"></script>
		
    </head>
    <body data-color="#eee" class="flat">
    	<div class="modal fade hidden-print" id="myModal"></div>
    	<div id="wrapper">
	
		   <div id="header">
		   		<h1>
					<a href="?">
						<img src="../images/logointerno.png" height="45px" id="header-logo" />
					</a>
				</h1>
				<a id="menu-trigger" href="#">
					<i class="fa fa-bars fa fa-2x"></i>
				</a>
				<div class="clear"></div>
		   </div>
		   
			<div id="user-nav">
				<?php include_once 'topo.php'; ?>
			</div>
		   
			<div id="sidebar">
				<?php include_once 'menu.php'; ?>
			</div>
			<div id="container">
				<div id="conteudo">
					<?php include_once 'titulo.php'; ?>
					<?php include_once $p; ?>
				</div>
			</div>
		</div><!-- end wrapper -->

		

		<script type="text/javascript">
			var progress_key = '<?php echo $uuid; ?>';

			$(document).ready(function() {
				$("#pb1").progressBar();
				/* $("#pb2").progressBar({ barImage: 'images/progressbg_yellow.gif'} );
				$("#pb3").progressBar({ barImage: 'images/progressbg_orange.gif', showText: false} );
				$("#pb4").progressBar(65, { showText: false, barImage: 'images/progressbg_red.gif'} );
				$(".pb5").progressBar({ max: '2000', textFormat: 'fraction', callback: function(data) { if (data.running_value == data.value) { alert("Callback example: Target reached!"); } }} ); */
				beginUpload();
				
			});
			
			function beginUpload() {
				
				
				setInterval(function() { 
					$.getJSON("load-progress-bar.php?id=" + progress_key, function(data) {
						if (data == null)
							return;
						
						var percentage = Math.floor(100 * parseInt(data.position) / parseInt(data.count));
						
						$("#pb1").progressBar(percentage);
					});
				}, 1500);

				return true;
			}
		</script>
    </body>
</html>
