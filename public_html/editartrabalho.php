<?php
require "../sessao.php";
require "../conexao.class.php";
$conexao = new Conexao;

if(!$logado) {
    header("location:./");
    die();
}

if(!isset($_GET['t']) or !(int) $_GET["t"]) {
    ?> 
    <!doctype html>
    <title>Keep Up</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" rel="stylesheet" type="text/css">
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"> </script>
    <?php
    include "header.php";
    echo "<h1>Trabalho não encontrado!</h1>";
    die();
}

$cd_trabalho = $_GET['t'];

$comando = "SELECT * FROM trabalho WHERE cd_trabalho = $cd_trabalho";
$trabalho = $conexao->consultar($comando);

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

if($sessao["tipoConta"] == "A") {
    foreach($autores as $autor) {
        if($autor['cdUser'] == $sessao['cd'])
            $autorDoTrabalho = true;
    }
}
else {
    if($trabalho["cd_escola"] == $sessao["cd"])
        $autorDoTrabalho = true;
}

if(!$autorDoTrabalho) {
    ?> 
    <!doctype html>
    <title>Keep Up</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700" rel="stylesheet" type="text/css">
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"> </script>
    <?php
    include "header.php";
    echo "<h1>Você não pode editar este trabalho!</h1>";
    die();
}

$comentariosTrabalho = $conexao->consultar(
    "SELECT c.cd_autor, al.nm_aluno, al.nm_url_avatar, c.tx_comentario, c.dt_publicado, c.cd_comentario
    FROM aluno al, comentario c
    WHERE c.cd_autor = al.cd_aluno AND c.cd_trabalho = $cd_trabalho
    ORDER BY c.dt_publicado DESC"
);

