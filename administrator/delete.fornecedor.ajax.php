<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Fornecedor.class.php';
	include_once '../persistence/FornecedorDAO.class.php';
	
	//Recebendo dados via POST
	
	if (isset($_REQUEST['fornecedor_id'])) {
		$id = $_REQUEST['fornecedor_id'];
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new FornecedorDAO($system);
	
	$dao->delete($id);
	
?>