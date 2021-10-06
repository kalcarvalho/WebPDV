<?php

	set_time_limit(0);
	
	session_start();

	// header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/SolicMat.class.php';
	include_once '../persistence/SolicMatDAO.class.php';
	
	//Recebendo dados via POST
	if (isset($_POST['solicmat'])) {
		$solicmat = mysql_real_escape_string($_POST['solicmat']);
		// $solicmat = ($_POST['solicmat']);
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new SolicMatDAO($system);
	
	$result = $dao->updateRevokeAutorizacao($solicmat);
	
	echo $result;
	
	// $xFile = '../temp/sql.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// fwrite($fp, $result);
	// fclose($fp);
	
?>
