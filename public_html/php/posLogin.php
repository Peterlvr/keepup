<?php # Pós-login
session_start();
$ultimaPagina = $_GET["de"];
if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
	require_once("../../conexao.class.php");
	$con = new Conexao();
	if($_SESSION["tipoConta"] == "A") {
		$resultado = $con->consultar(
			"SELECT * FROM aluno WHERE cd_usuario = " . $_SESSION["cd_usuario"]
		);
		$resultado = $resultado[0];
		$_SESSION["nome"] = $resultado["nm_aluno"];
	}
	else if($_SESSION["tipoConta"] == "E") {
		$resultado = $con->consultar(
			"SELECT * FROM escola WHERE cd_usuario = " . $_SESSION["cd_usuario"]
		);
		$resultado = $resultado[0];
		$_SESSION["nome"] = $resultado["nm_escola"];
	}

	echo "<!doctype html><script>location.href='$ultimaPagina';</script>";
}
else {
	header("location:../");
}
?>