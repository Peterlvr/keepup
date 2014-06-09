<?php
include "../../conexao.class.php";
include "../../sessao.php";

$con  = new Conexao();
$dados_escola = $con->consultar("SELECT * FROM escola WHERE cd_escola = {$_SESSION["cd_escola"]}; ");
$foto_escola = $dados_escola[0]["tx_url_avatar"];
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
		if($_FILES["file"]["name"] <> $foto_escola) {
			mkdir("../images/upload/{$_SESSION["cd_usuario"]}");
			$con->executar("UPDATE escola SET tx_url_avatar = '".$_FILES["file"]["name"]."' WHERE cd_escola = {$_SESSION["cd_escola"]}; ");
			move_uploaded_file($_FILES["file"]["tmp_name"], "../images/upload/". $_SESSION["cd_usuario"] . "/" . $_FILES["file"]["name"]);
			$_SESSION['url_avatar'] = $_FILES["file"]["name"];	  	
		  	header ("location:../editarperfil.php?e=sucesso");
	  	}
		else {
			header ("location:../editarperfil.php?e=arquivoinvalido");
		}		
	}
}
?>