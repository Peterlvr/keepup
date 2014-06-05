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
        al.nm_aluno 'nome', al.cd_usuario 'cdUser', al.cd_aluno 'cd', al.nm_url_avatar 'urlAvatar',
        c.nm_curso 'nmCurso'
    FROM
        autoria au, trabalho t, aluno al, curso c
    WHERE
        t.cd_trabalho = $cd_trabalho and
        au.cd_trabalho = t.cd_trabalho and
        au.cd_aluno = al.cd_aluno and
        t.cd_curso = c.cd_curso";
    
$autores = $conexao->consultar($comando);
$autorDoTrabalho = false;
$_SESSION['ultimoTrabalhoVisitado'] = $cd_trabalho;

foreach($autores as $autor)
	if($logado and $autor['cdUser'] == $_SESSION['cd_usuario'])
		$autorDoTrabalho = true;

$comentariosTrabalho = $conexao->consultar(
	"SELECT c.cd_autor, al.nm_aluno, al.nm_url_avatar, c.tx_comentario, c.dt_publicado
	FROM aluno al, comentario c
	WHERE c.cd_autor = al.cd_aluno AND c.cd_trabalho = $cd_trabalho
	ORDER BY c.dt_publicado DESC"
);

$relacionados = $conexao->consultar(
	"    SELECT * FROM trabalho t where cd_curso = {$trabalho[0]["cd_curso"]}
    order by rand() limit 3;"
);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $trabalho[0]['nm_titulo']; ?> - Keep Up</title>
	
    <link href="cs/style_monografia.css" type="text/css" rel="stylesheet">
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"> </script> 
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>

</head>

