<?php
  
	set_time_limit(0);
	session_start();
	
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	$uuid = $_REQUEST['uuid'];
	$page = 1;
	$sortname = 'cli_codigo';
	$qtype='';
	$query='';
	$rp = 15;
	
	
	 
	if (isset($_POST['page'])) $page = ($_POST['page']);
	if (isset($_POST['sortname'])) $sortname = ($_POST['sortname']);
	if (isset($_POST['sortorder'])) $sortorder = ($_POST['sortorder']);
	if (isset($_POST['qtype'])) $qtype = ($_POST['qtype']);
	if (isset($_POST['query'])) $query = ($_POST['query']);
	if (isset($_POST['rp'])) $rp = ($_POST['rp']);
	
	// $xFile = '../temp/sql.ini';
		// ($fp = fopen($xFile, 'w')) or exit(0); 
		// fwrite($fp,'pesquisa.cliente.ajax.php?page='.$page.'&sortname='.$sortname.'&sortorder='.$sortorder.'&qtype='.$qtype.'&query='.$query.'&rp='.$rp);
		// fclose($fp);
	 
	$sort = "$sortname $sortorder";
	$pageStart = ($page - 1) * $rp;
	$limit = "$pageStart,$rp";
	$fileName = "../temp/" . $uuid . ".ini";
	 
	include_once '../domain/Cliente.class.php';
	include_once '../persistence/ClienteDAO.class.php';
	 
	$system = unserialize($_SESSION['sistema']);
	 
	$cliente = new Cliente();
	$dao = new ClienteDAO($system);
	 
	$rs = $dao->listAllAjaxSearch($qtype, $query, $sort, $limit);
	
	
	 
	$i = 0;
	$list = array();
	$data = array();
	$data['row'] = array();
	 
	if($rs) {
		 
		foreach($rs as $id) {
		
		
			 
			($fp = fopen($fileName, 'w')) or exit(json_encode($data)); 
			$res = array("[$uuid]", "position=" . ++$i, "count=" . sizeof($rs));
			$res = implode("\r\n", $res);
			fwrite($fp, $res);
			fclose($fp);
			 
			$obj = $dao->findByPK($id);
			 
			$data['rows'][] = array(
				'id' => $obj->getCodigo(),
				'cell' => array(
					$obj->getCodigo(),
					$obj->getReferencia(),
					$obj->getNomerazao(),
					$obj->getCpfcnpj(),
					$obj->getCidade(),
					$obj->getTelefone()
				)
			);
			 
			array_push($list, $obj->getCodigo());
			 
		}
		 
	}
	 
	if($i > 0) {
	
		
		 
		$total = 0;
		$rs = $dao->listAllAjaxSearch($qtype, $query, $sort, "", $total);
		 
		$data['total'] = $total;
		$data['page'] = $page;
		 
	}
	 
	 
	echo json_encode($data);
	 
?>
