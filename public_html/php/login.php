<?php # Script de login

# Funções de retorno
function volta($e) {
	header("location:../?e=" . $e);
	die();
}

require_once("../../salt.php");
require_once("../../conexao.class.php");
require_once("../../compararSenhas.php");

# Recuperar dados do formulário ou desistir
$nmLogin = $_POST["nmLogin"] or volta(1);
$nmSenha = $_POST["nmSenha"] or volta(2);

$dbConsulta = new Conexao();
$consulta = $dbConsulta->consultar(
	"SELECT * FROM usuario WHERE nm_login = '$nmLogin'");

$resultadoConsulta = $consulta[0];

$dbSenha = $resultadoConsulta["nm_senha"];

if(compararSenhas($nmSenha, $dbSenha)) {
	session_start();
	$_SESSION["logado"] = true;
	$_SESSION["login"] = $nmLogin;
	$_SESSION["tipoConta"] = $resultadoConsulta["nm_tipo"];
	$_SESSION["cd_usuario"] = $resultadoConsulta["cd_usuario"];

	$agora = date("Y-m-d H:i:s");
	$dbConsulta->executar(
		"UPDATE usuario
		SET dt_ultimo_acesso = '$agora'
		WHERE nm_login = '$nmLogin'"
	);

	if($_SESSION["tipoConta"] == "A") {
		$aluno = $dbConsulta->consultar(
			"SELECT cd_aluno, nm_url_avatar
			FROM aluno
			WHERE cd_usuario = {$_SESSION["cd_usuario"]}"
		);
		$_SESSION["cd_aluno"] = $aluno[0]["cd_aluno"];
		$_SESSION["url_avatar"] = $aluno[0]["nm_url_avatar"];
	}
	else if($_SESSION["tipoConta"] == "E") {
		$escola = $dbConsulta->consultar(
			"SELECT cd_escola, tx_url_avatar
			FROM escola
			WHERE cd_usuario = ". $_SESSION["cd_usuario"]
		);
		$_SESSION["cd_escola"] = $escola[0]["cd_escola"];
		$_SESSION["url_avatar"] = $escola[0]["tx_url_avatar"];
	}

	header("location:posLogin.php");
}
else {
	volta(3);
}
?>