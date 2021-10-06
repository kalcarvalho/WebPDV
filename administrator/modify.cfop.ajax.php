<?php

	set_time_limit(0);
	
	session_start();

	// header( 'Cache-Control: no-cache' );
	// header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/NotaFiscal.class.php';
	include_once '../domain/CFOP.class.php';
	include_once '../persistence/NotaFiscalDAO.class.php';
	include_once '../persistence/CFOPDAO.class.php';
	
	$co = new CFOP();
	$cd = new CFOP();
	
	//Recebendo dados via POST
	if (isset($_REQUEST['origem'])) {
		$origem = mysql_real_escape_string($_REQUEST['origem']);
	}
	if (isset($_REQUEST['destino'])) {
		$destino = mysql_real_escape_string($_REQUEST['destino']);
	}
	if (isset($_REQUEST['notafiscal'])) {
		$nfe = mysql_real_escape_string($_REQUEST['notafiscal']);
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$d1 = new NotaFiscalDAO($system);
	$d2 = new CFOPDAO($system);
	
	$co = $d2->findByReferencia($origem);
	$cd = $d2->findByReferencia($destino);
	
	// $text = "Origem=" . $co->getCodigo() . " ";
	// $text .= "Destino=" . $cd->getCodigo() . " ";
	
	// $xFile = '../temp/sql.ini';
	// ($fp = fopen($xFile, 'w')) or exit(0); 
	// fwrite($fp, json_encode($text));
	// fclose($fp);
	
	$result = $d1->updateCFOPNFe($nfe, $co->getCodigo(),  $cd->getCodigo(),  $cd->getReferencia());
	
	echo $result;
	

?>