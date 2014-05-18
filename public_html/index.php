<?php # Visão 'index'
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
if($logado) {
	$cdUsuario = $sessao["cd_usuario"];
	$codigoPerfil = $_SESSION["cd_aluno"] || $_SESSION["cd_escola"];
	$consulta =
		"SELECT
			t.nm_titulo 'titulo'
		FROM
			trabalho t, autoria a
		WHERE
			t.cd_trabalho = a.cd_trabalho and 
			a.cd_aluno = $codigoPerfil";
	$trabalhosUsuario = $conexao->consultar($consulta);

	$sessao["trabalhosUsuario"] = $trabalhosUsuario;

	$cFavoritos =
		"SELECT
			t.nm_titulo 'titulo'
		FROM 
			trabalho t, favorito at, aluno a 
		WHERE 
			t.cd_trabalho = at.cd_trabalho and
			at.cd_aluno = a.cd_aluno
		ORDER BY 
			at.dt_favoritado DESC";
	$favoritos = $conexao->consultar($cFavoritos);

	$sessao["favoritos"] = $favoritos;
}
else {
	
}
$umaSemanaAtras = date("Y-m-d H:i:s", strtotime("-1 week"));
$consulta =
	"SELECT 
		t.nm_titulo,
		c.nm_curso,
		t.ds_resumo,
		t.cd_trabalho
	FROM
		trabalho t, curso c
	WHERE
		t.cd_curso = c.cd_curso and
		t.dt_publicado > '$umaSemanaAtras'
	ORDER BY
		t.dt_publicado DESC";

$sessao["trabalhosRecentes"] = $conexao->consultar($consulta);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Keep Up</title>
    	<script src="js/jquery.js"></script>
    </head>
    <body>
    	<?php require("header.php"); ?>
		<section id="principal">
			<?php if(!$logado) { ?>
				<section id="slides">
					<div id="slide1">
						<p>adoro</p>
					</div>
					<div id="slide2">
						<p>meu</p>
					</div>
					<div id="slide3">
						<p>super</p>
					</div>
					<div id="slide4">
						<p>tcc</p>
					</div>
				</section>
				<script src="js/slides.js"></script>
				<script>
					$().ready(function() {
						$.slides("slide", 4);
					});
				</script>
			<?php } ?>
			<section id="trabalhos_recentes">
				<h1>Trabalhos recentes</h1>
				<?php if(isset($sessao["trabalhosRecentes"]) && sizeof($sessao["trabalhosRecentes"]) > 0) { ?>
					<ul>
						<?php foreach($sessao["trabalhosRecentes"] as $trabalho) { ?>
							<li>
								<h1><?php echo $trabalho["nm_titulo"]; ?></h1>
								<div class="imagemTrabalho">
									<img src="<?php echo $trabalho["url_imagem"]; ?>" alt="">
								</div>
								<p>
									<a href="docs/<?php echo $trabalho["cd_trabalho"]; ?>/main.pdf">
										<?php echo $trabalho["ds_resumo"]; ?>
									</a>
								</p>
							</li>
						<?php } ?>
					</ul>
				<?php }
				else { ?>
					<p>Nenhum trabalho recente</p>
				<?php } ?>
			</section>
			<?php if($logado) { ?>
				<section id="meus_trabalhos">
					<h1>Meus trabalhos</h1>
					<?php if(isset($sessao["trabalhosUsuario"]) && $sessao["trabalhosUsuario"] > 0) { ?>
						<ul>
							<?php foreach($sessao["trabalhosUsuario"] as $trabalho) { ?>
								<li>
									<div class="imagemTrabalho">
										<img src="<?php echo $trabalho["url_imagem"]; ?>" alt="">
										<p>
											<a href="docs/<?php echo $trabalho["cd_trabalho"]; ?>/main.pdf">
												<?php echo $trabalho["ds_resumo"]; ?>
											</a>
										</p>
									</div>
								</li>
							<?php } ?>
						</ul>
					<?php }
					else { ?>
						<p>Você não tem nenhum trabalho.
							<a href="publicar.php">Poste um!</a>
						</p>
					<?php } ?>
				</section>
				<section id="favoritos_recentes">
					<h1>Favoritos recentes</h1>
					<?php if(isset($sessao["favoritos"]) && $sessao["favoritos"] > 0) { ?>
						<ul>
							<?php foreach($sessao["favoritos"] as $trabalho) { ?>
								<li>
									<div class="imagemTrabalho">
										<img src="<?php echo $trabalho["url_imagem"]; ?>" alt="">
										<p>
											<a href="docs/<?php echo $trabalho["cd_trabalho"]; ?>/main.pdf">
												<?php echo $trabalho["ds_resumo"]; ?>
											</a>
										</p>
									</div>
								</li>
							<?php } ?>
						</ul>
					<?php }
					else { ?>
						<p>Você não tem nenhum favorito.
							<a href="explore.php">Encontre algo interessante!</a>
						</p>
					<?php } ?>
				</section>
			<?php } ?>
		</section>
		<footer>
			... (rodapé) ...
		</footer>
    </body>
</html>