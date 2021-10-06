<?php
  
	include_once '../domain/Precoitem.class.php';
	include_once 'DAO.class.php';
	include_once 'IDatabaseFinder.class.php';
  
	class  PrecoitemDAO  extends DAO implements IDatabaseFinder { 
  
		public function findByPK($pk) {
			try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT pri_precoitem.* FROM pri_precoitem WHERE pri_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$precoitem = new Precoitem();
					$precoitem->setCodigo($row->pri_codigo);
					$precoitem->setEspecproduto($row->pri_especproduto);
					$precoitem->setTabeladepreco($row->pri_tabeladepreco);
					$precoitem->setPreco($row->pri_preco);
					 
					return $precoitem;
					 
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
				 
				$rs = $stmt->prepare("SELECT pri_precoitem.* FROM pri_precoitem");
				 
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$list = array();
					 
					while($row = $rs->fetch(PDO::FETCH_OBJ)) {
						 
						$precoitem = new Precoitem();
						$precoitem->setCodigo($row->pri_codigo);
						$precoitem->setEspecproduto($row->pri_especproduto);
						$precoitem->setTabeladepreco($row->pri_tabeladepreco);
						$precoitem->setPreco($row->pri_preco);
						array_push($list, $precoitem);
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
				 
				$sql = "SELECT pri_precoitem.* FROM pri_precoitem ";
				 
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
						 
						$precoitem = new Precoitem();
						$precoitem->setCodigo($row->pri_codigo);
						$precoitem->setEspecproduto($row->pri_especproduto);
						$precoitem->setTabeladepreco($row->pri_tabeladepreco);
						$precoitem->setPreco($row->pri_preco);
						array_push($list, $precoitem->getCodigo());
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
