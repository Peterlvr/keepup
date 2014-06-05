<?php # Visão 'index'
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
if($logado) {
	$cdUsuario = $sessao["cd_usuario"];
	$codigoPerfil = $_SESSION["cd_aluno"];
	$consulta =
		"SELECT
			t.nm_titulo 'titulo',
			t.ds_resumo 'resumo',
			t.cd_trabalho 'cd'
		FROM
			trabalho t, autoria a
		WHERE
			t.cd_trabalho = a.cd_trabalho and 
			a.cd_aluno = $codigoPerfil
		ORDER BY
			t.dt_publicado DESC
		LIMIT 3";
	$sessao["trabalhosUsuario"] = $conexao->consultar($consulta);

	$favsql = 
		"SELECT
			t.nm_titulo 'nm_titulo',
			t.ds_resumo 'ds_resumo',
			t.cd_trabalho 'cd'
		FROM
			trabalho t, favorito f
		WHERE
			t.cd_trabalho = f.cd_trabalho and
			f.cd_aluno = {$sessao["cd_aluno"]}
		ORDER BY
			f.dt_favoritado DESC
		LIMIT 3";
	$sessao["favoritos"] = $conexao->consultar($favsql);
}
$consulta =
	"SELECT 
		t.nm_titulo,
		c.nm_curso,
		t.ds_resumo,
		t.cd_trabalho
	FROM
		trabalho t, curso c
	WHERE
		t.cd_curso = c.cd_curso
	ORDER BY
		t.dt_publicado DESC
	LIMIT 3";

$sessao["trabalhosRecentes"] = $conexao->consultar($consulta);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bem-Vindo ao Keep Up</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<link href="cs/estilo_index.css" rel="stylesheet" type="text/css" />
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/slides.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
</head>
	
