<?php # Inicia sessão e define $logado como verdadeiro ou falso
session_start();
$logado;
if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
	$logado = true;
	$sessao = $_SESSION;
}
else {
	$logado = false;
}
?>