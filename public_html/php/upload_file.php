<?php
include "../../conexao.class.php";
include "../../sessao.php";

$con  = new Conexao();
$dados_aluno = $con->consultar("SELECT * FROM aluno WHERE cd_aluno = {$_SESSION["cd_aluno"]}; ");
$foto_aluno = $dados_aluno[0]["nm_url_avatar"];
if($_FILES['file']['name'] <> '') 
{

	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 4000000)
		&& in_array($extension, $allowedExts)) {

		//ler endereço de foto de usuario no banco e permitir nova foto, apagando a anterior
		if($_FILES["file"]["name"] <> $foto_aluno) {
			mkdir("../images/upload/{$_SESSION["cd_aluno"]}");
			$con->executar("UPDATE aluno SET nm_url_avatar = '".$_FILES["file"]["name"]."' WHERE cd_aluno = {$_SESSION["cd_aluno"]}; ");
			move_uploaded_file($_FILES["file"]["tmp_name"], "../images/upload/". $_SESSION["cd_aluno"] . "/" . $_FILES["file"]["name"]);
			$_SESSION['url_avatar'] = $_FILES["file"]["name"];	  	
		  	header ("location:../editarperfil.php?e=sucesso");
	  	}
		else {
			header ("location:../editarperfil.php?e=arquivoinvalido");
		}		
	}
}
?>