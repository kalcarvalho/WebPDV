<?php



class Usuario {

    private $codigo;
    private $nome;
    private $login;
    protected $senha;
    private $email;
    private $matricula;
	private $perfil;
	private $bloqueado;
	private $enviar_email;
	private $data_registro;
	private $ultimo_acesso;
	private $gid;
	private $ativacao;
	private $parametros;  

   

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->descricao;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getSenha() {
        return $this->senha;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setBloqueado($ativo) {
        $this->ativo = $ativo;
    }

    public function isBloqueado() {
        return $this->ativo;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getPerfil() {
        return $this->perfil;
    }
	
	public function setEnviarEmail($enviar_email) {
		$this->enviar_email = $enviar_email;
	}
	
	public function getEnviarEmail() {
		return $this->enviar_email;
	}
	
	public function setDataRegistro($data_registro) {
		$this->data_registro = $data_registro;
	}
	public function getDataRegistro() {
		return $this->data_registro;
	}
	

    

}