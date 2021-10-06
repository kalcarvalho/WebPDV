<?php
  
	include_once '../domain/Especproduto.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  EspecprodutoDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT esp_especproduto.* FROM esp_especproduto WHERE esp_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$especproduto = new Especproduto();
					$especproduto->setCodigo($row->esp_codigo);
					$especproduto->setReferencia($row->esp_referencia);
					$especproduto->setCodbarras($row->esp_codbarras);
					$especproduto->setDescricao($row->esp_descricao);
					$especproduto->setEmpresa($row->esp_empresa);
					$especproduto->setUnidade($row->esp_unidade);
					$especproduto->setGrupoproduto($row->esp_grupoproduto);
					$especproduto->setGrupodesc($row->esp_grupodesc);
					$especproduto->setUniddesc($row->esp_uniddesc);
					$especproduto->setEstmin($row->esp_estmin);
					$especproduto->setEstmax($row->esp_estmax);
					$especproduto->setCodfabr($row->esp_codfabr);
					$especproduto->setPeso($row->esp_peso);
					$especproduto->setBaseicms($row->esp_baseicms);
					$especproduto->setAliqipi($row->esp_aliqipi);
					$especproduto->setAliqicms($row->esp_aliqicms);
					$especproduto->setSittrib($row->esp_sittrib);
					$especproduto->setIncideipi($row->esp_incideipi);
					$especproduto->setClassfiscal($row->esp_classfiscal);
					$especproduto->setCusto($row->esp_custo);
					$especproduto->setVenda($row->esp_venda);
					$especproduto->setEstoque($row->esp_estoque);
					
					 
					return $especproduto;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
		
		public function findByReferencia($ref) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT esp_especproduto.* FROM esp_especproduto WHERE esp_referencia = ? ");
				 
				$rs->bindParam(1,$ref,PDO::PARAM_STR);
				$rs->execute();
				
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$especproduto = new Especproduto();
					$especproduto->setCodigo($row->esp_codigo);
					$especproduto->setReferencia($row->esp_referencia);
					$especproduto->setCodbarras($row->esp_codbarras);
					$especproduto->setDescricao($row->esp_descricao);
					$especproduto->setEmpresa($row->esp_empresa);
					$especproduto->setUnidade($row->esp_unidade);
					$especproduto->setGrupoproduto($row->esp_grupoproduto);
					$especproduto->setGrupodesc($row->esp_grupodesc);
					$especproduto->setUniddesc($row->esp_uniddesc);
					$especproduto->setEstmin($row->esp_estmin);
					$especproduto->setEstmax($row->esp_estmax);
					$especproduto->setCodfabr($row->esp_codfabr);
					$especproduto->setPeso($row->esp_peso);
					$especproduto->setBaseicms($row->esp_baseicms);
					$especproduto->setAliqipi($row->esp_aliqipi);
					$especproduto->setAliqicms($row->esp_aliqicms);
					$especproduto->setSittrib($row->esp_sittrib);
					$especproduto->setIncideipi($row->esp_incideipi);
					$especproduto->setClassfiscal($row->esp_classfiscal);
					 
					return $especproduto;
					 
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
				 
				$rs = $stmt->prepare("SELECT esp_especproduto.* FROM esp_especproduto");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$especproduto = new Especproduto();
						$especproduto->setCodigo($row->esp_codigo);
						$especproduto->setReferencia($row->esp_referencia);
						$especproduto->setCodbarras($row->esp_codbarras);
						$especproduto->setDescricao($row->esp_descricao);
						$especproduto->setEmpresa($row->esp_empresa);
						$especproduto->setUnidade($row->esp_unidade);
						$especproduto->setGrupoproduto($row->esp_grupoproduto);
						$especproduto->setGrupodesc($row->esp_grupodesc);
						$especproduto->setUniddesc($row->esp_uniddesc);
						$especproduto->setEstmin($row->esp_estmin);
						$especproduto->setEstmax($row->esp_estmax);
						$especproduto->setCodfabr($row->esp_codfabr);
						$especproduto->setPeso($row->esp_peso);
						$especproduto->setBaseicms($row->esp_baseicms);
						$especproduto->setAliqipi($row->esp_aliqipi);
						$especproduto->setAliqicms($row->esp_aliqicms);
						$especproduto->setSittrib($row->esp_sittrib);
						$especproduto->setIncideipi($row->esp_incideipi);
						$especproduto->setClassfiscal($row->esp_classfiscal);
						array_push($list, $especproduto);
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
				 
				$sql = "SELECT esp_especproduto.* FROM esp_especproduto ";
				 
				if( $qtype == '' || $query == '' ) {
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : ""); 
				} else {
					$sql .= "WHERE $qtype=$query "; 
					$sql .= "ORDER BY $sort " . (strlen($limit) > 0 ? "limit $limit" : "");
				} 
				 
				$rs = $stmt->prepare($sql); 
				 
				$rs->execute();
				 
				if(isset($total)) {
					$total = $rs->rowCount();
					return NULL;
				}
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$especproduto = new Especproduto();
						$especproduto->setCodigo($row->esp_codigo);
						$especproduto->setReferencia($row->esp_referencia);
						$especproduto->setCodbarras($row->esp_codbarras);
						$especproduto->setDescricao($row->esp_descricao);
						$especproduto->setEmpresa($row->esp_empresa);
						$especproduto->setUnidade($row->esp_unidade);
						$especproduto->setGrupoproduto($row->esp_grupoproduto);
						$especproduto->setGrupodesc($row->esp_grupodesc);
						$especproduto->setUniddesc($row->esp_uniddesc);
						$especproduto->setEstmin($row->esp_estmin);
						$especproduto->setEstmax($row->esp_estmax);
						$especproduto->setCodfabr($row->esp_codfabr);
						$especproduto->setPeso($row->esp_peso);
						$especproduto->setBaseicms($row->esp_baseicms);
						$especproduto->setAliqipi($row->esp_aliqipi);
						$especproduto->setAliqicms($row->esp_aliqicms);
						$especproduto->setSittrib($row->esp_sittrib);
						$especproduto->setIncideipi($row->esp_incideipi);
						$especproduto->setClassfiscal($row->esp_classfiscal);
						array_push($list, $especproduto->getCodigo());
					}
					 
					return $list;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
		
		public function delete($pk) {
			
			try {
		
				$stmt = $this->openConnection();

				$rs = $stmt->prepare('DELETE FROM esp_especproduto WHERE esp_codigo = ? ');
				
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
		
		
		public function insert($produto) {
		
			try {
		
				$stmt = $this->openConnection();
				
				$xFile = '../temp/sql.ini';
				($fp = fopen($xFile, 'w')) or exit(0); 
				fwrite($fp, $produto->getUnidade());
				fclose($fp);

				$rs = $stmt->prepare('INSERT INTO esp_especproduto (esp_empresa, esp_unidade, esp_grupoproduto,  esp_codbarras, esp_descricao)VALUES(?, ?, ?, ?, ?)');
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$produto->getEmpresa(), PDO::PARAM_INT);
				$rs->bindParam(2,$produto->getUnidade(), PDO::PARAM_INT);
				$rs->bindParam(3,$produto->getGrupoproduto(), PDO::PARAM_INT);
				$rs->bindParam(4,$produto->getCodbarras(), PDO::PARAM_STR);
				$rs->bindParam(5,$produto->getDescricao(), PDO::PARAM_STR);
				
				$rs->execute();
				
				if($rs->rowCount() > 0){
					$pk = $stmt->lastInsertId();
					$stmt->commit();
					
					return $this->updateReferencia($pk,'',7);
					
				}else{
					$stmt->rollBack();
					return false;
				}

			}catch(Exception $e){
				// $msg = $e->getMessage();
				var_dump($msg);
				exit();
			}
		}
		
		
		public function updateReferencia($pk, $abr, $lim) {
			$referencia = '';
			try{
		
				$stmt = $this->openConnection();

				$rs = $stmt->prepare('UPDATE esp_especproduto SET esp_referencia = ? WHERE esp_codigo = ? ');
				
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
		
		public function update($produto) {
		
			try {
		
				$stmt = $this->openConnection();
				
				$rs = $stmt->prepare('UPDATE esp_especproduto 
					SET esp_descricao = ?, esp_codbarras = ?, esp_custo = ?,
					esp_venda = ? 
					WHERE esp_codigo = ?');
					
				
				$stmt->beginTransaction();
				
				$rs->bindParam(1,$produto->getDescricao(), PDO::PARAM_STR);
				$rs->bindParam(2,$produto->getCodbarras(), PDO::PARAM_STR);
				$rs->bindParam(3,$produto->getCusto(), PDO::PARAM_STR);
				$rs->bindParam(4,$produto->getVenda(), PDO::PARAM_STR);
				$rs->bindParam(5,$produto->getCodigo(), PDO::PARAM_INT);
				
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
		
		
  
	}
?>
