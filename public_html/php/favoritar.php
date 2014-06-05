<?php # Adicionar a favoritos

require "../../conexao.class.php";
require "../../sessao.php";

function saida($val) {
	echo $val;
}

$con = new Conexao();

$sessao["cd_aluno"] || saida("0");

$agora = date("Y-m-d H:i:s");
$con->executar("INSERT INTO favorito VALUES ({$sessao["cd_aluno"]}, {$_POST["trabalho"]}, '$agora')") or saida("0");
saida("1");