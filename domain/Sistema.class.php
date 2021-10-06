<?php

class Sistema {
	
	
	private $codigo;
	private $descricao;
	private $host;
	private $dbname;
	private $user;
	private $password;
	private $ativo;
	
	
	public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }
	
	
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}	
	
	public function getDescricao() {
		return $this->descricao;
	}
	
	public function setHost($host) {
		$this->host = $host;
	}	
	
	public function getHost() {
		return $this->host;
	}
	
	public function setDBName($dbname) {
		$this->dbname = $dbname;
	}
	
	public function getDBName() {
		return $this->dbname;
	}
	
	public function setUser($user) {
		$this->user = $user;
	}
	
	public function getUser() {
		return $this->user;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}
	
	public function getAtivo() {
		return $this->ativo;
	}
	
	
}


?>