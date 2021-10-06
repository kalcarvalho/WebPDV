<?php

class Produto {
	
	private $codigo;
	private $referencia;
	private $descricao;
	private $classeProduto;
	
	
	public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }
	
	public function setReferencia($referencia) {
		$this->referencia = $referencia;
	}
	
	public function getReferencia() {
		return $this->referencia;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}	
	
	public function getDescricao() {
		return $this->descricao;
	}
	
	public function setClasseProduto($classeProduto) {
		$this->classeProduto = $classeProduto;
	}	
	
	public function getClasseProduto() {
		return $this->classeProduto;
	}
	
	
	
	
}

?>