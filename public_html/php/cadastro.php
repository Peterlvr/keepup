<?php # Script de cadastro
error_reporting(E_ALL);
# Funções para retorno em caso de erros
function volta($e) {
	header("location:../cadastro.php?e=" . $e);
	die();
}

# Inserções necessárias
# a ordem é importante!
require_once("../../salt.php");
require_once("../../conexao.class.php");
require_once("../../usuario.class.php");

# Receber informações necessárias OR DIE!
$nmLogin = $_POST["nmLogin"] or volta(1);
$nmSenha = $_POST["nmSenha"] or volta(1);
$nmSenha = crypt($nmSenha, salt());
$nmEmail = $_POST["nmEmail"] or volta(1);
$cdCidade =$_POST["cdCidade"] or volta(1);
$rbTipo = $_POST["rbTipo"] or volta(1);

# Cadastrar usuário e o perfil relacionado a ele
if($rbTipo == "A") { # A = aluno
	require_once("../../aluno.class.php");
	$nmAluno = $_POST["nmAluno"] or volta(1);
	$dtNascimento = $_POST["dtNascimento"] or volta(1);
	$usuario = new Usuario($nmLogin, $nmSenha, true);
	$usuario->setValsCadastro($nmEmail, "A");
	$usuario->cadastrar();
	$aluno = new Aluno($nmAluno, $dtNascimento, $nmLogin, $cdCidade);
	$aluno->cadastrar();
}
else if($rbTipo == "E") { # E = escola
	require_once("../../escola.class.php");
	$nmEscola = $_POST["nmEscola"] or volta(1);
	$cdCNPJ = $_POST["cdCNPJ"] or volta(1);
	$usuario = new Usuario($nmLogin, $nmSenha, true);
	$usuario->setValsCadastro($nmEmail, "E");
	$usuario->cadastrar();
	$escola = new Escola($nmEscola, $nmLogin, $cdCNPJ, $cdCidade);
	$escola->cadastrar();
}
else { # Este tipo não existe!
	volta(1);
}

header("location:../");
?>