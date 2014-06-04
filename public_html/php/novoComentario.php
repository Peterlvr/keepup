<?php # Script de Novo Comentário

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../trabalho.php?t={$_SESSION['ultimoTrabalhoVisitado']}&e=" . $e);
	die();
}

# Inserções necessárias
# a ordem é importante!
require_once("../../sessao.php");
require_once("../../conexao.class.php");
require_once("../../usuario.class.php");

if(isset($_POST['campoComentario'])) {
$comentario = $_POST['campoComentario'] or volta(1);
$agora = date("Y-m-d H:i:s");
$con = new Conexao();
$con->executar("INSERT INTO comentario 
				VALUES (null, '$comentario', {$_SESSION['cd_usuario']}, {$_SESSION['ultimoTrabalhoVisitado']}, '$agora' )");
}
header("location:../trabalho.php?t={$_SESSION['ultimoTrabalhoVisitado']}&e=sucesso");




?>