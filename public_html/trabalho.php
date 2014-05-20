<?php
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();	

$cd_trabalho = $_GET['u'];

$comando = "SELECT * FROM trabalho WHERE cd_trabalho = $cd_trabalho";
$trabalho = $conexao->consultar($comando);

$cd_escola = $trabalho[0]['cd_escola'];

$comando = "SELECT nm_escola FROM escola WHERE cd_escola = $cd_escola";
$escola = $conexao->consultar($comando);

if($logado and isset($_SESSION["cd_aluno"])) {
	$codigo_aluno = $_SESSION["cd_aluno"];

	$comando = "SELECT * FROM aluno WHERE cd_aluno = $codigo_aluno";
	$dados_aluno = $conexao->consultar($comando);	
}

$comando = "SELECT 
                a.cd_aluno, l.nm_aluno, l.nm_url_avatar 
            FROM 
                autoria a, aluno l 
            WHERE 
                cd_trabalho = $cd_trabalho 
                and
                a.cd_aluno = l.cd_aluno";

$autores = $conexao->consultar($comando);
 
//buscar o nm_login da tabela usuario por cd_usuario de cada autor
/*$rows = mysql_num_rows($autores);
for($x=0; $x<=$rows; $x++)
$comando = "SELECT 
                nm_login 
            FROM 
                usuario 
            WHERE 
                cd_usuario = 
            (SELECT cd_usuario FROM aluno WHERE cd_aluno = {$autores[$x]['cd_aluno']})"; */

$loginautores = $conexao->consultar($comando);

$nm_login = $loginautores[0]['nm_login'];
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de Trabalho</title>
   </head>
    <body>
        <?php include("header.php");?>
    	<h1>Pagina de Trabalho</h1>
		
		<p>Titulo do trabalho: <?php echo $trabalho[0]['nm_titulo']; ?></p>
        <p><a href="docs/<?php echo $cd_trabalho; ?>/main.pdf">Clique baixar ler o trabalho completo</a></p>

    	<p>Resumo: <?php echo $trabalho[0]['ds_resumo'];?></p>

    	
    	<p>Area: </p>
    	<p>Avaliacao: </p>
    	<p>Palavras-chave: </p>
    	<p>Autores: <?php 
           foreach ($autores as $autor) {
                echo "<a href='usuario.php?u=$nm_login'>".$autor['nm_aluno']."</a><br/>";
                }
        ?></p>
    	<p>Instituicao: <?php echo $escola[0]['nm_escola'];?></p>
    	<h1>Comentarios</h2>
    	<p>/Nome do aluno/FOTO do aluno: 
    		<?php if($logado and isset($_SESSION['cd_escola'])) 
    				{ echo "Escola não pode comentar";} 
    				else if(isset($dados_aluno)) 
    				{ echo $dados_aluno[0]['nm_aluno'];} 
    					else 
    					{ echo "Tu nao podes comentar. Pois, não estás logado.";}?></p>
    	<p></p>
    	<p></p>

    	<?php include "footer.php"; ?>
    </body>
    </html>