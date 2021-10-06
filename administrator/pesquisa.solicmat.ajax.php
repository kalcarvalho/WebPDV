<?php
	
	set_time_limit(0);
	
	
	session_start();
	
	$uuid = $_REQUEST['uuid'];
	$page = 1;
	$sortname = 'sma_codigo';
	$sortorder = 'ASC';
	$qtype='';
	$query='';
	$rp = 15;
	
	
	//Recebendo dados via POST
	if (isset($_POST['page'])) {
		$page = ($_POST['page']);
	}
	if (isset($_POST['sortname'])) {
		$sortname = ($_POST['sortname']);
	}
	if (isset($_POST['sortorder'])) {
		$sortorder = ($_POST['sortorder']);
	}
	if (isset($_POST['qtype'])) {
		$qtype = ($_POST['qtype']);
	}
	if (isset($_POST['query'])) {
		$query = ($_POST['query']);
	}
	if (isset($_POST['rp'])) {
		$rp = ($_POST['rp']);
	}
	
	$sort = "$sortname $sortorder";
	$pageStart = ($page - 1) * $rp;
	$limit = "$pageStart,$rp";
	
	$fileName = "../temp/" . $uuid . ".ini";
	
	include_once '../domain/SolicMat.class.php';
	include_once '../persistence/SolicMatDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$sm = new SolicMat();
	
	$dao = new SolicMatDAO($system);
	
	// $xFile = '../temp/sql.ini';
		// ($fp = fopen($xFile, 'w')) or exit(0); 
		// fwrite($fp,$sort);
		// fclose($fp);
	
	$rs = $dao->listAllSMsAfter('2012-01-01', $qtype, $query, $sort, $limit);
	
	
	$i = 0;
	$list = array();
	$data = array();
	$data['rows'] = array();
	
		
	
	
	if($rs) {
	
		
		
		foreach($rs as $sm_id) {
			
			($fp = fopen($fileName, 'w')) or exit(json_encode($data)); 
			$res = array("[$uuid]", "position=" . ++$i, "count=" . sizeof($rs));
			$res = implode("\r\n", $res);
			fwrite($fp, $res);
			fclose($fp);
			
			$sm = $dao->findByPKFormatted($sm_id);
			
				
			$data['rows'][] = array(
				'id' => $sm->getCodigo(),
				'cell' => array(
					$sm->getCodigo(), 
					$sm->getReferencia(), 
					$sm->getData(), 
					$sm->getContrato(),
					$sm->getLocal(),
					$sm->getUsuario(),
					$sm->getAutorizada() == 1 ? 'Sim':'Não',
					$sm->getDataAtend(),
					$sm->getAutorizadoPor()
				)
			);
		
			array_push($list, $sm->getCodigo());
				 
		}
	}
	
	if($i > 0) {
	
		$total = 0;
	
		$rs = $dao->listAllSMsAfter('2012-01-01', $qtype, $query, $sort, "", $total);
		
	
	
		$data['total'] = $total;
		$data['page'] = $page;
	
	}
	
	echo json_encode($data);
	
	
?>