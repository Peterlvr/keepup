<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	//passa para Session
	//através do GET, tira da url o nm-login
	//$nm_login = $_GET["u"];
	$nm_login = $_GET['u'];
		
	$usuario = "SELECT * FROM usuario WHERE nm_login = '$nm_login'";
	$pageuser = $conexao->consultar($usuario);

	if($pageuser[0]['nm_tipo'] == 'A')
	{
		header('location:aluno.php?u='.$pageuser[0]['cd_usuario'].'');
	}

	if($pageuser[0]['nm_tipo'] == 'E')

	{
		header('location:escola.php?u='.$pageuser[0]['cd_usuario'].'');
	}
	
?>