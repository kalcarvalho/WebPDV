<?php

include_once '../domain/Pergunta.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class PerguntaDAO extends DAO implements IDatabaseFinder {

    public function findByPK($pk) {

    }

    public function findByTipoEquipamento($tp) {
        

        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT per_pergunta.*
                                 FROM per_pergunta
                                 WHERE per_tipo = ? AND per_ativo = 1 ");

            $rs->bindParam(1, $tp, PDO::PARAM_INT);
            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {

                    $pergunta = new Pergunta();
                    $pergunta->setCodigo($row->per_codigo);
                    $pergunta->setDescricao($row->per_descricao);
                    
                    array_push($list, $pergunta);
                }

                return $list;
            }

            return $pergunta;

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
