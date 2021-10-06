<?php

include_once '../domain/Usuario.class.php';
include_once '../domain/Sistema.class.php';
include_once 'DAO.class.php';
include_once 'IDatabaseFinder.class.php';

class UsuarioDAO extends DAO implements IDatabaseFinder {


    public function findByPK($pk) {

    }

    public function findByLogin($login) {
	
        $usuario = new Usuario();

        try {
		
            
            $stmt = $this->openConnection();
            $rs = $stmt->prepare("SELECT usu_usuario.*
                                 FROM usu_usuario
                                 WHERE usu_login = ?");
            
            $rs->bindParam(1,$login,PDO::PARAM_STR);
            $rs->execute();
            
            if($rs->rowCount() > 0){
               
                $row = $rs->fetch(PDO::FETCH_OBJ);
                $usuario->setCodigo($row->usu_codigo);
                $usuario->setLogin($row->usu_login);
                $usuario->setNome($row->usu_nome);
                $usuario->setBloqueado($row->usu_bloqueado);
                $usuario->setEmail($row->usu_email);
                $usuario->setMatricula($row->usu_matricula);
                $usuario->setSenha($row->usu_senha_hash);
                $usuario->setPerfil($row->usu_perfil);

            }

            return $usuario;

        }catch(Exception $e){
            echo "error";
            echo $e->getMessage();
            exit();
        }

    }

    


    public function listAll() {
        
    }
	
}

?>
