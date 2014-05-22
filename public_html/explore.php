<?php
//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']) and $_GET['pesquisa'] <> '')
{
	require "../conexao.class.php";
	//a pesquisa é separada por termos(palavras pesquisadas)
	$termos = explode(' ', $_GET['pesquisa']);
	//contagem dos termos
	$num = count($termos);

	# checar o que se pesquisa
	# talvez devêssemos achar um nome melhor que critério
	if(isset($_GET["criterio"])) {
		if($_GET["criterio"] == "curso") {
			$oq = "curso";
		}
		else if($_GET["criterio"] == "escola") {
			$oq = "escola";
		}
		else if($_GET["criterio"] == "aluno") {
			$oq = "aluno";
		}
		else {
			$oq = 'aluno';
		}
	}
	else {
		$oq = "aluno";
	}

	//string pesquisa na TABELA quando...
	$pesquisar = "SELECT * FROM $oq WHERE ";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "nm_$oq LIKE '%{$termos[$i]}%'  ";

		if($i < $num - 1) {
			$pesquisar .= " AND "; 
		}
	}
	
	//conecta ao banco
	$conexao = new Conexao();

	//executa a busca pelas palavras
	$pesquisando = $conexao->consultar($pesquisar);

}

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pesquisa </title>
	</head>
	<body>
		<?php include "header.php"; ?>
		<section id="pesquisa">
			<form name="pesquisa" method="GET" action="">
				<p>
					<input type="text" name="pesquisa">
				</p>
				<p>
					<input type="radio" name="criterio" value="aluno"> Aluno
					<input type="radio" name="criterio" value="escola"> Escola
					<input type="radio" name="criterio" value="trabalho"> Trabalho
					<input type="radio" name="criterio" value="curso"> Curso
				</p>
				<p>
					<input type='submit' value='buscar'>
				</p>
			</form>
		</section>
		<section id="resultados">
			<?php if(isset($pesquisando[0])) { ?>
				<?php foreach($pesquisando as $row)	{ ?>	
					<p>
						<?php echo $row["nm_$oq"]; ?>
					</p>
				<?php } ?>
			<?php } else { ?>
				<p>Sem resultados</p>
			<?php } ?>
		</section>
		<?php include "footer.php"; ?>
	</body>
</html>