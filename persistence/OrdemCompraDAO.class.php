<?php

include_once '../domain/OrdemCompra.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class OrdemCompraDAO extends DAO implements IDatabaseFinder {


    public function findByPK($pk) {

    }

    public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT oco_ordemcompra.*
                                 FROM oco_ordemcompra 
								 ORDER BY oco_referencia DESC limit 100
                                 ");
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$ordem = new OrdemCompra();
					$ordem->setCodigo($row->oco_codigo);
					$ordem->setReferencia($row->oco_referencia);
					$ordem->setFornecedor($row->oco_fornecedor);
					$ordem->setDataOC($row->oco_data);
					$ordem->setAutorizada($row->oco_autorizada);
					$ordem->setEntrega($row->oco_dataentrega);
					$ordem->setRevisada($row->oco_revisada);
					
					array_push($list, $ordem);
					
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
