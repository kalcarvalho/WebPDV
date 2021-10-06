<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Estado.class.php';
	include_once '../persistence/EstadoDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new EstadoDAO($system);
	$uf = new Estado();
	$data = array();
	
	$rs = $dao->listAll();
	
	if($rs) {

		foreach($rs as $uf) {
	
			$data[] = array('id' => $uf->getCodigo(),'descricao' => $uf->getDescricao());
			
		}
		
	} else {
		$data[] = array('id' => 0,'descricao' => 'Nenhum dado encontrado.');
	}
	
	echo( json_encode( $data ) );
?>