$sessao["cursos"] = $conexao->consultar(
    "SELECT nm_curso, cd_curso
    from curso");


$sessao["escolas"] = $conexao->consultar(
    "SELECT nm_escola, cd_escola
    from escola");


$relacionados = $conexao->consultar(
    "SELECT * FROM trabalho t where cd_curso = {$trabalho[0]["cd_curso"]}
    order by rand() limit 3;"
);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar trabalho</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<link href="cs/style_monografia.css" type="text/css" rel="stylesheet">
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"> </script> 
</head>

<body>
    <?php include "header.php"; ?>
	<section> 
    	<div id="bloco1_esquerda_resumo">
                <div id="imagem_monografia"> 
                    <?php if(isset($trabalho[0]["nm_img"])) { ?>
                        <img src="images/imagens_monografias/<?php echo "{$trabalho[0]["cd_trabalho"]}/{$trabalho[0]["nm_img"]}"; ?>" class="imagem_monografia">
                    <?php } ?>
                </div>
        		<div id="bloco1_esquerda_titulo"> 
                	<h1><?php echo $trabalho[0]["nm_titulo"]; ?></h1> 
                </div>
                
                    
                <div id="bloco1_esquerda_parte_escrita"> 
                   <form>
                   		<table id="table_publicar_1" style="width:100%">
                      		<Tr>
                            	<td> 
                                	<h1> Alterar imagem de capa </h1>
                                	<div id="inputFile"  class="imagem_monografia"
                                    style="background-image:url(images/imagens_monografias/logo_tradeshop.jpg); background-position:center; border:1px solid rgba(51,51,51,.2); background-repeat:no-repeat;">                                    	
                                    	<input type="file" name="arquivo" id="arquivo" /> 
                                    </div>                                </td>
                            </Tr>
                        	<tr>
                            	<td>
                              		<h1>Título</h1>
                                    <input required id="nmTitulo" class="txtTituloMonografia" type="text" value="<?php echo $trabalho[0]["nm_titulo"]; ?>">
                                </td>
                            </tr>
                            <tr>
                            	<td>
                              		<h1>Resumo</h1>
                                    <textarea rows="15" class="txtTituloMonografia" required id="dsResumo"><?php echo $trabalho[0]["ds_resumo"]; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                              		<h1>Curso</h1>
                                    <select name="cdCurso">
                                        <?php foreach($sessao["cursos"] as $curso) { ?>
                                            <option value="<?php echo $curso["cd_curso"]; ?>" <?php if($curso["cd_curso"] == $trabalho[0]["cd_curso"]) echo "selected"; ?>>
                                                <?php echo $curso["nm_curso"]; ?>
                                            </option>
                                        <?php } ?>
                                        <!--option value="outro">Outro...</option-->
                                    </select>
                                </td>
                            </tr>
                            <Tr>
                            	<Td>
                                    <h1>
                                        <label for="tx_pchaves">Palavras-chave <small>(mínimo 3; separadas por ponto)</small>:</label>
                                    </h1>
                                    <input required class="txtTituloMonografia" type="text" value="<?php echo $trabalho[0]["tx_pchave"]; ?>" name="tx_pchaves" pattern="^[^\.]+\.[^\.]+\.[^\.]+$">
                                </Td>
                            </Tr>
                            <!--Tr>
                            	<td> 
                                	<h1>Instituição de ensino</h1>
                                    <input type="text" id="txtTituloMonografia"> 
                                </td>
                            </Tr-->
                        	<tr>
                            	<Td colspan="2" style="text-align:center;">
                                	  <input id="btnSalvar" type="submit" value="Salvar alterações">
                                      <input id="btnCancelar" type="button" value="Cancelar">
                                </Td>
                            </tr>                        
                        </table>
                        
                   </form>
                    
                
                    
                </div>

                
                <div id="bloco1_esquerda_comentario">

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
                                       <?php if($logado and $autorDoTrabalho == true) { ?>
                                            <div id='excluir_comentario'>
                                            <form action='php/excluirComentario.php' method='POST' id='excluirComentarioForm'>
                                                <input type='hidden' name='comentarioExcluido' value='<?php echo $comentario["cd_comentario"]; ?>'>
                                                <input type='image' src='images/pencil.png'>
                                            </form> </div>
                                       <?php }  ?> 
                                       <p><?php echo $comentario['tx_comentario']; 
                                        ?></p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                 <?php } ?>
                    
                </div>
                
        </div>
        
        <div id="direita" style="height:auto">
                        
            <div id="bloco2_palavra_chave">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts"> 
		                          <table>
                                  	<tr>
                                    	<td> <img src="images/index_icons/chave.png" style="margin-top:-20px" > </td>
                                  		<td> <h1> Palavras-Chave </h1> </td>
                                    </tr>
                                  </table>
                          </div>
                    </header>
            	<p><?php echo $trabalho[0]["tx_pchave"]; ?></p>
            </div>
            
            <div id="bloco3_autores">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts"> 
		                          <table>
                                  	<tr>
                                    	<td> <img src="images/index_icons/autores.png"> </td>
                                  		<td> <h1> Autores </h1> </td>
                                    </tr>
                                  </table>
                          </div>
                    </header>
            	
    <?php foreach ($autores as $autor) { ?>
        <a href='usuario.php?u=<?php echo $autor['cdUser']; ?>' style="color:black;">
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
                          <div class="latest_posts" style="margin-left:-2%;"> 
                              <table>
                                <tr>
                                    <td> <img src="images/perfil_usuario/monografias.png" width="30"> </td>
                                    <td> <h1 style="font-size:.9em"> Monografias relacionadas </h1> </td>
                                </tr>
                              </table>
                          </div>
                    </header>
                    <?php foreach ($relacionados as $trabalhoRelacionado) {
                    if($trabalhoRelacionado['cd_trabalho'] <> $cd_trabalho){   ?>
                    <a href="trabalho.php?t=<?php echo $trabalhoRelacionado['cd_trabalho'];?>">
                        <div id="cada_monografia_relacionada">
                            <div class="imagem_monografia_relacionada"> 
                                <img src="images/imagens_monografias/img_vis.jpg" class="imagem_relacionada">
                            </div>
                            <footer class="titulo_relacionada"> <h1> <?php echo substr($trabalhoRelacionado['nm_titulo'], 0, 75);?></h1>  </footer>
                        </div>
                    </a>
                    <?php }}?>
                </div>
            </div>  
           <?php } ?>

    </section>
    
    <?php include_once("footer.php") ?>

</body>
</html>