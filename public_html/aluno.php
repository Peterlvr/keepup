<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	

	//através do GET, tira da url o nm-login
	$cd_usuario = $_GET['u'];
	//seleciona dados da tabela aluno pelo codigo de usuario
	$comando = "SELECT * FROM aluno WHERE cd_usuario = $cd_usuario";
	$aluno = $conexao->consultar($comando);
	//cria variavel contendo o codigo do aluno
	$cd_aluno = $aluno[0]["cd_aluno"];
	//seleciona o nome do curso da tabela curso caso o aluno tenha um curso registrado
	$curso = "SELECT nm_curso FROM curso WHERE cd_curso = (SELECT cd_curso FROM cursando WHERE cd_aluno = $cd_aluno)";
	$cursoaluno = $conexao->consultar($curso);

	$profissao = $aluno[0]['nm_profissao'];
	//seleciona todos os trabalhos de autoria do aluno
	$consulta = "select cd_trabalho from autoria where cd_aluno = $cd_aluno";
	$trabalhosAluno = $conexao->consultar($consulta);
	//determina qual o trabalho de sua autoria com maior pontos de avaliação 	
	$cont = 0;
	foreach ($trabalhosAluno as $cadatrabalho) {
		$cont = $cont + 1;
		$comando = "select SUM(vl_voto) as soma from voto where cd_trabalho = {$cadatrabalho["cd_trabalho"]}";
		$notatrabalho = $conexao->consultar($comando);
		if($cont == 1)	{
				$maiornota = $notatrabalho;
				$trabalhodestaque = $cadatrabalho['cd_trabalho'];
		}
		else {
			if ($notatrabalho > $maiornota)	{
					$maiornota = $notatrabalho;
					$trabalhodestaque = $cadatrabalho['cd_trabalho'];
			}
		}
	}
	//havendo um trabalho em destaque são selecionados seus dados
	if(isset($trabalhodestaque))
	{
	$consulta =
			"SELECT
				 *
			FROM
				trabalho 
			WHERE
				cd_trabalho = $trabalhodestaque";

	$trabalhoTop = $conexao->consultar($consulta);
	}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina do Aluno</title>
   </head>
    <body>

    	<h1> Pagina do Aluno </h1>
    <p> Profissão/Curso: <?php if(isset($profissao)) { echo $profissao;} ?></p>
    <p> Aluno:<?php echo  $aluno[0]["nm_aluno"]; ?> </p>
    <!--<p> Escola: </p>-->
    <p> Sobre mim: <?php echo  $aluno[0]["tx_bio"];?></p>
    <h1> Monografia em destaque: </h1>
    <p> Titulo : <?php if(isset($trabalhoTop)) {echo $trabalhoTop[0]['nm_titulo'];} ?></p>

</body>
