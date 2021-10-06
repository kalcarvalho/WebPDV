<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Pessoa.class.php';
	include_once '../persistence/PessoaDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new PessoaDAO($system);
	$pes = new Pessoa();
	$data = array();
	
	$rs = $dao->listAll();
	
	if($rs) {

		foreach($rs as $pes) {
	
			$data[] = array('id' => $pes->getCodigo(),'descricao' => $pes->getDescricao());
			
		}
		
	} else {
		$data[] = array('id' => 0,'descricao' => 'Nenhum dado encontrado.');
	}
	
	echo( json_encode( $data ) );
?>