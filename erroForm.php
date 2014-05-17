<?php # Erros de formulário (via GET)
$e = "";
if(isset($_GET["e"])) {
	$e = $_GET["e"];
	if($e == 1) {
		$e = "Preencha todos os campos conforme requerido.";
	}
	else if($e == 3) {
		$e = "Nome de usuário e senha não correspondem.";
	}
}
?>