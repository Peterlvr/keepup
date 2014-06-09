<?php # Script de publicação

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../publicartrabalho.php?e=" . $e);
	die();
}

require "../../sessao.php";
if(!$logado) {
	volta(0); # Página para usuários cadastrados
}

# Coletar informações do formulário
$nmTitulo = $_POST["nmTitulo"] or volta(1);
$cdCurso = $_POST["cdCurso"] or volta(2);
$cdEscola = $_POST["cdEscola"] or $sessao["cd_escola"] or volta(3);
$aaPublicacaoReal = $_POST["aaPublicacaoReal"] or volta(4);
$dsResumo = $_POST["dsResumo"] or "";
$arquivoPrincipal = $_FILES["arquivoPrincipal"] or volta(5);
$pchave = $_POST["tx_pchaves"] or volta(6);

# Adicionar todos os alunos para Array
$haAutores = true;
$i = 1;
$autores = array();
$autoriaDoUsuario = false;
while($haAutores) {
	if(isset($_POST["cdAluno$i"])) {
		array_push($autores, $_POST["cdAluno$i"]);
	}
	else {
		$haAutores = false;
		break;
	}
	if(($_POST["cdAluno$i"] == $sessao["cd_aluno"]) || $sessao["tipoConta"] != "A") {
		$autoriaDoUsuario = true;
	}
	$i++;
}
if(!$autoriaDoUsuario) volta(6);

# Checar se o arquivo é PDF
if($arquivoPrincipal["type"] != "application/x-pdf" && $arquivoPrincipal["type"] != "application/pdf") {
	volta(7);
}

require "../../conexao.class.php";
require "../../trabalho.class.php";

$trabalho = new Trabalho($nmTitulo, $dsResumo, $cdEscola, $cdCurso, $aaPublicacaoReal, $autores, $pchave);

if($trabalho->cadastrar($arquivoPrincipal)) {
	header("location:../publicar.php?status=sucesso");
}
else {
	header("location:../publicar.php?status=falha");
}
?>