<?php # Adicionar a, ou remover de, favoritos

require "../../conexao.class.php";
require "../../sessao.php";

function saida($val) {
	echo $val;
}

$con = new Conexao();

$sessao["cd_aluno"] || saida("e");

$consulta = $con->consultar("SELECT * FROM favorito
	WHERE cd_aluno = {$sessao["cd_aluno"]}");

$adicionar = true; # se falso, remover

foreach($consulta as $favorito) {
	if($favorito["cd_trabalho"] == $_POST["trabalho"])
		$adicionar = false;
}

if($adicionar) {
	$agora = date("Y-m-d H:i:s");
	$con->executar("INSERT INTO favorito VALUES ({$sessao["cd_aluno"]}, {$_POST["trabalho"]}, '$agora')") or saida(mysql_error());
	saida("1");
}
else {
	$con->executar("DELETE FROM favorito WHERE cd_aluno = {$sessao["cd_aluno"]} and cd_trabalho = {$_POST["trabalho"]}") or saida(mysql_error());
	saida("0");
}