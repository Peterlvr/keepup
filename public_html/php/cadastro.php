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

	$con = new Conexao();

	$consultaCdAluno = $con->consultar(
		"SELECT cd_aluno
		FROM aluno
		where
			cd_usuario = (
				SELECT cd_usuario FROM usuario WHERE nm_login = '$nmLogin'
			)") or die("cadastro:42 ".mysql_error());
	$cdAluno = $consultaCdAluno[0]["cd_aluno"];

	# Adicionar todos os cursos para Array
	$haCursos = true;
	$i = 1;
	$cursos = array();
	while($haCursos) {
		if(isset($_POST["cdCurso$i"])) {
			array_push($cursos, $_POST["cdCurso$i"]);
		}
		else {
			$haCursos = false;
			break;
		}
		$i++;
	}
	#var_dump($cursos);
	foreach($cursos as $curso) {
		$adcCurso = "INSERT into cursando values ($cdAluno, $curso, 1)";
		$con->executar($adcCurso) or die("60: " . mysql_error());
	#	var_dump($curso);
	}
	#die("manu");

	# Adicionar todos os escolas para Array
	$haEscolas = true;
	$i = 1;
	$escolas = array();
	while($haEscolas) {
		if(isset($_POST["cdEscola$i"])) {
			array_push($escolas, $_POST["cdEscola$i"]);
		}
		else {
			$haEscolas = false;
			break;
		}
		$i++;
	}
	#var_dump($cursos);
	foreach($escolas as $escola) {
		$adcEscola = "INSERT into matricula values ($cdAluno, $escola)";
		$con->executar($adcEscola) or die("84: " . mysql_error());
	#	var_dump($curso);
	}
	#die("manu");
}
else if($rbTipo == "E") { # E = escola
	require_once("../../escola.class.php");
	$nmEscola = $_POST["nmEscola"] or volta(1);
	$cdCNPJ = $_POST["cdCNPJ"] or volta(1);
	$nmLocalizacao = $_POST["nmLocalizacao"] or volta(2);
	$usuario = new Usuario($nmLogin, $nmSenha, true);
	$usuario->setValsCadastro($nmEmail, "E");
	$usuario->cadastrar();
	$escola = new Escola($nmEscola, $nmLogin, $cdCNPJ, $cdCidade, $nmLocalizacao);
	$escola->cadastrar();

	$con = new Conexao();

	$consultaCdAluno = $con->consultar(
		"SELECT cd_escola
		FROM escola
		where
			cd_usuario = (
				SELECT cd_usuario FROM usuario WHERE nm_login = '$nmLogin'
			)") or die("cadastro:107 ".mysql_error());
	$cdEscola = $consultaCdAluno[0]["cd_escola"];

	# Adicionar todos os cursos para Array
	$haCursos = true;
	$i = 1;
	$cursos = array();
	while($haCursos) {
		if(isset($_POST["cdCurso$i"])) {
			array_push($cursos, $_POST["cdCurso$i"]);
		}
		else {
			$haCursos = false;
			break;
		}
		$i++;
	}
	#var_dump($cursos);
	foreach($cursos as $curso) {
		$adcCurso = "INSERT into curso_oferecido values ($cdEscola, $curso)";
		$con->executar($adcCurso) or die("127: " . mysql_error());
	#	var_dump($curso);
	}
}
else { # Este tipo não existe!
	volta(1);
}

header("location:../");
?>