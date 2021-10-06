<?php
  
	include_once '../domain/Estado.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  EstadoDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT est_estado.* FROM est_estado WHERE est_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$estado = new Estado();
					$estado->setCodigo($row->est_codigo);
					$estado->setDescricao($row->est_descricao);
					$estado->setAbreviatura($row->est_abreviatura);
					$estado->setIbge($row->est_ibge);
					 
					return $estado;
					 
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
				 
				$rs = $stmt->prepare("SELECT est_estado.* FROM est_estado");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$estado = new Estado();
						$estado->setCodigo($row->est_codigo);
						$estado->setDescricao($row->est_descricao);
						$estado->setAbreviatura($row->est_abreviatura);
						$estado->setIbge($row->est_ibge);
						array_push($list, $estado);
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
				 
				$sql = "SELECT est_estado.* FROM est_estado ";
				 
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
						 
						$estado = new Estado();
						$estado->setCodigo($row->est_codigo);
						$estado->setDescricao($row->est_descricao);
						$estado->setAbreviatura($row->est_abreviatura);
						$estado->setIbge($row->est_ibge);
						array_push($list, $estado->getCodigo());
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
