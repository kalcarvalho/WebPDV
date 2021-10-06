<?php
  
	set_time_limit(0);
	session_start();
	$uuid = $_REQUEST['uuid'];
	$page = 1;
	$sortname = 'pes_codigo';
	$qtype='';
	$query='';
	$rp = 15;
	 
	if (isset($_POST['page'])) $page = ($_POST['page']);
	if (isset($_POST['sortname'])) $sortname = ($_POST['sortname']);
	if (isset($_POST['sortorder'])) $sortorder = ($_POST['sortorder']);
	if (isset($_POST['qtype'])) $qtype = ($_POST['qtype']);
	if (isset($_POST['query'])) $query = ($_POST['query']);
	if (isset($_POST['rp'])) $rp = ($_POST['rp']);
	 
	$sort = "$sortname $sortorder";
	$pageStart = ($page - 1) * $rp;
	$limit = "$pageStart,$rp";
	$fileName = "../temp/" . $uuid . ".ini";
	 
	include_once '../domain/Pessoa.class.php';
	include_once '../persistence/PessoaDAO.class.php';
	 
	$system = unserialize($_SESSION['sistema']);
	 
	$pessoa = new Pessoa();
	$dao = new PessoaDAO($system);
	 
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
					$obj->getDescricao()
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
