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

	# checar o que se pesquisa
	# talvez devêssemos achar um nome melhor que critério
	/*
	if(isset($_GET["criterio"])) {
		if($_GET["criterio"] == "escola") {
			$oq = "escola";
		}
		else if($_GET["criterio"] == "aluno") {
			$oq = "aluno";
		}
		else if($_GET["criterio"] == "trabalho") {
			$oq = "trabalho";
		}
		else {
			$oq = 'trabalho';
		}
	}
	else {
		$oq = "trabalho";
	}
	#*/

	//string pesquisa na TABELA quando...
	$pesquisar = "SELECT * FROM trabalho WHERE ";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "nm_titulo LIKE '%{$termos[$i]}%' OR ";
		$pesquisar .= "ds_resumo LIKE '%{$termos[$i]}%'";

		if($i < $num - 1) {
			$pesquisar .= " OR ";
		}
	}

	if(isset($_GET["curso"])) {
		$pesquisar .= " OR cd_curso = {$_GET["curso"]}";
	}

	if(isset($_GET["escola"])) {
		$pesquisar .= " OR cd_escola = {$_GET["escola"]}";
	}

	$pesquisando = $conexao->consultar($pesquisar);
}

$cursos = $conexao->consultar("SELECT * FROM curso");
$alunos = $conexao->consultar("SELECT * FROM aluno");
$escolas = $conexao->consultar("SELECT * FROM escola");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pesquisa</title>
		<script src="js/jquery.js"></script>
		<script src="js/explore.js"></script>
	</head>
	<body>
		<?php include "header.php"; ?>
		<section id="pesquisa">
			<form name="pesquisa" method="GET" action="">
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
					<input type="checkbox" data-activates="aluno">
					<select name="aluno" disabled>
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
		<section id="resultados">
			<?php if(isset($pesquisando[0])) { ?>
				<ul>
					<?php foreach($pesquisando as $row)	{ ?>	
						<li>
							<h1>
								<?php echo $row["nm_titulo"]; ?>
							</h1>
							<p>
								<?php echo $row["ds_resumo"]; ?>
							</p>
						</li>
					<?php } ?>
				</ul>
			<?php } else { ?>
				<p>Sem resultados</p>
			<?php } ?>
		</section>
		<?php include "footer.php"; ?>
	</body>
</html>