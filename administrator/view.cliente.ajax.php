<?php

	set_time_limit(0);
	
	session_start();

	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include_once '../domain/Cliente.class.php';
	include_once '../persistence/ClienteDAO.class.php';
	
	//Recebendo dados via POST
	
	if (isset($_POST['cliente_id'])) {
		$id = $_POST['cliente_id'];
	}
	
	$system = unserialize($_SESSION['sistema']);
	
	$dao = new ClienteDAO($system);
	$obj = new Cliente();
	
	$obj = $dao->findByPK($id);
	
	$data = array(
				'id' => $obj->getCodigo(),
				'referencia' => $obj->getReferencia(),
				'nome' => $obj->getNomerazao(),
				'cpfcnpj' => $obj->getCpfcnpj(),
				'rginsest' => $obj->getRginsest(),
				'cep' => $obj->getCep(),
				'logradouro' => $obj->getEndereco(),
				'numero' => $obj->getNumero(),
				'complemento' => $obj->getComplemento(),
				'bairro' => $obj->getBairro(),
				'cidade' => $obj->getCidade(),
				'telefone' => $obj->getTelefone(),
				'comercial' => $obj->getComercial(),
				'celular' => $obj->getCelular(),
				'email' => $obj->getEmail()
			);
			
	echo json_encode($data);
	
?>