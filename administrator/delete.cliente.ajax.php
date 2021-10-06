<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Cliente.class.php';
	include_once '../persistence/ClienteDAO.class.php';
	
	//Recebendo dados via POST
	
	if (isset($_POST['cliente_id'])) {
		$id = $_POST['cliente_id'];
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new ClienteDAO($system);
	
	$dao->delete($id);
	
?>