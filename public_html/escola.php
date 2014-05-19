<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();

	$cd_usuario = $_GET['u'];
	//seleciona dados da tabela escola pelo codigo de usuario
	$comando = "SELECT * FROM escola WHERE cd_usuario = $cd_usuario";
	//dados estao no array escola
	$escola = $conexao->consultar($comando);
	
	//busca o nome da cidade pelo codigo da cidade	
	$comando = "SELECT nm_cidade FROM cidade WHERE cd_cidade = {$escola[0]["cd_cidade"]}";
	$cidade = $conexao->consultar($comando);

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de Escola</title>
   </head>
    <body>
    	<h1>Pagina de Instituicao</h1>
    	<p>Nome da Instituicao: <?php echo $escola[0]['nm_escola']; ?></p>
		<p>Sobre a instituicao: <?php if($escola[0]['tx_info'] == '') { echo "Aqui vao informacoes sobre a instituicao";} else { echo $escola[0]['tx_info'];}?></p>
    	<p>Localizacao da instituicao: <?php if($escola[0]['tx_endereco'] == ''){ echo "Aqui vai o endereco";} else { echo $escola[0]['tx_endereco'];}?> </p>
    	<p>Contato : 
    		<?php if($escola[0]['tx_contato'] == ''){ 
    			echo "Aqui vai o telefone, e-mail e site da instituicao";} 
    				else { echo $escola[0]['tx_contato'] ;}
    			if ($escola[0]["tx_url_externo"] != '') {
    				echo '</p><p><a href="http://'.$escola[0]["tx_url_externo"].'">Nossa pagina web</a>';
    			}
    	?></p>
    	
    	<p>Cursos oferecidos:</p>
    	<p>Corpo docente:</p>
    	<p>Monografias recentes:</p>
    	
    </body>


