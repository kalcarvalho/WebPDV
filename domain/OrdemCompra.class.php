<?php

class OrdemCompra {

	private $codigo;
	private $referencia;
	private $dataOC;
	private $usuario;
	private $fornecedor;
	private $autorizante;
	private $revisada;
	private $comentario;
	private $ordemCompra;
	private $assinada;
	private $autorizada;
	private $entrega;
	
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
	
	public function setDataOC($dataOC) {
		$this->dataOC = $dataOC;
	}
	
	public function getDataOC() {
		return $this->dataOC;
	}
	
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function setFornecedor($fornecedor) {
		$this->fornecedor = $fornecedor;
	}
	
	public function getFornecedor() {
		return $this->fornecedor;
	}
	
	public function setAutorizante($autorizante) {
		$this->autorizante = $autorizante;
	}
	
	public function getAutorizante() {
		return $this->autorizante;
	}
	
	public function setRevisada($revisada) {
		$this->revisada = $revisada;
	}
	
	public function getRevisada() {
		return $this->revisada;
	}
	
	public function setAutorizada($autorizada) {
		$this->autorizada = $autorizada;
	}
	
	public function getAutorizada() {
		return $this->autorizada;
	}
	
	public function setEntrega($entrega) {
		$this->entrega = $entrega;
	}
	
	public function getEntrega() {
		return $this->entrega;
	}
	
	
}

?>