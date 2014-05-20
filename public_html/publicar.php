<?php # Visão 'publicar'
require "../sessao.php";
if($logado) {
	require "../conexao.class.php";
	$con = new Conexao();
	$sessao["cursos"] = $con->consultar(
		"SELECT nm_curso, cd_curso
		from curso");
	$sessao["escolas"] = $con->consultar(
		"SELECT nm_escola, cd_escola
		from escola");
	$sessao["alunos"] = $con->consultar(
		"SELECT nm_aluno, cd_aluno
		from aluno");
}
else {
	header("location:./");
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Publicar - Keep Up</title>
		<script src="js/jquery.js"></script>
		<script src="js/publicar.js"></script>
	</head>
	<body>
		<?php require("header.php"); ?>
		<section id="publicar">
			<form enctype="multipart/form-data" action="php/publicar.php" method="POST">
				<h1>Publicar trabalho</h1>
				<p>
					<label for="nmTitulo">Título:</label>
				</p>
				<p>
					<input name="nmTitulo" required>
				</p>
				<p>
					<label for="cdCurso">Para qual curso?</label>
				</p>
				<p>
					<select name="cdCurso">
						<?php foreach($sessao["cursos"] as $curso) { ?>
							<option value="<?php echo $curso["cd_curso"]; ?>">
								<?php echo $curso["nm_curso"]; ?>
							</option>
						<?php } ?>
						<!--option value="outro">Outro...</option-->
					</select>
				</p>
				<p>
					<label for="cdEscola">Para qual instituição?</label>
				</p>
				<p>
					<?php if($sessao["tipoConta"] == "A") { ?>
						<select name="cdEscola">
							<?php foreach($sessao["escolas"] as $escola) { ?>
								<option value="<?php echo $escola["cd_escola"]; ?>">
									<?php echo $escola["nm_escola"]; ?>
								</option>
							<?php } ?>
							<!--option value="outra">Outra...</option-->
						</select>
					<?php } ?>
					<?php if($sessao["tipoConta"] == "E") { ?>
						<select name="cdEscola" disabled>
							<option value="<?php echo $sessao["cd_escola"]; ?>">
								<?php echo $escola["nome"]; ?>
							</option>
						</select>
					<?php } ?>
				</p>
				<p>
					<label for="cdAluno">Cite os autores:</label>
				</p>
				<p id="cdAluno">
					<?php if($sessao["tipoConta"] == "E") { ?>
						<select name="cdAluno1" class="cdAluno">
							<?php foreach($sessao["alunos"] as $aluno) { ?>
								<option value="<?php echo $aluno["cd_aluno"]; ?>">
									<?php echo $aluno["nm_aluno"]; ?>
								</option>
							<?php } ?>
							<!--option value="outra">Outra...</option-->
						</select>
					<?php } ?>
					<?php if($sessao["tipoConta"] == "A") { ?>
						<select name="cdAluno1" class="cdAluno">
							<option value="<?php echo $sessao["cd_aluno"]; ?>">
								<?php echo $sessao["nome"]; ?>
							</option>
							<?php foreach($sessao["alunos"] as $aluno) { ?>
								<option value="<?php echo $aluno["cd_aluno"]; ?>">
									<?php echo $aluno["nm_aluno"]; ?>
								</option>
							<?php } ?>
						</select>
					<?php } ?>
				</p>
				<p>
					<a href="javascript:void(0)" id="adicionarAutor">+ autor</a>
				</p>
				<p>
					<label for="aaPublicacaoReal">Em que ano esse trabalho foi apresentado?</label>
				</p>
				<p>
					<input name="aaPublicacaoReal" size="4" required pattern="[0-9]{4}" title="AAAA" placeholder="AAAA">
				</p>
				<!-- reminder: outros autores -->
				<!-- reminder: adicionar mídias -->
				<p>
					<label for="dsResumo">Faça um resumo do seu trabalho acadêmico para fácil visualização <small>(a Introdução do trabalho pode servir)</small>:</label>
				</p>
				<p>
					<textarea name="dsResumo"></textarea>
				</p>
				<p>
					<label for="arquivoPrincipal">Insira o documento principal do trabalho (em PDF):</label>
				</p>
				<p>
					<input type="file" name="arquivoPrincipal">
				</p>
				<p>
					<input type="submit" value="Publicar">
				</p>
			</form>
		</section>
		<?php include 'footer.php'; ?>
	</body>
</html>