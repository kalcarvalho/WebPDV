<?php

	$p = $_GET['p'];
    $p = (!isset($p)) ? "home.php" : $p . ".php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0.1 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="../estilo/estilo.css" />
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/prototype.js"></script>
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery.validate.js"></script>
        <script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>

        <title>Sistac - Controles Web!</title>
    </head>
    <body>
        <?php if (!isset($login)) {
 ?>
            <div id="master-head" >
                <div id="topo-admin">
                    <div class="head">
                        <a href="?"><img src="../images/logo.png" /></a>
                    </div>
                </div>
                <div id="menu-topo">
                    <div id="menu-topo-content">
						<?php include_once 'menu.php'; ?>
					</div>
                </div>
            </div>        
        <?php include_once $p; ?>
<?php } else { ?>
            <div id="master-head" >
                <div id="topo-admin">
                    <div class="head">
                        <a href="?"><img src="../images/logo.png" /></a>
                    </div>
                </div>
                <div id="menu-topo">
                    <div id="menu-topo-content">
<?php include_once 'menu.php'; ?>
                </div>
            </div>
        </div>
        <div id="wrapper">
            <div id="pre-casing">
                <div id="container">


                    <div id="mensagem"><?php echo "Bem-vindo, " . $_SESSION['nome']; ?></div>
                    <div id="conteudo"> <?php include_once $p; ?></div>

                </div>
            </div>
        </div>
        
<?php } ?>
    <div id="rodape">Sistac Sistemas de Acesso &copy 2012</div>
    </body>
</html>