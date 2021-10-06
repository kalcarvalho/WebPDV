<?php

include_once '../domain/Produto.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class ClasseProdutoDAO extends DAO implements IDatabaseFinder {


    public function findByPK($pk) {
		$classe = new Produto();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT clp_classeproduto.*
                                 FROM clp_classeproduto
                                 WHERE clp_codigo = ? ");
            
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$classe->setCodigo($row->clp_codigo);
				$classe->setReferencia($row->clp_referencia);
				$classe->setDescricao($row->clp_descricao);
				
            }
			
			
			
            return $classe;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }

    public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT clp_classeproduto.*
                                 FROM clp_classeproduto 
								 ORDER BY clp_classeproduto limit 100
                                 ");
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$produto = new Produto();
					$produto->setCodigo($row->clp_codigo);
					$produto->setReferencia($row->clp_referencia);
					$produto->setDescricao($row->clp_descricao);
					
					array_push($list, $produto);
					
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
