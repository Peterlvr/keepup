<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	//passa para Session
	//através do GET, tira da url o nm-login
	//$nm_login = $_GET["u"];
	$cd_usuario = $_GET['u'];
		
	$usuario = "SELECT nm_tipo, nm_login FROM usuario WHERE cd_usuario = '$cd_usuario'";
	$pageuser = $conexao->consultar($usuario);

	if($pageuser[0]['nm_tipo'] == 'A')
	{
		header('location:aluno.php?u='.$pageuser[0]['nm_login'].'');
	}

	if($pageuser[0]['nm_tipo'] == 'E')

	{
		header('location:escola.php?u='.$pageuser[0]['nm_login'].'');
	}
	
?>