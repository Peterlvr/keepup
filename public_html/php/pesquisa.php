<?php
# vamos usar a conexão mais tarde
require "../../conexao.class.php";

$conexao = new Conexao();

//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']))
{

	//a pesquisa é separada por termos(palavras pesquisadas)
	$termos = explode(' ', $_GET['pesquisa']);
	//contagem dos termos
	$num = count($termos);

	$from = "FROM
			trabalho t,
			curso c,
			escola e";

	# condições WHERE para evitar repetições
	$where = "WHERE t.cd_curso = c.cd_curso AND
		e.cd_escola = t.cd_escola";

	if(isset($_GET["autor"])) {
		$from .= ", autoria au";
		$where .= " AND t.cd_trabalho = au.cd_trabalho";
	}

	$pesquisar =
		"SELECT
			t.cd_trabalho 'cd',
			t.nm_titulo 'titulo',
			t.ds_resumo 'resumo',
			c.nm_curso 'curso',
			t.aa_publicacao 'publicado_em',
			e.nm_escola 'escola'
		$from $where AND (";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "t.nm_titulo LIKE '%{$termos[$i]}%' OR ";
		$pesquisar .= "t.ds_resumo LIKE '%{$termos[$i]}%'";

		if($i < $num - 1) {
			$pesquisar .= " OR ";
		}
	}

	$pesquisar .= ")";

	if(isset($_GET["curso"])) {
		$pesquisar .= " AND t.cd_curso = {$_GET["curso"]}";
	}

	if(isset($_GET["escola"])) {
		$pesquisar .= " AND t.cd_escola = {$_GET["escola"]}";
	}

	if(isset($_GET["autor"])) {
		$pesquisar .= " AND au.cd_aluno = {$_GET["autor"]}";
	}

	$pesquisando = $conexao->consultar($pesquisar);
}
?>
<?php if(isset($pesquisando[0])) { ?>
	<ul>
		<?php foreach($pesquisando as $row)	{ ?>	
			<li>
				<a href="docs/<?php echo $row["cd"]; ?>/main.pdf">
					<h1>
						<?php echo $row["titulo"]; ?>,
						<?php echo $row["publicado_em"]; ?>
					</h1>
					<p>
						<?php echo $row["resumo"]; ?>
					</p>
					<p>Curso:
						<?php echo $row["curso"]; ?>
					</p>
				</a>
			</li>
		<?php } ?>
	</ul>
<?php } else { ?>
	<p>Sem resultados</p>
<?php } ?>