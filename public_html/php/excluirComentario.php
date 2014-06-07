<?php # Script de Excluir Comentário

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

if(isset($_POST['comentarioExcluido'])) {
$comentario = $_POST['comentarioExcluido'] or volta(1);
$con = new Conexao();
$con->executar("DELETE FROM comentario 
				WHERE cd_comentario = $comentario");
}
header("location:../trabalho.php?t={$_SESSION['ultimoTrabalhoVisitado']}&e=sucesso");

?>