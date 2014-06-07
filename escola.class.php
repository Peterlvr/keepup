<?php # Classe de Escola
class Escola {
	private $cdUsuario;
	private $login;
	private $nmEscola;
	private $CNPJ;
	private $cdCidade;
	public function __construct($nome, $login, $CNPJ, $cdCidade, $nmLocalizacao) {
		$this->nmEscola = $nome;
		$this->login = $login;
		$this->CNPJ = $CNPJ;
		$this->cdCidade = $cdCidade;
		$this->nmLocalizacao = $nmLocalizacao;
	}
	private $bio;
	public function setBio($txt) {
		$this->bio = $txt;
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
		$sql = "INSERT into escola values(NULL,'"
			. $this->getIdUsuario() . "','"
			. $this->nmEscola . "', '"
			. $this->CNPJ . "',NULL,NULL,'{$this->nmLocalizacao}',NULL,NULL,"
			. $this->cdCidade . ")";
		$this->sql = $sql;
	}
	private $conexao;
	public function cadastrar() {
		$this->conexao = new Conexao();
		$this->criarSql();
		$this->conexao->executar($this->sql) or die(mysql_error());
	}
}
?>