<body>

	<?php 
		include_once("header.php");
	?>
    
	 <section> 
    
    	<div id="bloco1_esquerda_resumo">
        
                <div id="imagem_monografia"> 
                    <?php if(isset($trabalho[0]["nm_img"])) { ?>
                        <img src="../../images/imagens_monografias/logo_tradeshop.jpg" class="imagem_monografia">
                    
        <?php } ?>
                </div>
        
        		<div id="bloco1_esquerda_titulo" style="height:auto"> 
                	<h1><?php echo $trabalho[0]['nm_titulo']; ?></h1> 
                </div>
                
                	<a href="#">
                <div id="bloco1_esquerda_favorito"> <script> 
                    $("#bloco1_esquerda_favorito").on("click", function() {
                        console.log("clicado");
                        $.post("php/favoritar.php", {trabalho: <?php echo $cd_trabalho; ?>})
                            .done(function(data) {
                                if(data == 1) {
                                    $("#bloco1_esquerda_favorito").css("background-color", "#1f4350");
                                }
                            });
                    });
            </script></div>
                	</a>
                
                	<a href="docs/<?php echo $cd_trabalho; ?>/main.pdf" target="_blank">
                <div id="bloco1_esquerda_baixar"> </div>
                	</a>
                    
                    <script>
					$().ready(function(){
						$("#bloco1_esquerda_favorito, #bloco1_esquerda_baixar").css("height",
							$("#bloco1_esquerda_titulo").height()+"px");
						});
					</script>
                    
                <div id="bloco1_esquerda_parte_escrita">
                	<h1> Resumo </h1>
                   <p><?php echo $trabalho[0]['ds_resumo'];?></p>                    
                    <div id="rodape_monografia">
                    	<table id="table_rodape">
                        	<tr>
                            <td> 
                            	<h1> Instituição de ensino </h1>
                                <p> <?php echo $escola[0]['nm_escola'];?> </p>
                            </td>
                            	<td> <h1> Curso: </h1> <p><?php echo $autores[0]['nmCurso'];?></p> </td>
                               
                                <td style="text-align:right;"> <h1> Ano de Publicação </h1> <p><?php echo $trabalho[0]['aa_publicacao']; ?></p></td>
                            </tr>	
                        </table>
                    </div>
                    
                </div>
                
                <div id="bloco1_esquerda_comentario">
                <?php if(!(!$logado or ($logado and $sessao['tipoConta'] == 'E'))) {

					if(isset($dados_aluno)) 
						{?>  
                	<table id="usuario_comentar">
                		<tr>
                        	
                        	<td class="foto"> <div id="foto_usuario_pracomentar" style="background-image:url(<?php
                           			if($_SESSION['url_avatar'] <> '') {
				echo "images/upload/{$sessao["cd_aluno"]}/{$_SESSION['url_avatar']}";
			}
			else {
				echo "images/default/usericon.png";
			}
			?>)"> </div> 
            </td>
                            <td class="comentar">
                            <h1> Escreva um comentário sobre o projeto: </h1>
                            	<form action='php/novoComentario.php' method='POST' id='novoComentarioForm'>
<textarea placeholder='Comente este trabalho...' name='campoComentario' id="txtEnviarComentario" rows='8' cols='60'></textarea>                                    <input id="btnEnviarComentario" type="submit" value="Enviar" />
                            	</form>
                            </td>
                        </tr>
                    </table>
					<?php }
 
    					} ?>

                </div>
                
                <div id="comentrarios_dos_outros">
                <?php foreach($comentariosTrabalho as $comentario) { ?>
                	<div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<?php if(!$comentario['nm_url_avatar']) { ?>
                                    	<img src="images/default/usericon.png" style="width:150px; height:150px">
                                        <?php } else { ?>
                                        <img src="<?php echo "images/upload/{$comentario['cd_autor']}/{$comentario['nm_url_avatar']}"; ?>" style="width:150px;height:150px">
                                        <?php } ?>
                                    </div>
                                </td>
                                <td style="width:100%;">
                                 <h1><?php echo $comentario['nm_aluno']; ?></h1>
                                 <h2><?php echo $comentario['dt_publicado']; ?></h2>
                                	<div class="texto_cada_comentario">
                                    	<p><?php echo $comentario['tx_comentario']; ?></p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                    </div>
                 <?php } ?>
                </div>
                
        </div>
        
        <div id="direita" style="height:auto">
            <!--            
            <div id="bloco2_palavra_chave">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts"> 
		                          <table>
                                  	<tr>
                                    	<td> <img src="../../images/index_icons/chave.png" style="margin-top:-20px" > </td>
                                  		<td> <h1> Palavras-Chave </h1> </td>
                                    </tr>
                                  </table>
                          </div>
                    </header>
            	<p> 
                	troca - 
					mercadorias -
                    consumo consciente
               </p>
            </div>
            -->
            <div id="bloco3_autores">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts"> 
		                          <table>
                                  	<tr>
                                    	<td> <img src="../../images/index_icons/autores.png"> </td>
                                  		<td> <h1> Autores </h1> </td>
                                    </tr>
                                  </table>
                          </div>
                    </header>
	<?php foreach ($autores as $autor) { ?>
        <a href='usuario.php?u=<?php echo $autor['cd']; ?>' style="color:black;">
           <table id="table_autores">
              <tr>
              <td style="width:80px">
                            	<div id="foto_usuario_monografia">
				<?php if($autor['urlAvatar'] <> '') { ?>
                    <img src="images/upload/<?php echo "{$autor['cdUser']}/{$autor['urlAvatar']}"; ?>" class="imagem_usuario"> 
                <?php }
                else { ?>
                    <img src="images/default/usericon.png" class="imagem_usuario">  
                <?php } ?>
                </div>
                </td>
                <td style="padding-left:10px"> 
				<?php
                	echo "<p>{$autor['nome']}</p>";
                ?>
                </td>
            </tr>
            </table>
        </a>
    <?php } ?>

			</div>
            
           <?php if(sizeof($relacionados) > 0) { ?> 
            <div id="bloco4_monografia_relacionada">
                    <header class="UltimosTrabalhos">
                              <div class="latest_posts"> 
                                  <table>
                                    <tr>
                                        <td> <img src="images/perfil_usuario/monografias.png" width="30"> </td>
                                        <td> <h1> Monografias relacionadas </h1> </td>
                                    </tr>
                                  </table>
                              </div>
                        </header>
                        
                    <a href="#">
                        <div id="cada_monografia_relacionada">
                            <div class="imagem_monografia_relacionada"> 
                                <img src="../../images/imagens_monografias/logo5.png" class="imagem_relacionada">
                            </div>
                            <footer class="titulo_relacionada"> <h1> Checkpoint Social </h1>  </footer>
                        </div>
                    </a>
                </div>
            </div>	
           <?php } ?>
    </section>
    
    <?php 
		include_once("footer.php");
	?>
</body>
</html>