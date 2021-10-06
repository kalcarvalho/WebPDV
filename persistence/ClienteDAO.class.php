<?php
  
	include_once '../domain/Cliente.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  ClienteDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT cli_cliente.* FROM cli_cliente WHERE cli_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$cliente = new Cliente();
					$cliente->setCodigo($row->cli_codigo);
					$cliente->setObservacao($row->cli_observacao);
					$cliente->setEmail($row->cli_email);
					$cliente->setEstado($row->cli_estado);
					$cliente->setPessoa($row->cli_pessoa);
					$cliente->setReferencia($row->cli_referencia);
					$cliente->setNomerazao($row->cli_nomerazao);
					$cliente->setAbreviado($row->cli_abreviado);
					$cliente->setCpfcnpj($row->cli_cpfcnpj);
					$cliente->setRginsest($row->cli_rginsest);
					$cliente->setInsmunic($row->cli_insmunic);
					$cliente->setEndereco($row->cli_endereco);
					$cliente->setBairro($row->cli_bairro);
					$cliente->setCidade($row->cli_cidade);
					$cliente->setCep($row->cli_cep);
					$cliente->setTelefone($row->cli_telefone);
					$cliente->setFax($row->cli_fax);
					$cliente->setHomepage($row->cli_homepage);
					$cliente->setRamo($row->cli_ramo);
					$cliente->setDatacadastro($row->cli_datacadastro);
					$cliente->setAtivo($row->cli_ativo);
					$cliente->setEmpresa($row->cli_empresa);
					$cliente->setCritico($row->cli_critico);
					$cliente->setContato($row->cli_contato);
					$cliente->setNumero($row->cli_numero);
					$cliente->setComplemento($row->cli_complemento);
					$cliente->setComercial($row->cli_comercial);
					$cliente->setCelular($row->cli_celular);
					
					 
					return $cliente;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
  
		public function listAll() {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT cli_cliente.* FROM cli_cliente");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$cliente = new Cliente();
						$cliente->setCodigo($row->cli_codigo);
						$cliente->setObservacao($row->cli_observacao);
						$cliente->setEmail($row->cli_email);
						$cliente->setEstado($row->cli_estado);
						$cliente->setPessoa($row->cli_pessoa);
						$cliente->setReferencia($row->cli_referencia);
						$cliente->setNomerazao($row->cli_nomerazao);
						$cliente->setAbreviado($row->cli_abreviado);
						$cliente->setCpfcnpj($row->cli_cpfcnpj);
						$cliente->setRginsest($row->cli_rginsest);
						$cliente->setInsmunic($row->cli_insmunic);
						$cliente->setEndereco($row->cli_endereco);
						$cliente->setBairro($row->cli_bairro);
						$cliente->setCidade($row->cli_cidade);
						$cliente->setCep($row->cli_cep);
						$cliente->setTelefone($row->cli_telefone);
						$cliente->setFax($row->cli_fax);
						$cliente->setHomepage($row->cli_homepage);
						$cliente->setRamo($row->cli_ramo);
						$cliente->setDatacadastro($row->cli_datacadastro);
						$cliente->setAtivo($row->cli_ativo);
						$cliente->setEmpresa($row->cli_empresa);
						$cliente->setCritico($row->cli_critico);
						$cliente->setContato($row->cli_contato);
						array_push($list, $cliente);
					}
					 
					return $list;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
  
		public function listAllAjaxSearch($qtype, $query, $sort, $limit, &$total=NULL) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$sql = "SELECT cli_cliente.* FROM cli_cliente ";
				 
				if( $qtype == '' || $query == '' ) {
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : ""); 
				} else {
					$sql .= "WHERE $qtype=$query "; 
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
				} 
				 
				$rs = $stmt->prepare($sql); 
				
				$sql = "SELECT * FROM cli_cliente";
				 
				$rs->execute();
				
				 
				if(isset($total)) {
					$total = $rs->rowCount();
					return NULL;
				}
				
				// $xFile = '../temp/sql.ini';
				// ($fp = fopen($xFile, 'w')) or exit(0); 
				// fwrite($fp,$sql."\r\n");
				// fwrite($fp,'pesquisa.cliente.ajax.php?page='.$page.'&sortname='.$sortname.'&sortorder='.$sortorder.'&qtype='.$qtype.'&query='.$query.'&rp='.$rp."\r\n"); 
				// fclose($fp);
	 
				
				
				
				if($rs->rowCount() > 0) {
				
					
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$cliente = new Cliente();
						$cliente->setCodigo($row->cli_codigo);
						$cliente->setObservacao($row->cli_observacao);
						$cliente->setEmail($row->cli_email);
						$cliente->setEstado($row->cli_estado);
						$cliente->setPessoa($row->cli_pessoa);
						$cliente->setReferencia($row->cli_referencia);
						$cliente->setNomerazao($row->cli_nomerazao);
						$cliente->setAbreviado($row->cli_abreviado);
						$cliente->setCpfcnpj($row->cli_cpfcnpj);
						$cliente->setRginsest($row->cli_rginsest);
						$cliente->setInsmunic($row->cli_insmunic);
						$cliente->setEndereco($row->cli_endereco);
						$cliente->setBairro($row->cli_bairro);
						$cliente->setCidade($row->cli_cidade);
						$cliente->setCep($row->cli_cep);
						$cliente->setTelefone($row->cli_telefone);
						$cliente->setFax($row->cli_fax);
						$cliente->setHomepage($row->cli_homepage);
						$cliente->setRamo($row->cli_ramo);
						$cliente->setDatacadastro($row->cli_datacadastro);
						$cliente->setAtivo($row->cli_ativo);
						$cliente->setEmpresa($row->cli_empresa);
						$cliente->setCritico($row->cli_critico);
						$cliente->setContato($row->cli_contato);
						array_push($list, $cliente->getCodigo());
					}
					 
					return $list;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
		
		public function update($cliente) {
		
			try {
		
				$stmt = $this->openConnection();
				
				$rs = $stmt->prepare('UPDATE cli_cliente SET cli_estado = ?, cli_pessoa = ?,
					cli_nomerazao = ?, cli_cpfcnpj = ?, cli_rginsest = ?, cli_endereco = ?, 
					cli_numero = ?, cli_complemento = ?, cli_bairro = ?, cli_cidade = ?, 
					cli_cep = ?, cli_telefone = ?, cli_comercial = ?, cli_celular = ?, 
					cli_email = ?, cli_empresa = ? 
					WHERE cli_codigo = ?');
					
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$cliente->getEstado(), PDO::PARAM_INT);
				$rs->bindParam(2,$cliente->getPessoa(), PDO::PARAM_INT);
				$rs->bindParam(3,$cliente->getNomerazao(), PDO::PARAM_STR);
				$rs->bindParam(4,$cliente->getCpfcnpj(), PDO::PARAM_STR);
				$rs->bindParam(5,$cliente->getRginsest(), PDO::PARAM_STR);
				$rs->bindParam(6,$cliente->getEndereco(), PDO::PARAM_STR);
				$rs->bindParam(7,$cliente->getNumero(), PDO::PARAM_STR);
				$rs->bindParam(8,$cliente->getComplemento(), PDO::PARAM_STR);
				$rs->bindParam(9,$cliente->getBairro(), PDO::PARAM_STR);
				$rs->bindParam(10,$cliente->getCidade(), PDO::PARAM_STR);
				$rs->bindParam(11,$cliente->getCep(), PDO::PARAM_STR);
				$rs->bindParam(12,$cliente->getTelefone(), PDO::PARAM_STR);
				$rs->bindParam(13,$cliente->getComercial(), PDO::PARAM_STR);
				$rs->bindParam(14,$cliente->getCelular(), PDO::PARAM_STR);
				$rs->bindParam(15,$cliente->getEmail(), PDO::PARAM_STR);
				$rs->bindParam(16,$cliente->getEmpresa(), PDO::PARAM_INT);
				$rs->bindParam(17,$cliente->getCodigo(), PDO::PARAM_INT);
				
				$rs->execute();
				
				// $xFile = '../temp/post.ini';
				// ($fp = fopen($xFile, 'w')) or exit(0); 
				// fwrite($fp, 'cont='.$rs->rowCount());
				// fclose($fp);
				
				if($rs->rowCount() > 0){
					$stmt->commit();
					return true;
					
				}else{
					$stmt->rollBack();
					return false;
				}

			}catch(Exception $e){
				$msg = $e->getMessage();
				exit();
			}
		}
		
		
		public function insert($cliente) {
		
			try {
		
				$stmt = $this->openConnection();
				
				// $xFile = '../temp/sql.ini';
				// ($fp = fopen($xFile, 'w')) or exit(0); 
				// fwrite($fp, $cliente->getEstado());
				// fclose($fp);

				$rs = $stmt->prepare('INSERT INTO cli_cliente (cli_estado, cli_pessoa, cli_nomerazao, cli_cpfcnpj,
											cli_rginsest, cli_endereco, cli_numero, cli_complemento, cli_bairro, 
											cli_cidade, cli_cep, cli_telefone, cli_comercial, cli_celular, cli_email, cli_empresa)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$cliente->getEstado(), PDO::PARAM_INT);
				$rs->bindParam(2,$cliente->getPessoa(), PDO::PARAM_INT);
				$rs->bindParam(3,$cliente->getNomerazao(), PDO::PARAM_STR);
				$rs->bindParam(4,$cliente->getCpfcnpj(), PDO::PARAM_STR);
				$rs->bindParam(5,$cliente->getRginsest(), PDO::PARAM_STR);
				$rs->bindParam(6,$cliente->getEndereco(), PDO::PARAM_STR);
				$rs->bindParam(7,$cliente->getNumero(), PDO::PARAM_STR);
				$rs->bindParam(8,$cliente->getComplemento(), PDO::PARAM_STR);
				$rs->bindParam(9,$cliente->getBairro(), PDO::PARAM_STR);
				$rs->bindParam(10,$cliente->getCidade(), PDO::PARAM_STR);
				$rs->bindParam(11,$cliente->getCep(), PDO::PARAM_STR);
				$rs->bindParam(12,$cliente->getTelefone(), PDO::PARAM_STR);
				$rs->bindParam(13,$cliente->getComercial(), PDO::PARAM_STR);
				$rs->bindParam(14,$cliente->getCelular(), PDO::PARAM_STR);
				$rs->bindParam(15,$cliente->getEmail(), PDO::PARAM_STR);
				$rs->bindParam(16,$cliente->getEmpresa(), PDO::PARAM_INT);
				
				$rs->execute();
				
				if($rs->rowCount() > 0){
					$pk = $stmt->lastInsertId();
					$stmt->commit();
					
					return $this->updateReferencia($pk,'CLI',5);
					
				}else{
					$stmt->rollBack();
					return false;
				}

			}catch(Exception $e){
				$msg = $e->getMessage();
				exit();
			}
		}
		
		public function updateReferencia($pk, $abr, $lim) {
			$referencia = '';
			try{
		
				$stmt = $this->openConnection();

				$rs = $stmt->prepare('UPDATE cli_cliente SET cli_referencia = ? WHERE cli_codigo = ? ');
				
				$stmt->beginTransaction();
				
				$referencia = $abr . str_pad($pk, $lim, '0', STR_PAD_LEFT);
				
				$rs->bindParam(1,$referencia, PDO::PARAM_STR);
				$rs->bindParam(2,$pk, PDO::PARAM_STR);
				
				$rs->execute();
				if($rs->rowCount() > 0){
					$stmt->commit();
					return true;
				}else{
					$stmt->rollBack();
					return false;
				}

			}catch(Exception $e){
				echo $e->getMessage();
				exit();
			}
		}
		
		public function delete($pk) {
			
			try{
		
				$stmt = $this->openConnection();

				$rs = $stmt->prepare('DELETE FROM cli_cliente WHERE cli_codigo = ? ');
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$pk, PDO::PARAM_INT);
				
				$rs->execute();
				if($rs->rowCount() > 0){
					$stmt->commit();
					return true;
				}else{
					$stmt->rollBack();
					return false;
				}

			}catch(Exception $e){
				echo $e->getMessage();
				exit();
			}
		}
		
		
  
  
	}
?>
