<?php # Inicia sessão e define $logado como verdadeiro ou falso
session_start();
$logado = false;
if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
	$logado = true;
	$sessao = $_SESSION;
}
header("content-type:text/html;charset=UTF-8");
?>