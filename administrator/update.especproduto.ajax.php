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

	$id = $_REQUEST['codigo'];
	$descricao = $_REQUEST['descricao'];
	$codbarras = $_REQUEST['codbarras'];
	$custo = $_REQUEST['custo'];
	$venda = $_REQUEST['venda'];

	// $xFile = '../temp/post.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// foreach($_REQUEST as $key=>$value) {
		// fwrite($fp, $value);
	// }
	// fclose($fp);
	
	$esp->setCodigo($id);
	$esp->setDescricao($descricao);
	$esp->setCodbarras($codbarras);
	$esp->setCusto($custo);
	$esp->setVenda($venda);
	
	$result = $dao->update($esp);

	
?>