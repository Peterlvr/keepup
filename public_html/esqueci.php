<?php
require "../sessao.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Recuperação de senha - Keep Up</title>
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	    <link href="cs/global.css" rel="stylesheet" type="text/css" />
	    <script src="js/jquery.js" type="text/javascript"> </script>
	</head>
	<body>
		<?php include "header.php"; ?>
		<h1>Recuperação de senha</h1>
		<form action="php/recuperacao.php" method="POST">
			<p>Informe seu endereço de e-mail abaixo:</p>
			<p>
				<input name="email" placeholder="exemplo@dominio.com" type="email">
			</p>
			<p>
				<input type="submit" value="Enviar">
			</p>
		</form>
		<?php include "footer.php"; ?>
	</body>
</html>