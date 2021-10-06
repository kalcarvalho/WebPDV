<?php

include_once APP_PATH_DOMAIN . '/Sistema.class.php';
include_once 'DAOMaster.class.php';
include_once 'IDatabaseFinder.class.php';

class SistemaDAO extends DAOMaster implements IDatabaseFinder {

	 public function   __construct() {

    }
	
	public function findByPK($pk) {
		$sistema = new Sistema();

        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT sis_sistema.*
                                 FROM sis_sistema
                                 WHERE sis_codigo = ? ");
            
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();

            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
				$sistema->setCodigo($row->sis_codigo);
				$sistema->setDescricao($row->sis_descricao);
				$sistema->setHost($row->sis_host);
				$sistema->setDBName($row->sis_dbname);
				$sistema->setUser($row->sis_user);
				$sistema->setPassword($row->sis_password);
            }
			
            return $sistema;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }
	
	
	 public function listAll() {
        try {
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT sis_sistema.*
                                 FROM sis_sistema 
								 ORDER BY sis_descricao 
                                 ");
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$sistema = new Sistema();
					$sistema->setCodigo($row->sis_codigo);
					$sistema->setDescricao($row->sis_descricao);
					$sistema->setHost($row->sis_host);
					$sistema->setDBName($row->sis_dbname);
					$sistema->setUser($row->sis_user);
					$sistema->setPassword($row->sis_password);
					$sistema->setAtivo($row->sis_ativo);
					
					array_push($list, $sistema);
					
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