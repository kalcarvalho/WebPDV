<?php 

class ClasseProduto {
	private $codigo;
	private $referencia;
	private $descricao;
	
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
	
	
}

?>