<?php
  
	include_once '../domain/Fornecedor.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  FornecedorDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT for_fornecedor.* FROM for_fornecedor WHERE for_codigo = ? ");
				
				
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$fornecedor = new Fornecedor();
					$fornecedor->setCodigo($row->for_codigo);
					$fornecedor->setEstado($row->for_estado);
					$fornecedor->setPessoa($row->for_pessoa);
					$fornecedor->setReferencia($row->for_referencia);
					$fornecedor->setNomerazao($row->for_nomerazao);
					$fornecedor->setAbreviado($row->for_abreviado);
					$fornecedor->setCpfcnpj($row->for_cpfcnpj);
					$fornecedor->setRginsest($row->for_rginsest);
					$fornecedor->setInsmunic($row->for_insmunic);
					$fornecedor->setEndereco($row->for_endereco);
					$fornecedor->setBairro($row->for_bairro);
					$fornecedor->setCidade($row->for_cidade);
					$fornecedor->setCep($row->for_cep);
					$fornecedor->setTelefone($row->for_telefone);
					$fornecedor->setFax($row->for_fax);
					$fornecedor->setHomepage($row->for_homepage);
					$fornecedor->setEmail($row->for_email);
					$fornecedor->setRamo($row->for_ramo);
					$fornecedor->setDatacadastro($row->for_datacadastro);
					$fornecedor->setObservacao($row->for_observacao);
					$fornecedor->setAtivo($row->for_ativo);
					$fornecedor->setContato($row->for_contato);
					$fornecedor->setCritico($row->for_critico);
					$fornecedor->setEmpresa($row->for_empresa);
					$fornecedor->setNumero($row->for_numero);
					$fornecedor->setComplemento($row->for_complemento);
					$fornecedor->setComercial($row->for_comercial);
					$fornecedor->setCelular($row->for_celular);
					 
					return $fornecedor;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
  
		public function findByPK_Formatted($pk) {
			try {
			 
				$stmt = $this->openConnection();
				
				$sql = "SELECT for_fornecedor.*, est_abreviatura 
					FROM for_fornecedor 
					LEFT OUTER JOIN est_estado ON est_codigo = for_estado
					WHERE for_codigo = ? ";
				
				
				 
				$rs = $stmt->prepare($sql);
				
				
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$fornecedor = new Fornecedor();
					$fornecedor->setCodigo($row->for_codigo);
					$fornecedor->setEstado($row->est_abreviatura);
					$fornecedor->setPessoa($row->for_pessoa);
					$fornecedor->setReferencia($row->for_referencia);
					$fornecedor->setNomerazao($row->for_nomerazao);
					$fornecedor->setAbreviado($row->for_abreviado);
					$fornecedor->setCpfcnpj($row->for_cpfcnpj);
					$fornecedor->setRginsest($row->for_rginsest);
					$fornecedor->setInsmunic($row->for_insmunic);
					$fornecedor->setEndereco($row->for_endereco);
					$fornecedor->setBairro($row->for_bairro);
					$fornecedor->setCidade($row->for_cidade);
					$fornecedor->setCep($row->for_cep);
					$fornecedor->setTelefone($row->for_telefone);
					$fornecedor->setFax($row->for_fax);
					$fornecedor->setHomepage($row->for_homepage);
					$fornecedor->setEmail($row->for_email);
					$fornecedor->setRamo($row->for_ramo);
					$fornecedor->setDatacadastro($row->for_datacadastro);
					$fornecedor->setObservacao($row->for_observacao);
					$fornecedor->setAtivo($row->for_ativo);
					$fornecedor->setContato($row->for_contato);
					$fornecedor->setCritico($row->for_critico);
					$fornecedor->setEmpresa($row->for_empresa);
					 
					return $fornecedor;
					 
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
				 
				$rs = $stmt->prepare("SELECT for_fornecedor.* FROM for_fornecedor");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$fornecedor = new Fornecedor();
						$fornecedor->setCodigo($row->for_codigo);
						$fornecedor->setEstado($row->for_estado);
						$fornecedor->setPessoa($row->for_pessoa);
						$fornecedor->setReferencia($row->for_referencia);
						$fornecedor->setNomerazao($row->for_nomerazao);
						$fornecedor->setAbreviado($row->for_abreviado);
						$fornecedor->setCpfcnpj($row->for_cpfcnpj);
						$fornecedor->setRginsest($row->for_rginsest);
						$fornecedor->setInsmunic($row->for_insmunic);
						$fornecedor->setEndereco($row->for_endereco);
						$fornecedor->setBairro($row->for_bairro);
						$fornecedor->setCidade($row->for_cidade);
						$fornecedor->setCep($row->for_cep);
						$fornecedor->setTelefone($row->for_telefone);
						$fornecedor->setFax($row->for_fax);
						$fornecedor->setHomepage($row->for_homepage);
						$fornecedor->setEmail($row->for_email);
						$fornecedor->setRamo($row->for_ramo);
						$fornecedor->setDatacadastro($row->for_datacadastro);
						$fornecedor->setObservacao($row->for_observacao);
						$fornecedor->setAtivo($row->for_ativo);
						$fornecedor->setContato($row->for_contato);
						$fornecedor->setCritico($row->for_critico);
						$fornecedor->setEmpresa($row->for_empresa);
						array_push($list, $fornecedor);
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
			
			$is_number = false;
			$where = "";
			
			if(is_numeric($query)) {
				$where = "$qtype = $query";
			} else {
				$where = "UPPER($qtype) LIKE UPPER('%$query%')";
			}
			
			try {
			 
				$stmt = $this->openConnection();
				 
				$sql = "SELECT for_fornecedor.* FROM for_fornecedor ";
				 
				if( $qtype == '' || $query == '' ) {
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : ""); 
				} else {
					$sql .= "WHERE $where "; 
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
				} 
				 
				$rs = $stmt->prepare($sql); 
				
				// $xFile = '../temp/sql.ini';
				// ($fp = fopen($xFile, 'w')) or exit(0); 
				// fwrite($fp,$sql."\r\n");
				// fclose($fp);
				 
				 
				$rs->execute();
				 
				if(isset($total)) {
					$total = $rs->rowCount();
					return NULL;
				}
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$fornecedor = new Fornecedor();
						$fornecedor->setCodigo($row->for_codigo);
						$fornecedor->setEstado($row->for_estado);
						$fornecedor->setPessoa($row->for_pessoa);
						$fornecedor->setReferencia($row->for_referencia);
						$fornecedor->setNomerazao($row->for_nomerazao);
						$fornecedor->setAbreviado($row->for_abreviado);
						$fornecedor->setCpfcnpj($row->for_cpfcnpj);
						$fornecedor->setRginsest($row->for_rginsest);
						$fornecedor->setInsmunic($row->for_insmunic);
						$fornecedor->setEndereco($row->for_endereco);
						$fornecedor->setBairro($row->for_bairro);
						$fornecedor->setCidade($row->for_cidade);
						$fornecedor->setCep($row->for_cep);
						$fornecedor->setTelefone($row->for_telefone);
						$fornecedor->setFax($row->for_fax);
						$fornecedor->setHomepage($row->for_homepage);
						$fornecedor->setEmail($row->for_email);
						$fornecedor->setRamo($row->for_ramo);
						$fornecedor->setDatacadastro($row->for_datacadastro);
						$fornecedor->setObservacao($row->for_observacao);
						$fornecedor->setAtivo($row->for_ativo);
						$fornecedor->setContato($row->for_contato);
						$fornecedor->setCritico($row->for_critico);
						$fornecedor->setEmpresa($row->for_empresa);
						array_push($list, $fornecedor->getCodigo());
					}
					 
					return $list;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
		
		
		public function update($fornecedor) {
		
			try {
		
				$stmt = $this->openConnection();
				
				$rs = $stmt->prepare('UPDATE for_fornecedor SET for_estado = ?, for_pessoa = ?,
					for_nomerazao = ?, for_cpfcnpj = ?, for_rginsest = ?, for_endereco = ?, 
					for_numero = ?, for_complemento = ?, for_bairro = ?, for_cidade = ?, 
					for_cep = ?, for_telefone = ?, for_comercial = ?, for_celular = ?, 
					for_email = ?, for_empresa = ? 
					WHERE for_codigo = ?');
					
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$fornecedor->getEstado(), PDO::PARAM_INT);
				$rs->bindParam(2,$fornecedor->getPessoa(), PDO::PARAM_INT);
				$rs->bindParam(3,$fornecedor->getNomerazao(), PDO::PARAM_STR);
				$rs->bindParam(4,$fornecedor->getCpfcnpj(), PDO::PARAM_STR);
				$rs->bindParam(5,$fornecedor->getRginsest(), PDO::PARAM_STR);
				$rs->bindParam(6,$fornecedor->getEndereco(), PDO::PARAM_STR);
				$rs->bindParam(7,$fornecedor->getNumero(), PDO::PARAM_STR);
				$rs->bindParam(8,$fornecedor->getComplemento(), PDO::PARAM_STR);
				$rs->bindParam(9,$fornecedor->getBairro(), PDO::PARAM_STR);
				$rs->bindParam(10,$fornecedor->getCidade(), PDO::PARAM_STR);
				$rs->bindParam(11,$fornecedor->getCep(), PDO::PARAM_STR);
				$rs->bindParam(12,$fornecedor->getTelefone(), PDO::PARAM_STR);
				$rs->bindParam(13,$fornecedor->getComercial(), PDO::PARAM_STR);
				$rs->bindParam(14,$fornecedor->getCelular(), PDO::PARAM_STR);
				$rs->bindParam(15,$fornecedor->getEmail(), PDO::PARAM_STR);
				$rs->bindParam(16,$fornecedor->getEmpresa(), PDO::PARAM_INT);
				$rs->bindParam(17,$fornecedor->getCodigo(), PDO::PARAM_INT);
				
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
		
		
		public function insert($fornecedor) {
		
			try {
		
				$stmt = $this->openConnection();
				
				$xFile = '../temp/sql.ini';
				($fp = fopen($xFile, 'w')) or exit(0); 
				fwrite($fp, $fornecedor->getEstado());
				fclose($fp);

				$rs = $stmt->prepare('INSERT INTO for_fornecedor (for_estado, for_pessoa, 
										for_nomerazao, for_cpfcnpj, for_rginsest, for_endereco, 
										for_numero, for_complemento, for_bairro, for_cidade, 
										for_cep, for_telefone, for_comercial, for_celular, 
										for_email, for_empresa, for_datacadastro)
									VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$fornecedor->getEstado(), PDO::PARAM_INT);
				$rs->bindParam(2,$fornecedor->getPessoa(), PDO::PARAM_INT);
				$rs->bindParam(3,$fornecedor->getNomerazao(), PDO::PARAM_STR);
				$rs->bindParam(4,$fornecedor->getCpfcnpj(), PDO::PARAM_STR);
				$rs->bindParam(5,$fornecedor->getRginsest(), PDO::PARAM_STR);
				$rs->bindParam(6,$fornecedor->getEndereco(), PDO::PARAM_STR);
				$rs->bindParam(7,$fornecedor->getNumero(), PDO::PARAM_STR);
				$rs->bindParam(8,$fornecedor->getComplemento(), PDO::PARAM_STR);
				$rs->bindParam(9,$fornecedor->getBairro(), PDO::PARAM_STR);
				$rs->bindParam(10,$fornecedor->getCidade(), PDO::PARAM_STR);
				$rs->bindParam(11,$fornecedor->getCep(), PDO::PARAM_STR);
				$rs->bindParam(12,$fornecedor->getTelefone(), PDO::PARAM_STR);
				$rs->bindParam(13,$fornecedor->getComercial(), PDO::PARAM_STR);
				$rs->bindParam(14,$fornecedor->getCelular(), PDO::PARAM_STR);
				$rs->bindParam(15,$fornecedor->getEmail(), PDO::PARAM_STR);
				$rs->bindParam(16,$fornecedor->getEmpresa(), PDO::PARAM_INT);
				
				$rs->execute();
				
				if($rs->rowCount() > 0){
					$pk = $stmt->lastInsertId();
					$stmt->commit();
					
					return $this->updateReferencia($pk,'FOR',5);
					
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

				$rs = $stmt->prepare('UPDATE for_fornecedor SET for_referencia = ? WHERE for_codigo = ? ');
				
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
			
			try {
		
				$stmt = $this->openConnection();

				$rs = $stmt->prepare('DELETE FROM for_fornecedor WHERE for_codigo = ? ');
				
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
