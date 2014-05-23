<?php
//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']) and $_GET['pesquisa'] <> '')
{
	# vamos usar a conexão mais tarde
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

	//string pesquisa na TABELA quando...
	$pesquisar = "SELECT * FROM $oq WHERE (";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		if($oq == "trabalho") {
			$pesquisar .= "nm_titulo LIKE '%{$termos[$i]}%'  ";
		}
		else {
			$pesquisar .= "nm_$oq LIKE '%{$termos[$i]}%'  ";
		}

		if($i < $num - 1) {
			$pesquisar .= " OR "; 
		}
	}

	$pesquisar .= ")";
	
	# se a pesquisa for um trabalho, adiciona pesquisa por descrição
	if($oq == "trabalho") {
		$pesquisar .= " OR ( ";
		for($i=0; $i < $num; $i++) {
			// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
			$pesquisar .= "ds_resumo LIKE '%{$termos[$i]}%'";

			if($i < $num - 1) {
				$pesquisar .= " OR "; 
			}
		}

		$pesquisar .= ")";
	}
	
	$conexao = new Conexao();

	$pesquisando = $conexao->consultar($pesquisar);
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pesquisa </title>
		<script src="js/jquery.js"></script>
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
				<ul>
					<?php if($oq == 'trabalho') { ?>
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
					<?php }
					else if(($oq == "aluno") || ($oq == "escola")) { ?>
						<?php foreach($pesquisando as $row) { ?>
							<li>
								<h1>
									<?php echo $row["nm_$oq"]; ?>
								</h1>
								<p>
									<?php echo $row["tx_bio"]; ?>
								</p>
							</li>
						<?php } ?>
					<?php }
					else if($oq == "curso") { ?>
						<?php foreach($pesquisando as $row) { ?>
							<li>
								<p>
									<a href="#">
										<?php echo $row["nm_curso"]; ?>
									</a>
								</p>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			<?php } else { ?>
				<p>Sem resultados</p>
			<?php } ?>
		</section>
		<?php include "footer.php"; ?>
	</body>
</html>