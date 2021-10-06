<?php
	
	set_time_limit(0);
	
	
	session_start();
	
	$uuid = $_REQUEST['uuid'];
	$page = 1;
	$sortname = 'ntf_codigo';
	$sortorder = 'ASC';
	$qtype='';
	$query='';
	$rp = 15;
	
	
	//Recebendo dados via POST
	if (isset($_POST['page'])) {
		$page = mysql_real_escape_string($_POST['page']);
	}
	if (isset($_POST['sortname'])) {
		$sortname = mysql_real_escape_string($_POST['sortname']);
	}
	if (isset($_POST['sortorder'])) {
		$sortorder = mysql_real_escape_string($_POST['sortorder']);
	}
	if (isset($_POST['qtype'])) {
		$qtype = mysql_real_escape_string($_POST['qtype']);
	}
	if (isset($_POST['query'])) {
		$query = mysql_real_escape_string($_POST['query']);
	}
	if (isset($_REQUEST['rp'])) {
		$rp = mysql_real_escape_string($_REQUEST['rp']);
	}
	
	$sort = "$sortname $sortorder";
	$pageStart = ($page - 1) * $rp;
	$limit = "$pageStart,$rp";
	
	$fileName = "../temp/" . $uuid . ".ini";
	
	include_once '../domain/NotaFiscal.class.php';
	include_once '../persistence/NotaFiscalDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$nfe = new NotaFiscal();
	
	$dao = new NotaFiscalDAO($system);
	
	$rs = $dao->listAllNFes('2011-01-01', $qtype, $query, $sort, $limit);
	
	
	$i = 0;
	$list = array();
	$data = array();
	$data['rows'] = array();
	
		
	if($rs) {
	
		
		
		foreach($rs as $nfe) {
			
			($fp = fopen($fileName, 'w')) or exit(json_encode($data)); 
			$res = array("[$uuid]", "position=" . ++$i, "count=" . sizeof($rs));
			$res = implode("\r\n", $res);
			fwrite($fp, $res);
			fclose($fp);
			
			// $nfe = $dao->findByPKFormatted($nfe_id);
			
				
			$data['rows'][] = array(
				'id' => $nfe->getCodigo(),
				'cell' => array(
					$nfe->getCodigo(), 
					$nfe->getNumero(), 
					(($nfe->getTipo() == 0) ? "Saída" : "Entrada"), 
					date('d/m/Y',strtotime($nfe->getEmissao())),
					$nfe->getDestinatario(),
					number_format($nfe->getTotal(), 2, '.',''),
					(($nfe->getCancelada() != NULL) ? "Sim" : "Não"),
					$nfe->getProtocolo()
				)
			);
		
			array_push($list, $nfe->getCodigo());
				 
		}
	}
	
	if($i > 0) {
	
		$total = 0;
	
		$rs = $dao->listAllNFes('2011-01-01', $qtype, $query, $sort, "", $total);
		
		// $xFile = '../temp/sql.ini';
		// ($fp = fopen($xFile, 'w')) or exit(0); 
		// fwrite($fp, $total);
		// fclose($fp);
	
		$data['total'] = $total;
		$data['page'] = $page;
	
	}
	
	echo json_encode($data);
	
	
?>