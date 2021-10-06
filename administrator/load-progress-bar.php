<?php	
	$id = $_REQUEST['id'];
	
	(isset($id)) or exit(json_encode(array()));
	
	(file_exists('../temp/' .  $id . '.ini')) or exit(json_encode(array()));
	
	$ini = parse_ini_file('../temp/' .  $id . '.ini', true);
	$json = array();
	
	$json['position'] = $ini[$id]['position'];
	$json['count'] = $ini[$id]['count'];
	
	echo json_encode($json);

?>