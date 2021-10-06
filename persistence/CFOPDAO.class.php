<?php

include_once '../domain/CFOP.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class CFOPDAO extends DAO implements IDatabaseFinder {

	public function findByPK($pk) {
		try {
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare("SELECT cfo_cfop.* 
								 FROM cfo_cfop  
								 WHERE cfo_codigo = ?
								 ");
			
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$row = $rs->fetch(PDO::FETCH_OBJ);

				$sm = new CFOP();
				$cfop->setCodigo($row->cfo_codigo);
				$cfop->setReferencia($row->cfo_referencia);
				$cfop->setDescricao($row->cfo_descricao);
				$cfop->setEmpresa($row->cfo_empresa);

				return $cfop;
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
			
			$rs = $stmt->prepare("SELECT cfo_cfop.* 
								 FROM cfo_cfop  
								 WHERE cfo_referencia = ?
								 ");
			
            $rs->bindParam(1,$ref,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$row = $rs->fetch(PDO::FETCH_OBJ);

				$cfop = new CFOP();
				$cfop->setCodigo($row->cfo_codigo);
				$cfop->setReferencia($row->cfo_referencia);
				$cfop->setDescricao($row->cfo_descricao);
				$cfop->setEmpresa($row->cfo_empresa);

				return $cfop;
            }

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }
	
	public function listAll() { }
	
	


}


?>