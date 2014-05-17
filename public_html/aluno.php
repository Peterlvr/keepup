<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	//passar para Session

	//através do GET, tira da url o nm-login
	$cd_usuario = $_GET['u'];

	$comando = "SELECT * FROM aluno WHERE cd_usuario = $cd_usuario";

	$aluno = $conexao->consultar($comando);
	
	echo $aluno[0]["nm_aluno"];
	echo $aluno[0]["tx_bio"];
	echo $aluno[0]["cd_aluno"];

	$cd_aluno = $aluno[0]["cd_aluno"];
	$curso = "SELECT nm_curso FROM curso WHERE cd_curso = (SELECT cd_curso FROM cursando WHERE cd_aluno = $cd_aluno)";

	$cursoaluno = $conexao->consultar($curso);

	echo $cursoaluno[0]["nm_curso"];

/*		
	//lista de variáveis do trabalho

	$nm_titulo = ;
	$ds_resumo = ;
	$avaliacao = ;
	$nm_curso = ;
	$nm_escola = ;
	$dt_publicacao = ;*/
?>