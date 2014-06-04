<?php # Script de Editar Matricula

# Funções para retorno em caso de erros
function volta($e) {
	header("location:../editarperfil.php?e=" . $e);
	die();
}

# Inserções necessárias
# a ordem é importante!
require_once("../../sessao.php");
require_once("../../salt.php");
require_once("../../conexao.class.php");
require_once("../../usuario.class.php");

# Receber informações necessárias OR DIE!

$tipoConta = $_SESSION["tipoConta"];

if(isset($_POST['cdEscola']))
	#checar se o aluno já está matriculado em alguma escola
	#se nao estiver faça um insert

	{
		$cdEscola = $_POST["cdEscola"];
		$con = new Conexao();
		$con->executar("UPDATE matricula 
						SET cd_escola = $cdEscola WHERE cd_aluno = {$_SESSION['cd_aluno']}");
	}

header("location:../editarperfil.php?e=sucesso");


?>