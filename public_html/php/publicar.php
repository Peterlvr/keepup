<?php # Script de publicação

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../publicar.php?e=" . $e);
	die();
}

require "../../sessao.php";
if(!$logado) {
	volta(0); # Página para usuários cadastrados
}

# Coletar informações do formulário
$nmTitulo = $_POST["nmTitulo"] or volta(1);
$cdCurso = $_POST["cdCurso"] or volta(2);
$cdEscola = $_POST["cdEscola"] or volta(3);
$aaPublicacaoReal = $_POST["aaPublicacaoReal"] or volta(4);
$dsResumo = $_POST["dsResumo"] or "";
$arquivoPrincipal = $_FILES["arquivoPrincipal"] or volta(6);

if($arquivoPrincipal["type"] != "application/x-pdf" && $arquivoPrincipal["type"] != "application/pdf") {
	volta(7);
}

require "../../conexao.class.php";
require "../../trabalho.class.php";
$cdUsuario = $sessao["cd_usuario"];
$trabalho = new Trabalho($nmTitulo, $dsResumo, $cdEscola, $cdCurso, $cdUsuario, $aaPublicacaoReal);

if($trabalho->cadastrar($arquivoPrincipal)) {
	header("location:../publicar.php?status=sucesso");
}
else {
}
?>