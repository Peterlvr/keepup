<?php # Script de Editar Perfil

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../editarperfil.php?e=" . $e);
	die();
}

# Inserções necessárias
# a ordem é importante!
require_once("../../sessao.php");
require_once("../../salt.php");
require_once("../../conexao.class.php");
require_once("../../usuario.class.php");

$nmEmail = $_POST["nmEmail"] or volta(1);
$nmLogin = $_SESSION["login"];
$nmSenha = $_POST["senhaConta"] or volta(2);
$confSenha = $_POST["confirmaSenhaConta"] or volta(3);
if ($nmSenha == $confSenha) 
{
	$dbConsulta = new Conexao();
	$consulta = $dbConsulta->consultar(
		"SELECT * FROM usuario WHERE nm_login = '$nmLogin' ");
	$resultadoConsulta = $consulta[0];

	$dbSenha = $resultadoConsulta["nm_senha"];

	require_once("../../compararSenhas.php");

	if(compararSenhas($nmSenha, $dbSenha)) 
	{
		$con = new Conexao();
		$con->executar("UPDATE usuario SET nm_email = '$nmEmail' WHERE cd_usuario = {$_SESSION['cd_usuario']}");
		header("location:../editarperfil.php?e=sucesso");
	}
	else {
			volta(4);
		}
}
else {
	volta(5);
}
?>