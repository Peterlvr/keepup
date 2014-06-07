<?php # Classe de Aluno
class Aluno {
	private $cdUsuario;
	private $dtNascimento;
	private $login;
	private $nmAluno;
	private $cdCidade;
	public function __construct($nome, $dtNascimento, $login, $cdCidade) {
		$this->nmAluno = $nome;
		$this->login = $login;
		$this->dtNascimento = $dtNascimento;
		$this->cdCidade = $cdCidade;
	}
	private $bio;
	public function setBio($txt) {
		$this->bio = $txt;
	}
	private $urlAvatar;
	public function setAvatar($url) {
		$this->urlAvatar = $url;
	}
	private function getIdUsuario() {
		$conexao = new Conexao();
		$tempquery =
			"SELECT cd_usuario from usuario where nm_login = '{$this->login}'";
		$cdUsuarioQ = $conexao->consultar($tempquery);
		$this->cdUsuario = $cdUsuarioQ[0]["cd_usuario"];
		return $this->cdUsuario;
	}
	private $sql;
	private function criarSql() {
		$sql = "INSERT into aluno values(NULL,'"
			. $this->getIdUsuario() . "','"
			. $this->nmAluno . "','"
			. $this->dtNascimento . "',NULL,NULL,NULL,NULL,NULL,NULL,"
			. $this->cdCidade . ")";
		$this->sql = $sql;
	}
	private $conexao;
	public function cadastrar() {
		$this->conexao = new Conexao();
		$this->criarSql();
		$this->conexao->executar($this->sql) or die("aluno.class:" .mysql_error());
	}
}
?>