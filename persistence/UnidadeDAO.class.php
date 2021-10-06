<?php
  
	include_once '../domain/Unidade.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  UnidadeDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT uni_unidade.* FROM uni_unidade WHERE uni_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$unidade = new Unidade();
					$unidade->setCodigo($row->uni_codigo);
					$unidade->setReferencia($row->uni_referencia);
					$unidade->setDescricao($row->uni_descricao);
					$unidade->setAbreviacao($row->uni_abreviacao);
					$unidade->setEmpresa($row->uni_empresa);
					 
					return $unidade;
					 
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
				 
				$rs = $stmt->prepare("SELECT uni_unidade.* FROM uni_unidade");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$unidade = new Unidade();
						$unidade->setCodigo($row->uni_codigo);
						$unidade->setReferencia($row->uni_referencia);
						$unidade->setDescricao($row->uni_descricao);
						$unidade->setAbreviacao($row->uni_abreviacao);
						$unidade->setEmpresa($row->uni_empresa);
						array_push($list, $unidade);
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
				 
				$sql = "SELECT uni_unidade.* FROM uni_unidade ";
				 
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
						 
						$unidade = new Unidade();
						$unidade->setCodigo($row->uni_codigo);
						$unidade->setReferencia($row->uni_referencia);
						$unidade->setDescricao($row->uni_descricao);
						$unidade->setAbreviacao($row->uni_abreviacao);
						$unidade->setEmpresa($row->uni_empresa);
						array_push($list, $unidade->getCodigo());
					}
					 
					return $list;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
		}
  
  
	}
?>
