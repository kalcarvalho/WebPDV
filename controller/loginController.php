<?php	
	ob_start();
	session_start();
    include_once '../persistence/UsuarioDAO.class.php';
    include_once '../domain/Usuario.class.php';
	include_once '../domain/Sistema.class.php';
	include_once '../persistence/SistemaDAO.class.php';

	$si = new Sistema();
	$sd = new SistemaDAO();
	
	// var_dump($_POST);
	
	// die();
	
	$si = $sd->findByPK($_POST['sistema_id']);
	
    $_SESSION['sistema'] = serialize($si);

    $ud = new UsuarioDAO($si);
    $u = new Usuario();
    $msg = "";


    $login = $_POST['login'];
    $senha = $_POST['senha']; //base64_encode($_POST['senha']);

    $u = $ud->findByLogin($login);
	
	
	
		
    if(!isset($u)) {
        $msg = base64_encode("Login não encontrado.");
        header('Location: ../administrator/login.php?msg='.$msg);
    } else  {
        if (strcmp(md5($senha), $u->getSenha()) == 0)  {
			session_regenerate_id();
            $_SESSION['webpdv'] = $login;
            $_SESSION['nome'] = $u->getNome();
            $_SESSION['codigo'] = $u->getCodigo();
            $_SESSION['perfil'] = $u->getPerfil();

            header('Location: ../administrator/main.php?p=home');

        } else {
            $msg = base64_encode("Senha ou login incorretos.");
            header('Location: ../administrator/login.php?msg='.$msg);
        }
    }

    exit();

    
?>
