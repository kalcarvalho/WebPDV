<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Unidade.class.php';
	include_once '../persistence/UnidadeDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new UnidadeDAO($system);
	$uni = new Unidade();
	$data = array();
	
	$rs = $dao->listAll();
	
	if($rs) {

		foreach($rs as $uni) {
	
			$data[] = array('id' => $uni->getCodigo(), 'abreviacao' => $uni->getAbreviacao());
			
		}
		
	} else {
		$data[] = array('id' => 0, 'abreviacao' => 'Nenhum dado encontrado.');
	}
	
	echo( json_encode( $data ) );
?>