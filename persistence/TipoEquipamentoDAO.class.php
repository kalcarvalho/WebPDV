<?php

include_once '../domain/TipoEquipamento.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class TipoEquipamentoDAO extends DAO implements IDatabaseFinder {

    public function  findByPK($pk) {

    }

    public function  listAll() {
        try {

            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT tip_tipoequipamento.*
                                 FROM tip_tipoequipamento
                                 ");

            $rs->execute();

            if ($rs->rowCount() > 0) {

                $list = array();

                while ($row = $rs->fetch(PDO::FETCH_OBJ)) {

                    $tipo = new TipoEquipamento();
                    $tipo->setCodigo($row->tip_codigo);
                    $tipo->setDescricao($row->tip_descricao);

                    array_push($list, $tipo);
                }

                return $list;
            }
        } catch (Exception $e) {
            echo "error";
            echo $e->getMessage();
            exit();
        }
    }

}
?>
