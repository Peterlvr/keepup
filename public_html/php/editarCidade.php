<?php # Script de Editar Cidade

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

//$nmInstituicao = $_POST["nmInstituicao"] or volta(3);
$tipoConta = $_SESSION["tipoConta"];
if(isset($_POST['cdCidade']))
{
		$cdCidade = $_POST["cdCidade"];
		$con = new Conexao();
		$con->executar("UPDATE aluno 
						SET cd_cidade = $cdCidade WHERE cd_aluno = {$_SESSION['cd_aluno']}");
}

header("location:../editarperfil.php?e=sucesso");

?>