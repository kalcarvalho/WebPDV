<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/SolicMat.class.php';
	include_once '../persistence/SolicMatDAO.class.php';
	
	//Recebendo dados via POST
	if (isset($_POST['localizacao'])) {
		$loc = mysql_real_escape_string($_POST['localizacao']);
	}
	if (isset($_POST['solicmat'])) {
		$solicmat = mysql_real_escape_string($_POST['solicmat']);
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new SolicMatDAO($system);
	
	// $xFile = '../temp/sql.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// fwrite($fp, $solicmat);
	// fclose($fp);
	
	$result = $dao->updateLocalizacaoSM($solicmat, $loc);
	
	echo $result;
	

?>