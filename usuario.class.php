<?php # Classe de usuário
class Usuario {
	private $nmLogin;
	private $nmSenha;
	private $nmEmail;
	private $nmTipo;
	private $dtCriacaoConta;
	private $dtUltimoAcesso;
	private $desativado = 0;
	public function setValsCadastro($email, $tipo) {
		$this->nmEmail = $email;
		$this->nmTipo = $tipo;
		$this->dtCriacaoConta = date("Y-m-d");
		$this->dtUltimoAcesso = date("Y-m-d H:i:s");
	}
	public function __construct($login, $senha, $real) {
		$this->nmLogin = $login;
		$this->nmSenha = $senha;
		if($real == false)
			$this->desativado = 1;
	}
	private $sql;
	private function criarSql() {
		$sql = "insert into usuario values (NULL,'"
			. $this->nmLogin . "','"
			. $this->nmSenha . "','"
			. $this->nmEmail . "','"
			. $this->nmTipo . "','"
			. $this->dtCriacaoConta . "','"
			. $this->dtUltimoAcesso . "', {$this->desativado})";
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