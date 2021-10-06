<?php

	set_time_limit(0);
	
	session_start();

	// header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Especproduto.class.php';
	include_once '../persistence/EspecprodutoDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new EspecprodutoDAO($system);
	$esp = new Especproduto();
	$data = array();
	
	$method = $_REQUEST['metodo'];
	
	if ($method == 'all') {
	
		$rs = $dao->listAll();
	
		if($rs) {

			foreach($rs as $esp) {
		
				$data[] = array('value' => $esp->getReferencia(),'label' => $esp->getDescricao());
				
			}
			
		} else {
			$data[] = array('value' => 0,'label' => 'Nenhum dado encontrado.');
		}
		
	} else if($method == 'item') {
		
		$ref = $_REQUEST['produto_ref'];
		
		$esp = $dao->findByReferencia($ref);
			
			if($esp) {
			
				$data[] = array(
					'referencia' => $esp->getReferencia(),
					'descricao' => $esp->getDescricao()
				);
			}
	}
	
	echo( json_encode( $data ) );
?>