<?php

include_once '../domain/Produto.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class ProdutoDAO extends DAO implements IDatabaseFinder {


    public function findByPK($pk) {
		$produto = new Produto();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT pro_produto.*
                                 FROM pro_produto
                                 WHERE pro_codigo = ? ");
            
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
			
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$produto->setCodigo($row->pro_codigo);
				$produto->setNomeRazao($row->pro_descricao);
            }
			
			
			
            return $produto;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }

    public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT pro_produto.*
                                 FROM pro_produto 
								 ORDER BY pro_descricao limit 100
                                 ");
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$produto = new Produto();
					$produto->setCodigo($row->pro_codigo);
					$produto->setReferencia($row->pro_referencia);
					$produto->setDescricao($row->pro_descricao);
					$produto->setClasseProduto($row->pro_classeproduto);
					
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