<body>
<?php include "header.php"; ?>
         
    
    				<div id='video_background'>
                    	<div class="slide" id="slide1">
						   <h1> e1 </h1>
                       </div>
                        <div class="slide" id="slide2">
                          </div>
                        <div class="slide" id="slide3">
                           <h1> 3</h1>
                       </div>
                        <div class="slide" id="slide4">
                           <h1> 4</h1>
                       </div>
                        <div class="slide" id="slide5">
                           <h1> 5 </h1>
                       </div>
                       <script>
					   $().ready(function() {
						   $.slides("slide", 5);
					   });
					   </script>
                    </div>

                    
    <Section>             
        <div id="vantagens">

                <div class="vantagens">
                    <div class="icones" id="i1"> </div>
                    	<h1> Elabore </h1>
                        <p>
                        Produza seus projetos, finalize-os com o auxílio dos nossos guias e publique-os
                        </p>
		</div>
        
                <div class="vantagens">
                    <div class="icones" id="i2"> </div>
                    <h1> Apresente-se </h1>
                        <p>
						Exponha a competência de seus trabalhos e seja reconhecido
                        </p>
                </div>

                <div class="vantagens">
                    <div class="icones" id="i3"> </div>
                    <h1> Responsivo </h1>
                        <p>
                        Visualize seu perfil, dados e projetos em qualquer resolução ou periférico
                        </p>
                </div>
                
                <div class="vantagens">
                    <div class="icones" id="i4"> </div>
                    <h1> Divulgue </h1>
                        <p>
                       Dê um "UP" na sua vida profissional ganhando visibilidade com seus projetos
                        </p>
                </div>
        </div>
        
					<?php if(isset($sessao["trabalhosUsuario"]) && sizeof($sessao["trabalhosUsuario"]) > 0) { ?>
        
           <!-- Meus trabalhos -->
        <div id="trabalhos">
        	<div class="UltimosTrabalhos">
            	<a href="#">
                    <div class="latest_posts"> <h1>Meus trabalhos</h1> </div>
                </a>
            </div>
            
            <article class="links_trabalhos">
                    
    			<?php foreach($sessao["trabalhosUsuario"] as $trabalho) { ?>
                <a href="trabalho.php?t=<?php echo $trabalho["cd"]; ?>">
                    <div class="box_monografia" id="fav1">
                         <div class="each_titulo_area">
                            <div class="each_titulo"> <h1> <?php echo $trabalho["titulo"]; ?> </h1> </div>
                        </div>
                    
                        <div class="each_icon">
                            <img src="images/<?php echo $trabalho["url_imagem"]; ?>" class="imagens_index">
                        </div>

                        <div class="each_resumo"> 
                            <p> <?php echo $trabalho["resumo"]; ?></p>
                        </div>
                        
                        <div class="each_autor_curso"> 
                            <h1>                        
                           
                            Informática para Internet 
                            
                            </h1>
                        </div>
                        
                    </div>
                </a>
             <?php  } ?>
            </article>
      	</div>
        <?php } ?>
					<?php if(isset($sessao["favoritos"]) && sizeof($sessao["favoritos"]) > 0) { ?>
             
        <!-- Favoritos -->
        <div id="trabalhos">
        	<div class="UltimosTrabalhos">
            	<a href="#">
                    <div class="latest_posts"> <h1>  <img src="images/index_icons/star.png" style="float:left; margin-right:5px;">Favoritos </h1> </div>
                </a>
            </div>
            
            <article class="links_trabalhos">
                   
							<?php foreach($sessao["favoritos"] as $trabaho) { ?>
                            <a href="trabalho.php?t=<?php echo $trabaho["cd_trabalho"]; ?>">
                                <div class="box_monografia" id="fav1">
                                     <div class="each_titulo_area">
                                        <div class="each_titulo"> <h1> <?php echo $trabalho["nm_titulo"]; ?> </h1> </div>
                                    </div>
                                
                                    <div class="each_icon">
                                        <img src="images/<?php echo $trabaho["url_imagem"]; ?>" class="imagens_index">
                                    </div>
                
                                    <div class="each_resumo"> 
                                        <p> <?php echo $trabaho["ds_resumo"]; ?></p>
                                    </div>
                                    
                                    <div class="each_autor_curso"> 
                                        <h1>                        
                                       
                                        Informática para Internet 
                                        
                                        </h1>
                                    </div>
                                    
                                </div>
                                </a>
             <?php  } ?> 
            </article>
      	</div>
        <?php } ?>
	<!-- Monografias -->
        <div id="trabalhos">
        	<div class="UltimosTrabalhos">
            	<div class="latest_posts"> <h1> Últimos Trabalhos </h1> </div>
            </div>
            <?php if(isset($sessao["trabalhosRecentes"]) && sizeof($sessao["trabalhosRecentes"]) > 0) { ?>
            <article class="links_trabalhos">
            	<?php foreach($sessao["trabalhosRecentes"] as $trabalho) { ?>
                <a href="trabalho.php?t=<?php echo $trabalho["cd_trabalho"]; ?>">
                <div class="box_monografia" id="ult1">
                	<div class="each_titulo_area">
                        <div class="each_titulo"> <h1><?php echo $trabalho["nm_titulo"]; ?></h1> </div>
                    </div>
                
                	<div class="each_icon">
                    	<img src="images/<?php echo $trabalho["url_imagem"]; ?>" class="imagens_index">
                    </div>
                    
                    <div class="each_resumo"> 
                    	<p><?php echo $trabalho["ds_resumo"]; ?>
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                    	<h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                    </div>
                </a>
                    <?php } ?>
                </div>
                <?php }
				else { ?>
					<p>Nenhum trabalho recente</p>
				<?php } ?>
            </article>
      	</div>
    </Section>
    
    <footer>
            <div id="footer_centralizado">
                <p> 
                <a href="#"> Mapa do site </a> |
                <a href="#"> Termos de uso </a> | 
                <a href="#"> Política de privacidade </a> | 
                <a href="#"> Desenvolvedores  </a>
                </p>
            		<h5> © 2014 Keep Up - Todos os direitos reservados. </h5>
            </div>   
        </footer>

</body>
</html>