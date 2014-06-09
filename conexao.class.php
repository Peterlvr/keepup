<?php # Classe de conexão
class Conexao {
	private $host = "localhost";
	private $usuario = "root";
	private $senha = "usbw";
	private $banco = "keepup";
	private $conexao;
	private $conexaoBanco;
	private function conectar() {
		if($this->conexao = mysql_connect($this->host, $this->usuario, $this->senha)) {
			if($this->conexaoBanco = mysql_select_db($this->banco)) {
		#		header('Content-Type: text/html; charset=utf-8');
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');
				return $this;
			}
		}
		die("conexao.class:20". mysql_error());
	}
	private function desconectar() {
		mysql_close($this->conexao);
	}
	public function get() {
		return $this->conexao;
	}
	public function consultar($sql) {
		$this->conectar();
		if($query = mysql_query($sql)) {
			$arr_resultado = array();
			while($resultado = mysql_fetch_array($query)) {
				array_push($arr_resultado, $resultado);
			}
			$this->desconectar();
			return $arr_resultado;
		}
		else {
			echo "conexao:39: ".mysql_error();
			$this->erro = mysql_error();
			$this->desconectar();
			return false;
		}
	}
	public function executar($sql) {
		$this->conectar();
		if($query = mysql_query($sql)) {
			$this->desconectar();
			return true;
		}
		else {
			echo "conexao.class: ". mysql_error();
			$this->erro = mysql_error();
			$this->desconectar();
			return false;
		}
	}
}
?>