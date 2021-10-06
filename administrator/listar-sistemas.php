<?php
	
	include_once '../domain/Sistema.class.php';
	include_once '../persistence/SistemaDAO.class.php';

	$si = new Sistema();
	$sd = new SistemaDAO();
	
	$rs = $sd->listAll();
	
	$html = '';
	$i=0;
	
	if ($rs) {
		foreach($rs as $si) {
			if($si->getAtivo() == 1) {
				$html .= '<option value="'.$si->getCodigo().'">'.$si->getDescricao().'</option>';
			}
		}
	}
	
	echo $html;

?>