<?php
	
	set_time_limit(0);
	
	
	session_start();
	
	$uuid = $_REQUEST['uuid'];
	
	
	
	include_once '../domain/SolicMat.class.php';
	include_once '../persistence/SolicMatDAO.class.php';
	
	$system = unserialize($_SESSION['sistema']);
	
	$sm = new SolicMat();
	
	$dao = new SolicMatDAO($system);
	
	$rs = $dao->listAllowedSMsAfterYear(2012);
	
	
	if(sizeof($rs) == 0) {
		exit;
	}
	
	$fileName = "../temp/" . $uuid . ".ini";
	
	$subquery = implode(",", $rs);
	

	$rs = null;
	
	$rs = $dao->listSMsBackupContingence($subquery, 2012);
	$i = 0;
	$j = 0;
	$list = array();
	$data = array();
	$data['rows'] = array();
	
	
	if($rs) {
	
		
		
		foreach($rs as $sm) {
			
			($fp = fopen($fileName, 'w')) or die('Erro não especificado'); 
			$res = array("[$uuid]", "position=" . ++$j, "count=".sizeof($rs));
			$res = implode("\r\n", $res);
			fwrite($fp, $res);
			fclose($fp);
		
			$smx = null;
			
			if (!in_array($sm->getCodigo(), $list)) {
			
				$sm = $dao->findBackupByPKFormatted($sm->getCodigo());

				$smx = $dao->findByPK($sm->getCodigo());
				
				if($smx == null && $sm->getAutorizada() != 0) {
					
				
					++$i;
					$data['rows'][] = array(
						'id' => $sm->getCodigo(),
						'cell' => array(
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
			
		}
	}
	
	if($i > 0) {
	
		$data['total'] = $i;
		$data['page'] = 1;
	
	}
	
	echo json_encode($data);
	
	
?>