<?php
# vamos usar a conexão mais tarde
require "../conexao.class.php";
require "../sessao.php";

$conexao = new Conexao();

//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']) and $_GET['pesquisa'] <> '')
{

	//a pesquisa é separada por termos(palavras pesquisadas)
	$termos = explode(' ', $_GET['pesquisa']);
	//contagem dos termos
	$num = count($termos);

	$pesquisar =
		"SELECT
			t.cd_trabalho 'cd',
			t.nm_titulo 'titulo',
			t.ds_resumo 'resumo',
			c.nm_curso 'curso',
			t.aa_publicacao 'publicado_em',
			e.nm_escola 'escola'
		FROM
			trabalho t,
			curso c,
			escola e
		WHERE 
			t.cd_curso = c.cd_curso AND
			e.cd_escola = t.cd_escola AND (";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "nm_titulo LIKE '%{$termos[$i]}%' OR ";
		$pesquisar .= "ds_resumo LIKE '%{$termos[$i]}%'";

		if($i < $num - 1) {
			$pesquisar .= " OR ";
		}
	}

	$pesquisar .= ")";

	if(isset($_GET["curso"])) {
		$pesquisar .= " AND cd_curso = {$_GET["curso"]}";
	}

	if(isset($_GET["escola"])) {
		$pesquisar .= " AND cd_escola = {$_GET["escola"]}";
	}

	$pesquisando = $conexao->consultar($pesquisar);
}

$cursos = $conexao->consultar("SELECT * FROM curso");
$alunos = $conexao->consultar("SELECT * FROM aluno");
$escolas= $conexao->consultar("SELECT * FROM escola");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Explore - Keep Up</title>
		<script src="js/jquery.js"></script>
		<script src="js/explore.js"></script>
	</head>
	<body>
		<?php include "header.php"; ?>
		<section id="pesquisa">
			<form name="pesquisa" id="pesquisaForm" method="GET" action="">
				<p>
					<input type="text" name="pesquisa">
				</p>
				<p>
					<input type="checkbox" data-activates="curso">	
					<select name="curso" disabled>
						<?php foreach($cursos as $curso) { ?>
							<option value="<?php echo $curso["cd_curso"]; ?>">
								<?php echo $curso["nm_curso"]; ?>
							</option>
						<?php } ?>
					</select>
				</p>
				<p>
					<input type="checkbox" data-activates="autor">
					<select name="autor" disabled>
						<?php foreach($alunos as $aluno) { ?>
							<option value="<?php echo $aluno["cd_aluno"]; ?>">
								<?php echo $aluno["nm_aluno"]; ?>
							</option>
						<?php } ?>
					</select>
				</p>
				<p>
					<input type="checkbox" data-activates="escola">
					<select name="escola" disabled>
						<?php foreach($escolas as $escola) { ?>
							<option value="<?php echo $escola["cd_escola"]; ?>">
								<?php echo $escola["nm_escola"]; ?>
							</option>
						<?php } ?>
					</select>
				</p>
				<p>
					<input type='submit' value='Buscar'>
				</p>
			</form>
		</section>
		<section id="resultados"></section>
		<?php include "footer.php"; ?>
	</body>
</html>