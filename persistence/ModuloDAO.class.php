<?php

include_once '../domain/Modulo.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class ModuloDAO extends DAO implements IDatabaseFinder {

    public function findByPK($pk) {
        try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT mod_modulo.* FROM mod_modulo WHERE mod_codigo = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_INT);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$modulo = new Modulo();
                    $modulo->setCodigo($row->mod_codigo);
                    $modulo->setReferencia($row->mod_referencia);
                    $modulo->setDescricao($row->mod_descricao);
                    $modulo->setRotulo($row->mod_rotulo);
                    $modulo->setParent($row->mod_parent);
                    $modulo->setOrdem($row->mod_ordem);
                    $modulo->setAtivo($row->mod_ativo);
					 
					return $modulo;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
    }
	public function findByReferencia($pk) {
        try {
			 
				$stmt = $this->openConnection();
				 
				$rs = $stmt->prepare("SELECT mod_modulo.* FROM mod_modulo WHERE mod_referencia = ? ");
				 
				$rs->bindParam(1,$pk,PDO::PARAM_STR);
				$rs->execute();
				if($rs->rowCount() > 0) {
					 
					$row = $rs->fetch(PDO::FETCH_OBJ);
					 
					$modulo = new Modulo();
                    $modulo->setCodigo($row->mod_codigo);
                    $modulo->setReferencia($row->mod_referencia);
                    $modulo->setDescricao($row->mod_descricao);
                    $modulo->setRotulo($row->mod_rotulo);
                    $modulo->setParent($row->mod_parent);
                    $modulo->setOrdem($row->mod_ordem);
                    $modulo->setAtivo($row->mod_ativo);
					 
					return $modulo;
					 
				}
			 
			}catch(Exception $e){
				echo "error";
				echo $e->getMessage();
				exit();
			}
    }

    public function listAllActive() {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT mod_modulo.*
                                 FROM mod_modulo
                                 WHERE mod_ativo = 1
                                 ORDER BY mod_ordem
                                 ");

            $rs->execute();

            if ($rs->rowCount() > 0) {

                $list = array();

                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {

                    $modulo = new Modulo();
                    $modulo->setCodigo($row->mod_codigo);
                    $modulo->setReferencia($row->mod_referencia);
                    $modulo->setDescricao($row->mod_descricao);
                    $modulo->setRotulo($row->mod_rotulo);
                    $modulo->setParent($row->mod_parent);
                    $modulo->setOrdem($row->mod_ordem);
                    $modulo->setAtivo($row->mod_ativo);

                    array_push($list, $modulo);
                }

                return $list;
            }
        } catch (Exception $e) {
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }

    public function listAll() {
        
    }

}

?>
