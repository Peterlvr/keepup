<?php # Classe de trabalho
class Trabalho {
	private $nmTitulo;
	private $dsResumo;
	private $cdEscola;
	private $cdCurso;
	private $dtPublicado;
	private $aaPublicacao;
	private $autores;
	private $pchaves;
	private $con; # Uma conexão para a instância toda
	public function __construct($titulo, $resumo, $cdEscola, $cdCurso, $aaPublicacao, $autores, $pchaves) {
		$this->nmTitulo = $titulo;
		$this->dsResumo = $resumo;
		$this->cdEscola = $cdEscola;
		$this->cdCurso = $cdCurso;
		$this->pchaves = $pchaves;
		$this->dtPublicado = date("Y-m-d H:i:s");
		$this->aaPublicacao = $aaPublicacao;
		$this->autores = $autores;
		$this->con = new Conexao();
	}
	private $cdTrabalho;
	private function salvar($arquivo) {
		$filename = $this->foldername . "/main.pdf";
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
			{$this->aaPublicacao},
			'{$this->pchaves}')";
		
		$this->con->executar($sql);
		$this->foldername = __DIR__ . "/public_html/docs/$novoid";
		mkdir($this->foldername, 0755, true);
		if(!$this->salvar($arquivo)) {
			return false;
		}

		# para cada autor, uma linha na tabela autoria
		foreach($this->autores as $autor) {
			$sql = "INSERT into autoria values ($autor, $novoid)";
			$this->con->executar($sql) or die();
		}
		return true;
	}
}
?>