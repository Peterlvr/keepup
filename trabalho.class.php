<?php # Classe de trabalho
class Trabalho {
	private $nmTitulo;
	private $dsResumo;
	private $cdEscola;
	private $cdCurso;
	private $dtPublicado;
	private $aaPublicacao;
	private $con; # Uma conexão para a instância toda
	public function __construct($titulo, $resumo, $cdEscola, $cdCurso, $aaPublicacao) {
		$this->nmTitulo = $titulo;
		$this->dsResumo = $resumo;
		$this->cdEscola = $cdEscola;
		$this->cdCurso = $cdCurso;
		$this->dtPublicado = date("Y-m-d H:i:s");
		$this->aaPublicacao = $aaPublicacao;
		$this->con = new Conexao();
	}
	private $cdTrabalho;
	private function salvar($arquivo) {
		$filename = __DIR__ . $this->foldername . "/main.pdf";
		if(move_uploaded_file($arquivo["tmp_name"], $filename)) {
			return true;
		}
		else {
			return false;
		}
	}
	public function cadastrar($arquivo) {
		$consulta_ultimo_cd = $this->con->consultar("SELECT max(cd_trabalho) 'c' FROM trabalho");
		$novoid = $consulta_ultimo_cd[0]['c'] + 1;

		$sql = "INSERT into trabalho values (
			$novoid,
			'{$this->nmTitulo}',
			'{$this->dsResumo}',
			'{$this->cdEscola}',
			'{$this->cdCurso}',
			'{$this->dtPublicado}',
			{$this->aaPublicacao})";
		
		$this->con->executar($sql);
		$this->foldername = ("/public_html/docs/$novoid");
		mkdir(__DIR__ . $this->foldername, 0755, true);
		if(!$this->salvar($arquivo)) {
			return false;
		}
		#echo $this->autores;
		# para cada autor, uma linha na tabela autoria
		/*foreach($this->autores as $autor) {
			$sql = "INSERT into autoria values ($autor, $novoid)";
			echo $sql;
			$this->con->executar($sql) or die();
		}*/
		return true;
	}
}
?>