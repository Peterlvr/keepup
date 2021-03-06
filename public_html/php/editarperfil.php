<?php # Script de Editar Perfil

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

# Cadastrar usuário e o perfil relacionado a ele
if($tipoConta == "A") { # A = aluno
	require_once("../../aluno.class.php");
	$nmAluno = $_POST["nmAluno"] or volta(1);
	$dtNascimento = $_POST["dtNascimento"] or volta(2);
	$txBio = $_POST["sobreMim"] or '';
	$nmProfissao = $_POST["nmProfissao"] or '';
	$nmFB = $_POST["nmFB"] or ''; 
	$nmLinkedin = $_POST["nmLinkedin"] or '';
	$nmUrlExterno = $_POST["nmUrlExterno"] or '';

	$con = new Conexao();
	$con->executar("UPDATE aluno 
					SET nm_aluno = '$nmAluno', dt_nascimento = '$dtNascimento', nm_profissao = '$nmProfissao', 
					tx_bio = '$txBio', nm_fb = '$nmFB', tx_url_linkedin = '$nmLinkedin', tx_url_externo = '$nmUrlExterno'
					WHERE cd_aluno = {$_SESSION['cd_aluno']}");
	
	$_SESSION['nome'] = $nmAluno;
	
}

if ($tipoConta == "E") { # E = escola
	$nmEscola = $_POST["nmEscola"] or volta(3);
	$sobreEscola = $_POST["sobreEscola"] or '';
	$Contato = $_POST["Contato"] or '';
	$Url = $_POST["Url"] or '';
	$Localizacao = $_POST['Localizacao'] or '';

	$con = new Conexao();
	$con->executar("UPDATE escola
					SET nm_escola = '$nmEscola', tx_info = '$sobreEscola', tx_contato = '$Contato', 
					tx_url_externo = '$Url', tx_endereco = '$Localizacao'
					WHERE cd_escola = {$_SESSION['cd_escola']} ");
	$_SESSION['nome'] = $nmEscola;
}

if(isset($_POST['cdCidade']))
{
	$cdCidade = $_POST["cdCidade"];
	$con = new Conexao();
	$con->executar("UPDATE aluno 
					SET cd_cidade = $cdCidade WHERE cd_aluno = {$_SESSION['cd_aluno']}");
}

header("location:../editarperfil.php?e=sucesso");



?>