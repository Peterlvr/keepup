<?php
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();	

$cd_trabalho = $_GET['t'];

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

$comando =
    "SELECT
        a.nm_aluno 'nome', a.cd_aluno 'cd', a.nm_url_avatar 'urlAvatar'
    FROM 
        autoria au, aluno a, trabalho t
    WHERE
        au.cd_trabalho = $cd_trabalho and
        a.cd_aluno = au.cd_aluno";

$autores = $conexao->consultar($comando);

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
                echo "<a href='usuario.php?u={$autor["cd"]}'>{$autor['nome']}</a><br/>";
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