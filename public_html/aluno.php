<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	

	//através do GET, tira da url o nm-login
	$nm_login = $_GET['u'];
	$usuario = "SELECT cd_usuario FROM usuario WHERE nm_login = '$nm_login'";
	$pageuser = $conexao->consultar($usuario);
	//seleciona dados da tabela aluno pelo codigo de usuario
	$comando = "SELECT * FROM aluno WHERE cd_usuario = {$pageuser[0]['cd_usuario']}";
	$aluno = $conexao->consultar($comando);
	//cria variavel contendo o codigo do aluno
	$cd_aluno = $aluno[0]["cd_aluno"];
	//seleciona o nome do curso da tabela curso caso o aluno tenha um curso registrado
	$curso = "SELECT nm_curso FROM curso WHERE cd_curso = (SELECT cd_curso FROM cursando WHERE cd_aluno = $cd_aluno)";
	$cursoaluno = $conexao->consultar($curso);

	$profissao = $aluno[0]['nm_profissao'];

	$matricula = $conexao->consultar("SELECT e.nm_escola FROM escola e, matricula m, aluno al 
		WHERE al.cd_aluno = m.cd_aluno AND e.cd_escola = m.cd_escola AND al.cd_aluno = $cd_aluno");
	//seleciona todos os trabalhos de autoria do aluno
	$consulta = "SELECT cd_trabalho FROM autoria WHERE cd_aluno = $cd_aluno";
	$trabalhosAluno = $conexao->consultar($consulta);
	//determina qual o trabalho de sua autoria com maior pontos de avaliação 	
	$cont = 0;
	foreach ($trabalhosAluno as $cadatrabalho) {
		$cont = $cont + 1;
		$comando = "SELECT SUM(vl_voto) AS soma FROM voto WHERE cd_trabalho = {$cadatrabalho["cd_trabalho"]}";
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
			"SELECT * FROM trabalho 
			WHERE cd_trabalho = $trabalhodestaque";

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
    	<?php include("header.php"); ?>
    	<h2> Pagina do Aluno </h2>

   	<p><?php if($aluno[0]['nm_url_avatar'] <> '')
			echo '<img id="fotoUsuario" src="images/upload/'.$pageuser[0]["cd_usuario"]."/".$aluno[0]['nm_url_avatar'].'" style="width: 200px; height:200px;">';
		?></p>
    <p> Profissão: <?php if(isset($profissao)) { echo $profissao;} ?></p>
    <p> Aluno:<?php echo  $aluno[0]["nm_aluno"]; ?> </p>
    <p> Escola:  <?php if($matricula != false) { echo $matricula[0]['nm_escola'];}?> </p>
    <p> Sobre mim: <?php echo  $aluno[0]["tx_bio"];?></p>

    <p>Contato: <br/> 
    	Facebook: <?php if($aluno[0]['nm_fb'] != "") {echo "www.facebook.com/".$aluno[0]['nm_fb']."<br/>";} 
    	else { echo "Preencha esse campo.<br/>";} ?>  
    	Linkedin: <?php if($aluno[0]['tx_url_linkedin'] != "") {echo "".$aluno[0]['tx_url_linkedin']."<br/>";} 
    	else { echo "Preencha esse campo.<br/>";} ?> 
    	Url externo: <?php if($aluno[0]['tx_url_externo'] != "" ) { echo "".$aluno[0]['tx_url_externo'];}
    	else { echo "Preencha esse campo.<br/>";} ?> </p>

    <p>Monografias relacionadas</p>
<?php if(isset($trabalhoTop)) { ?>
    <h2> Monografia em destaque: </h2>
    <p> Titulo : <?php echo $trabalhoTop[0]['nm_titulo']; ?> </p>
    <p> Resumo: <?php $resumo = substr($trabalhoTop[0]['ds_resumo'], 0, 450);

    	echo $resumo."..."; ?> </p>
    <p> Avaliacao: <?php ?> </p>
    <p> Curso: <?php 
    	$nomeCurso = $conexao->consultar("SELECT c.nm_curso 
    	FROM trabalho t, curso c WHERE t.cd_trabalho = {$trabalhoTop[0]['cd_trabalho']} 
    	AND t.cd_curso = c.cd_curso");
    	echo $nomeCurso[0]['nm_curso'];
    	?> </p>
    <p> Instituicao: <?php  
    	$nomeInstituicao = $conexao->consultar("SELECT nm_escola 
    	FROM escola WHERE cd_escola = {$trabalhoTop[0]['cd_escola']}");
    	echo $nomeInstituicao[0]['nm_escola'];
    	?> </p>
    <p> Data de publicação: <?php 
    $dataPublicado = explode(" ", $trabalhoTop[0]['dt_publicado']); 
    echo $dataPublicado[0];?></p>
<?php } ?>
		<?php include 'footer.php'; ?>
	</body>
</html>