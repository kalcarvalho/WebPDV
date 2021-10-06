<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Localizacao.class.php';
	include_once '../persistence/LocalizacaoDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new LocalizacaoDAO($system);
	$loc = new Localizacao();
	$data = array();
	
	$rs = $dao->listAll();
	
	if($rs) {

		foreach($rs as $loc) {
	
			$data[] = array('id' => $loc->getCodigo(),'descricao' => $loc->getDescricao());
			
		}
		
	} else {
		$data[] = array('id' => 0,'descricao' => 'Nenhum dado encontrado.');
	}
	
	echo( json_encode( $data ) );
?>