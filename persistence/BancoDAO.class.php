<?php

include_once '../domain/Banco.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class BancoDAO extends DAO implements IDatabaseFinder {

    public function findByPK($pk) {

    }

    public function listAll() {
        

        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT bco_banco.*
                                 FROM bco_banco ");

            $rs->execute();
            
            if ($rs->rowCount() > 0) {

                $list = array();

                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {

                    $banco = new Banco();
                    $banco->setCodigo($row->bco_codigo);
                    $banco->setDescricao($row->bco_descricao);
                    $banco->setSaldoinic($row->bco_saldoinic);
                    $banco->setAgencia($row->bco_agencia);
                    $banco->setContacorrente($row->bco_contacorrente);
                    $banco->setLimite($row->bco_limite);
                    $banco->setAbertura($row->bco_abertura);
                    
                    array_push($list, $banco);
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

   

}

?>
