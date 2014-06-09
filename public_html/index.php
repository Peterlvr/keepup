<?php # Visão 'index'
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
if($logado) {
	$cdUsuario = $sessao["cd_usuario"];
    if($sessao["tipoConta"] == "A") {
    	$codigoPerfil = $_SESSION["cd_aluno"];
    	$consulta =
    		"SELECT
    			t.nm_titulo 'titulo',
    			t.ds_resumo 'resumo',
    			t.cd_trabalho 'cd',
                c.nm_curso 'nm_curso'
    		FROM
    			trabalho t, autoria a, curso c
    		WHERE
    			t.cd_trabalho = a.cd_trabalho and 
    			a.cd_aluno = $codigoPerfil and
                c.cd_curso = t.cd_curso
    		ORDER BY
    			t.dt_publicado DESC
    		LIMIT 3";
    }
    else if($sessao["tipoConta"] == "E") {
        $codigoPerfil = $_SESSION["cd_escola"];
        $consulta =
            "SELECT
                t.nm_titulo 'titulo',
                t.ds_resumo 'resumo',
                t.cd_trabalho 'cd',
                c.nm_curso 'nm_curso'
            FROM
                trabalho t, curso c
            WHERE
                t.cd_escola = $codigoPerfil and
                t.cd_curso = c.cd_curso
            ORDER BY
                t.dt_publicado DESC
            LIMIT 3";
    }
	$sessao["trabalhosUsuario"] = $conexao->consultar($consulta);

    if($sessao["tipoConta"] == "A") {
    	$favsql = 
    		"SELECT
    			t.*,
                c.nm_curso
    		FROM
    			trabalho t, favorito f, curso c
    		WHERE
    			t.cd_trabalho = f.cd_trabalho and
    			f.cd_aluno = {$sessao["cd_aluno"]} and
                t.cd_curso = c.cd_curso
    		ORDER BY
    			f.dt_favoritado DESC
    		LIMIT 3";
    	$sessao["favoritos"] = $conexao->consultar($favsql);
    }
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

$maisVotadosConsulta =
    "SELECT avg(v.vl_voto), t.*, c.nm_curso FROM curso c, trabalho t, voto v WHERE
    v.cd_trabalho = t.cd_trabalho and c.cd_curso = t.cd_curso GROUP BY t.cd_trabalho
    LIMIT 3";

$sessao["melhores"] = $conexao->consultar($maisVotadosConsulta);
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
                       	</div>
                        
                        <div class="slide" id="slide2">
                        </div>
                        
                        <div class="slide" id="slide3">
    	                </div>
                    </div>
                       <script>
					   $().ready(function() {
						   $.slides("slide", 3);
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
                    <h1> Pesquise </h1>
                        <p>
                       Encontre trabalhos do seu interesse, comente e mantenha-os como favoritos
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
        
        <div id="trabalhos">
            <div class="UltimosTrabalhos">
                <div class="latest_posts"> <h1> Melhores trabalhos </h1> </div>
            </div>
            <?php if(isset($sessao["melhores"]) && sizeof($sessao["melhores"]) > 0) { ?>
            <article class="links_trabalhos">
                <?php foreach($sessao["melhores"] as $trabalho) { ?>
                <a href="trabalho.php?t=<?php echo $trabalho["cd_trabalho"]; ?>">
                <div class="box_monografia" id="ult1">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1><?php echo $trabalho["nm_titulo"]; ?></h1> </div>
                    </div>
                
                    <div class="each_icon">
                        <img src="images/<?php if(isset($trabalho["url_imagem"]) and strlen($trabalho["url_imagem"]) > 3) echo $trabalho["url_imagem"]; else echo "imagens_monografias/img_vis.jpg"; ?>" class="imagens_index">
                    </div>
                    
                    <div class="each_resumo"> 
                        <p><?php echo $trabalho["ds_resumo"]; ?>
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <?php echo $trabalho["nm_curso"]; ?> 
                        
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
                            <img src="images/<?php if(isset($trabalho["url_imagem"]) and strlen($trabalho["url_imagem"]) > 3) echo $trabalho["url_imagem"]; else echo "imagens_monografias/img_vis.jpg"; ?>" class="imagens_index">
                        </div>

                        <div class="each_resumo"> 
                            <p> <?php echo $trabalho["resumo"]; ?></p>
                        </div>
                        
                        <div class="each_autor_curso"> 
                            <h1><?php echo $trabalho["nm_curso"]; ?></h1>
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
                        <div class="each_titulo"> <h1> <?php echo $trabaho["nm_titulo"]; ?> </h1> </div>
                    </div>
                
                    <div class="each_icon">
                        <img src="images/<?php if(isset($trabaho["url_imagem"]) and strlen($trabaho["url_imagem"]) > 3) echo $trabaho["url_imagem"]; else echo "imagens_monografias/img_vis.jpg"; ?>" class="imagens_index">
                    </div>

                    <div class="each_resumo"> 
                        <p> <?php echo $trabaho["ds_resumo"]; ?></p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                        <?php echo $trabaho["nm_curso"]; ?> 
                        
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
                    	<img src="images/<?php if(isset($trabalho["url_imagem"]) and strlen($trabalho["url_imagem"]) > 3) echo $trabalho["url_imagem"]; else echo "imagens_monografias/img_vis.jpg"; ?>" class="imagens_index">
                    </div>
                    
                    <div class="each_resumo"> 
                    	<p><?php echo $trabalho["ds_resumo"]; ?>
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                    	<h1>                        
                       
                       <?php echo $trabalho["nm_curso"]; ?> 
                        
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
    
   <?php include_once("footer.php") ?>

</body>
</html>
