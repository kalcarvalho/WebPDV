<?php
  
	include_once '../domain/Pessoa.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  PessoaDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT pes_pessoa.* FROM pes_pessoa WHERE pes_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$pessoa = new Pessoa();
					$pessoa->setCodigo($row->pes_codigo);
					$pessoa->setDescricao($row->pes_descricao);
					 
					return $pessoa;
					 
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
				 
				$rs = $stmt->prepare("SELECT pes_pessoa.* FROM pes_pessoa");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$pessoa = new Pessoa();
						$pessoa->setCodigo($row->pes_codigo);
						$pessoa->setDescricao($row->pes_descricao);
						array_push($list, $pessoa);
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
				 
				$sql = "SELECT pes_pessoa.* FROM pes_pessoa ";
				 
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
						 
						$pessoa = new Pessoa();
						$pessoa->setCodigo($row->pes_codigo);
						$pessoa->setDescricao($row->pes_descricao);
						array_push($list, $pessoa->getCodigo());
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
