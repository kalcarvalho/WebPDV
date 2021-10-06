<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Especproduto.class.php';
	include_once '../persistence/EspecprodutoDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new EspecprodutoDAO($system);
	$esp = new Especproduto();

	$descricao = $_REQUEST['descricao'];
	$unidade = 2; // Un.
	$codbarras = $_REQUEST['codbarras'];
	$grupo = 9;
	
	$esp->setDescricao($descricao);
	$esp->setUnidade($unidade);
	$esp->setCodbarras($codbarras);
	$esp->setGrupoproduto($grupo);
	$esp->setEmpresa(1);
	
	
	$dao->insert($esp);

	// $xFile = '../temp/post.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// fwrite($fp, json_encode($_REQUEST));
	// fclose($fp);
	
?>