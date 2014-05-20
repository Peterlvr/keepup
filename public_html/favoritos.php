<?php
require_once "../sessao.php";
if($logado && $sessao["tipoConta"] == "A") {
	require_once "../conexao.class.php";
	$conexao = new Conexao();
	$favsql = 
		"SELECT
			t.nm_titulo 'nm_titulo',
			t.ds_resumo 'ds_resumo',
			t.cd_trabalho 'cd_trabalho'
		FROM
			trabalho t, favorito f
		WHERE
			t.cd_trabalho = f.cd_trabalho and
			f.cd_aluno = {$sessao["cd_aluno"]}
		ORDER BY
			f.dt_favoritado DESC";
	$sessao["favoritos"] = $conexao->consultar($favsql);
}
else {
	header("location:./");
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Keep Up - Favoritos</title>
	</head>
	<body>
		<?php include "header.php"; ?>
		<section id="favoritos">
			<h1>Favoritos</h1>
			<?php if(isset($sessao["favoritos"]) && sizeof($sessao["favoritos"]) > 0) { ?>
				<ul>
					<?php foreach($sessao["favoritos"] as $favorito) { ?>
						<li>
							<h1><?php echo $favorito["nm_titulo"]; ?></h1>
							<p>
								<a href="<?php echo "docs/{$favorito["cd_trabalho"]}/main.pdf"; ?>">
									<?php echo $favorito["ds_resumo"]; ?>
								</a>
							</p>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		<?php include 'footer.php'; ?>
	</body>
</html>