<?php
require("../sessao.php");

if(isset($_POST['opcao'])) {
	$opcao = preg_replace('#[^0-9]#i', '', $_POST['opcao']);
	if($opcao > 5 or $opcao < 1){
		echo 'Nao tente zuar nossa avaliação';
		exit();
	}
	else
	{
	include_once("../conexao.class.php");
	$con = new Conexao();
	$votarSN = $con->consultar("SELECT * FROM voto 
		WHERE cd_trabalho = {$_SESSION['ultimoTrabalhoVisitado']} 
		AND cd_aluno = {$_SESSION['cd_aluno']}");
	if($votarSN == true) {
		$con->executar("UPDATE voto SET vl_voto = $opcao WHERE cd_trabalho = {$_SESSION['ultimoTrabalhoVisitado']} AND cd_aluno = {$_SESSION['cd_aluno']}");
		echo "Seu voto foi alterado.";
		exit();
		}

	$con->executar("INSERT INTO voto 
		VALUES ({$_SESSION['ultimoTrabalhoVisitado']},{$_SESSION['cd_aluno']},$opcao)");
	$avaliacoes = $con->consultar("SELECT vl_voto FROM voto
		WHERE cd_trabalho = {$_SESSION['ultimoTrabalhoVisitado']}");
		echo "Obrigado por avaliar este trabalho.";
	}
}

?>