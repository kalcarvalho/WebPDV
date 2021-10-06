<?php

	set_time_limit(0);
	
	session_start();

	// header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Cliente.class.php';
	include_once '../persistence/ClienteDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new ClienteDAO($system);
	$cli = new Cliente();

	$nome = $_REQUEST['nome'];
	$pessoa = $_REQUEST['pessoa'];
	$cpfcnpj = $_REQUEST['cpfcnpj'];
	$cidade = $_REQUEST['cpfcnpj'];
	$rginsest = $_REQUEST['rginsest'];
	$cep = $_REQUEST['cep'];
	$logradouro = $_REQUEST['logradouro'];
	$numero = $_REQUEST['numero'];
	$complemento = $_REQUEST['complemento'];
	$bairro = $_REQUEST['bairro'];
	$estado = 1; //$_REQUEST['estado'];
	$residencial = $_REQUEST['telefone'];
	$comercial = $_REQUEST['comercial'];
	$celular = $_REQUEST['celular'];
	$email = $_REQUEST['email'];
	
	$cli->setNomerazao($nome);
	$cli->setCpfcnpj($cpfcnpj);
	$cli->setPessoa($pessoa);
	$cli->setRginsest($rginsest);
	$cli->setCep($cep);
	$cli->setEndereco($logradouro);
	$cli->setNumero($numero);
	$cli->setComplemento($complemento);
	$cli->setBairro($bairro);
	$cli->setCidade($cidade);
	$cli->setEstado($estado);
	$cli->setTelefone($residencial);
	$cli->setComercial($comercial);
	$cli->setCelular($celular);
	$cli->setEmail($email);
	$cli->setEmpresa(1); //provisóriamente - tratar mais tarde.
	
	$dao->insert($cli);

	// $xFile = '../temp/post.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// fwrite($fp, $nome);
	// fclose($fp);
	
?>