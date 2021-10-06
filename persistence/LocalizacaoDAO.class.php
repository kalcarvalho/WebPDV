<?php

include_once '../domain/Localizacao.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class LocalizacaoDAO extends DAO implements IDatabaseFinder {
	
	public function findByPK($pk) {
		
		try {
		
            $stmt = $this->openConnection();
			
			$rs = $stmt->prepare("SELECT loc_local.* 
								 FROM loc_local  
								 WHERE loc_codigo = ?
								 ");
			
            $rs->bindParam(1,$pk,PDO::PARAM_INT);
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				

				$row = $rs->fetch(PDO::FETCH_OBJ);
				
				$localizacao = new Localizacao();
				$localizacao->setCodigo($row->loc_codigo);
				$localizacao->setReferencia($row->loc_referencia);
				$localizacao->setDescricao($row->loc_descricao);
				$localizacao->setCadastro($row->loc_datacadastro);
				$localizacao->setEmpresa($row->loc_empresa);

				return $localizacao;
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
			
			
			$rs = $stmt->prepare("SELECT loc_local.* 
								 FROM loc_local  
								 ORDER BY loc_descricao 
								 ");
			
            
            $rs->execute();
            
            if($rs->rowCount() > 0){
			
				$list = array();
               
                 while($row = $rs->fetch(PDO::FETCH_OBJ)){
					
					$localizacao = new Localizacao();
					$localizacao->setCodigo($row->loc_codigo);
					$localizacao->setReferencia($row->loc_referencia);
					$localizacao->setDescricao($row->loc_descricao);
					$localizacao->setCadastro($row->loc_datacadastro);
					$localizacao->setEmpresa($row->loc_empresa);
				
					array_push($list, $localizacao);
					
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