<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (file_exists(__DIR__ . '/defines.php'))
    include_once __DIR__ . '/defines.php';


if (!defined('_DEFINES')) {
    define('APP_PATH_BASE', __DIR__);
    require_once APP_PATH_BASE . '/includes/defines.php';
}


include_once APP_PATH_DOMAIN . '/Sistema.class.php';
include_once 'persistence/SistemaDAO.class.php';

$sd = new SistemaDAO();
$sis = new Sistema();

$list = $sd->listAll();

?>
<div id="container-login">

	<div id="topo-login">Acesso ao Sistema</div>
	<div id="imagem-login"></div>
	<div id="conteudo-login">

		<form action="../controller/loginController.php" method="POST">
			<p><label><img src="../images/userlogin.png" /></label><input class="field" type="text" size="30" name="login" value=""></p>
			<p><label><img src="../images/password.png" /></label><input type="password" class="field" size="30" name="senha" value=""></p>
			<p class="submit"><label></label><input name="submit" class="button" type="submit" value="Login"></p>
			<input type="hidden" name="sistema_id" value="5" />
			<!--
			<p><label>Sistema</label>
			
				<select name="sistema_id" class="field">
					<?php #include 'administrator/listar-sistemas.php'; 
					?>
				</select>
			</p>
			-->
		</form>

		<p class="error-message"><label></label><?php echo base64_decode($_GET['msg']); ?></p>
	</div>

</div>
<div id="rodape">SYSFACTOR Soluções em TI Ltda. &copy 2012</div>