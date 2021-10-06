<?php

	set_time_limit(0);
	
	session_start();
	
	include_once '../domain/Especproduto.class.php';
	include_once '../persistence/EspecprodutoDAO.class.php';
	
	include_once '../domain/Tabelapreco.class.php';
	include_once '../persistence/TabelaprecoDAO.class.php';
	
	include_once '../domain/Precoitem.class.php';
	include_once '../persistence/PrecoitemDAO.class.php';

	$data = array(
		'custo' => 1.99,
		'venda' => 2.99
	);
	
	echo( json_encode( $data ) );

?>