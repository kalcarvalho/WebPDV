<?php
  
	include_once '../domain/Tabelapreco.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  TabelaprecoDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT tbp_tabelapreco.* FROM tbp_tabelapreco WHERE tbp_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$tabelapreco = new Tabelapreco();
					$tabelapreco->setCodigo($row->tbp_codigo);
					$tabelapreco->setDescricao($row->tbp_descricao);
					$tabelapreco->setCusto($row->tbp_custo);
					 
					return $tabelapreco;
					 
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
				 
				$rs = $stmt->prepare("SELECT tbp_tabelapreco.* FROM tbp_tabelapreco");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$tabelapreco = new Tabelapreco();
						$tabelapreco->setCodigo($row->tbp_codigo);
						$tabelapreco->setDescricao($row->tbp_descricao);
						$tabelapreco->setCusto($row->tbp_custo);
						array_push($list, $tabelapreco);
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
				 
				$sql = "SELECT tbp_tabelapreco.* FROM tbp_tabelapreco ";
				 
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
						 
						$tabelapreco = new Tabelapreco();
						$tabelapreco->setCodigo($row->tbp_codigo);
						$tabelapreco->setDescricao($row->tbp_descricao);
						$tabelapreco->setCusto($row->tbp_custo);
						array_push($list, $tabelapreco->getCodigo());
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
