<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Fornecedor.class.php';
	include_once '../persistence/FornecedorDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new FornecedorDAO($system);
	$frn = new Fornecedor();

	$nome = $_REQUEST['nome'];
	$pessoa = $_REQUEST['pessoa'];
	$cpfcnpj = $_REQUEST['cpfcnpj'];
	$cidade = $_REQUEST['cidade'];
	$rginsest = $_REQUEST['rginsest'];
	$cep = $_REQUEST['cep'];
	$logradouro = $_REQUEST['logradouro'];
	$numero = $_REQUEST['numero'];
	$complemento = $_REQUEST['complemento'];
	$bairro = $_REQUEST['bairro'];
	$estado = 1; //$_REQUEST['estado'];
	$residencial = $_REQUEST['residencial'];
	$comercial = $_REQUEST['comercial'];
	$celular = $_REQUEST['celular'];
	$email = $_REQUEST['email'];
	$id = $_REQUEST['codigo'];

	// $xFile = '../temp/post.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// foreach($_REQUEST as $key=>$value) {
		// fwrite($fp, $value);
	// }
	// fclose($fp);
	
	$frn->setCodigo($id);
	$frn->setNomerazao($nome);
	$frn->setCpfcnpj($cpfcnpj);
	$frn->setPessoa($pessoa);
	$frn->setRginsest($rginsest);
	$frn->setCep($cep);
	$frn->setEndereco($logradouro);
	$frn->setNumero($numero);
	$frn->setComplemento($complemento);
	$frn->setBairro($bairro);
	$frn->setCidade($cidade);
	$frn->setEstado($estado);
	$frn->setTelefone($residencial);
	$frn->setComercial($comercial);
	$frn->setCelular($celular);
	$frn->setEmail($email);
	$frn->setEmpresa(1); //provisóriamente - tratar mais tarde.
	
	$result = $dao->update($frn);

	
?>