<?php # Script de Editar Trabalho

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../editartrabalho.php?e=$e");
	die();
}

require_once("../../sessao.php");
require_once("../../conexao.class.php");

$logado or volta(0);

$cdTrabalho = $_POST["cdTrabalho"] or volta(3);

$conexao = new Conexao;
$trabalho = $conexao->consultar("SELECT * FROM trabalho WHERE cd_trabalho = $cdTrabalho");

if(sizeof($trabalho) != 1) {
	volta(7);
}

$autores = $conexao->consultar("SELECT * FROM autoria WHERE cd_trabalho = $cdTrabalho");
$autorDoTrabalho = false;

if($sessao["tipoConta"] == "A") {
    foreach($autores as $autor) {
        if($autor['cd_aluno'] == $sessao['cd'])
            $autorDoTrabalho = true;
    }
}
else {
    if($trabalho["cd_escola"] == $sessao["cd"])
        $autorDoTrabalho = true;
}

$autorDoTrabalho or volta(37);

$nmTitulo = $_POST["nmTitulo"] or volta(1);
$cdCurso = $_POST["cdCurso"] or volta(2);
$aaPublicacaoReal = $_POST["aaPublicacaoReal"] or volta(4);
$dsResumo = $_POST["dsResumo"] or "";
$pchave = $_POST["tx_pchaves"] or volta(6);


if(	$conexao->executar(
		"UPDATE trabalho
		SET
			nm_titulo = '$nmTitulo',
			ds_resumo = '$dsResumo',
			cd_curso = '$cdCurso', 
			tx_pchave = '$pchave'
		WHERE cd_trabalho = $cdTrabalho ")) {

	header("location:../trabalho.php?t=$cdTrabalho");
}
else {
	header("location:../editartrabalho.php?t=$cdTrabalho&e=".$conexao->erro);
}