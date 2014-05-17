<?php # Classe de usuário
class Usuario {
	private $nmLogin;
	public function getLogin() {
		return $this->nmLogin;
	}
	private $nmSenha;
	private $nmEmail;
	public function getEmail() {
		return $this->nmEmail;
	}
	public function setEmail($str) {
		$this->nmEmail = $str;
	}
	private $nmTipo;
	public function getTipo() {
		return $this->nmTipo;
	}
	public function setTipo($str) {
		$this->nmTipo = $str;
	}
	private $dtCriacaoConta;
	public function getCriacaoConta() {
		return $this->dtCriacao;
	}
	private $dtUltimoAcesso;
	public function getUltimoAcesso() {
		return $this->dtUltimoAcesso;
	}
	public function setValsCadastro($email, $tipo) {
		$this->nmEmail = $email;
		$this->nmTipo = $tipo;
		$this->dtCriacaoConta = date("Y-m-d");
		$this->dtUltimoAcesso = date("Y-m-d H:i:s");
	}
	public function __construct($login, $senha) {
		$this->nmLogin = $login;
		$this->nmSenha = $senha;
	}
	private $sql;
	private function criarSql() {
		$sql = "insert into usuario values (NULL,'"
			. $this->nmLogin . "','"
			. $this->nmSenha . "','"
			. $this->nmEmail . "','"
			. $this->nmTipo . "','"
			. $this->dtCriacaoConta . "','"
			. $this->dtUltimoAcesso . "')";
		$this->sql = $sql;
	}
	private $conexao;
	public function cadastrar() {
		$this->conexao = new Conexao();
		$this->criarSql();
		$this->conexao->executar($this->sql) or die(mysql_error());
		return true;
	}
}
?>