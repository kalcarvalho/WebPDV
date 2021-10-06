<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Especproduto.class.php';
	include_once '../persistence/EspecprodutoDAO.class.php';
	
	//Recebendo dados via POST
	
	if (isset($_REQUEST['produto_id'])) {
		$id = $_REQUEST['produto_id'];
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new EspecprodutoDAO($system);
	
	$dao->delete($id);
	
?>