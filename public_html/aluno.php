<?php 
#error_reporting(E_ALL);
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();
	
if(isset($_GET["u"])) {
	//através do GET, tira da url o nm-login
	$nm_login = $_GET['u'];
	$usuario = "SELECT cd_usuario, CONVERT(ic_desativado, SIGNED) 'ic_desativado' FROM usuario WHERE nm_login = '$nm_login'";
	$pageuser = $conexao->consultar($usuario);
    if(sizeof($pageuser) != 0 and $pageuser[0]["ic_desativado"] != 1) { 
    	//seleciona dados da tabela aluno pelo codigo de usuario
    	$comando = "SELECT * FROM aluno WHERE cd_usuario = {$pageuser[0]['cd_usuario']}";
    	$aluno = $conexao->consultar($comando);
    	//cria variavel contendo o codigo do aluno
    	$cd_aluno = $aluno[0]["cd_aluno"];
    	//seleciona o nome do curso da tabela curso caso o aluno tenha um curso registrado
    	$curso = "SELECT c.nm_curso
            FROM curso c, cursando cu
            WHERE cu.cd_curso = c.cd_curso and cu.cd_aluno = $cd_aluno";
    	$cursoaluno = $conexao->consultar($curso);

    	$profissao = $aluno[0]['nm_profissao'];

    	$matricula = $conexao->consultar(
            "SELECT e.nm_escola , u.nm_login 'login_escola'
            FROM escola e, matricula m , usuario u
    		WHERE
                u.cd_usuario = e.cd_usuario and
                e.cd_escola = m.cd_escola AND
                m.cd_aluno = $cd_aluno");
    	//seleciona todos os trabalhos de autoria do aluno
    	$consulta = "SELECT t.* FROM autoria a, trabalho t WHERE a.cd_aluno = $cd_aluno and t.cd_trabalho = a.cd_trabalho";
    	$trabalhosAluno = $conexao->consultar($consulta);

        $consultaFav = "SELECT t.* FROM favorito f, trabalho t WHERE f.cd_aluno = $cd_aluno and t.cd_trabalho = f.cd_trabalho";
        $favoritosAluno = $conexao->consultar($consultaFav);
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
         $nomeCurso = $conexao->consultar("SELECT c.nm_curso 
                FROM trabalho t, curso c WHERE t.cd_trabalho = {$trabalhoTop[0]['cd_trabalho']} 
                AND t.cd_curso = c.cd_curso");
          $nomeInstituicao = $conexao->consultar("SELECT nm_escola 
            FROM escola WHERE cd_escola = {$trabalhoTop[0]['cd_escola']}");

        	}

          $cursosquery = 
            "SELECT c.*
            FROM curso c, cursando cu
            WHERE
                cu.cd_curso = c.cd_curso and
                cu.cd_aluno = {$aluno[0]["cd_aluno"]}";
          $cursosAluno = $conexao->consultar($cursosquery);

        $relacionadas = "SELECT t.* FROM trabalho t, curso c WHERE t.cd_curso = c.cd_curso and (";
        $i = 1;
        $ncursos = sizeof($cursosAluno);
        foreach($cursosAluno as $curso) {
            $relacionadas .= "t.cd_curso = {$curso["cd_curso"]}";
            if($i< $ncursos) {
                $relacionadas .= " OR ";
            }
            $i++;
        }
        $relacionadas .= ") ORDER BY rand() LIMIT 3";
        $relacionados = $conexao->consultar($relacionadas);
    }
    else {
        $inexistente = true;
    }
}
else $inexistente = true;
   ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php if(isset($aluno[0]["nm_aluno"])) echo "{$aluno[0]["nm_aluno"]} - "; ?>Keep Up</title>
<link href="cs/global.css" type="text/css" rel="stylesheet">
<link href="cs/estilo_user.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"> </script>	
<script src="js/script.js" type="text/javascript"> </script>
</head>

<body>
<?php include "header.php"; ?>
     <?php if(isset($inexistente)) { ?>
        <h1>Conta não encontrada!</h1>
     <?php die(); } ?>
     <div id="usuario"> 
    	 <div id="lado_left"> 
            <div id="foto_perfil_usuario" style="background-image:url(<?php if($aluno[0]['nm_url_avatar'] <> '')
			echo 'images/upload/'.$pageuser[0]["cd_usuario"]."/".$aluno[0]['nm_url_avatar'];
		else 
			echo 'images/default/usericon.png';
		?>)"> </div>
            
            <div id="dados_usuario">
                <div id="texto_dados">
                    <h3> Estudante </h3>
                    <h1><?php echo  $aluno[0]["nm_aluno"]; ?></h1>
                    <h2><?php foreach($matricula as $matriculado) echo "<a href=\"escola.php?u={$matriculado["login_escola"]}\">{$matriculado["nm_escola"]}</a><br>"; ?></h2>
                </div>
                
                <div id="icones_dados"> 
                <a href="?ver=perfil&amp;u=<?php echo $nm_login; ?>">	<div class="bot_perfil" id="profile" <?php if(!isset($_GET["ver"]) or $_GET["ver"] == "perfil"){ ?>style="border-bottom:5px solid #2c87af" <?php } ?>> </div> </a>
                <a href="?ver=trabalhos&amp;u=<?php echo $nm_login; ?>">    <div class="bot_perfil" id="monografias" <?php if(isset($_GET["ver"]) and $_GET["ver"] == "trabalhos"){ ?>style="border-bottom:5px solid #2c87af" <?php } ?>> </div> </a>
                <a href="?ver=favoritos&amp;u=<?php echo $nm_login; ?>" >    <div class="bot_perfil" id="favoritos" <?php if(isset($_GET["ver"]) and $_GET["ver"] == "favoritos"){ ?>style="border-bottom:5px solid #2c87af" <?php } ?>> </div> </a>
                </div>
            </div>
		</div>
        
        
        <div id="lado_right">
        	<div id="contato">
            	<header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts" style="margin:-10px auto auto 5%;"> <h1>  Contato </h1> </div>
                </header>
                <table style="background-color:white; margin:auto;">
                	<tr>
                    	<td> <img src="images/face.png" width="30"></td>
                        <td style="text-align:left;"> <?php if($aluno[0]['nm_fb'] != "") {echo "/".$aluno[0]['nm_fb'];} 
    	else { echo "Não informado.";} ?> </td>
                    </tr>
                    <tr>
                    	<td> <img src="images/linkedin.png" width="20"> </td>
                        <td style="text-align:left;"> <?php if($aluno[0]['tx_url_linkedin'] != "") {echo "".$aluno[0]['tx_url_linkedin'];} 
    	else { echo "Não informado.";} ?> </td>
                    </tr>
                    <tr>
                    	<td><img src="images/url.png" width="25"></td>
                        <td style="text-align:left;"> <?php if($aluno[0]['tx_url_externo'] != "" ) { echo "".$aluno[0]['tx_url_externo'];}
    	else { echo "Não informado.";} ?></td>
                    </tr>
                </table>
            </div>
        </div>
   </div>   
     <section id="descricao_usuario"> 

        <?php if (isset($_GET["ver"]) and $_GET["ver"] == "trabalhos") { ?>
        
        <div class="esquerda">
            <table style="width:auto;">
            <tr>
                <td> <img src="images/perfil_usuario/monografias_.png" width="35px"> </td>
                <td> <h1> Meus trabalhos </h1> </td>
            </tr>
        </table>

                <div id="monografias_do_usuario"> 
                  <?php foreach($trabalhosAluno as $trabalho) { ?>
                    <div id="trabalho_usuario"> 
                    <a href="trabalho.php?t=<?php echo $trabalho["cd_trabalho"]; ?>">
                        <div class="trabalho_esquerda"> 
                            <div id="img_cada_trabalho"> </div>
                        </div>
                        
                        <div class="trabalho_direita">
                            <h1><?php echo $trabalho["nm_titulo"]; ?></h1>
                            <p><?php echo substr($trabalho["ds_resumo"], 0, 200) . "...";
 ?></p>
                        </div>
                        </a>
                    </div>
                    <?php } ?>
                    <?php } else if(isset($_GET["ver"]) and $_GET["ver"] == "favoritos") { ?>
        <div class="esquerda">
            <table style="width:auto;">
            <tr>
                <td> <img src="images/perfil_usuario/favoritos_.png" width="35px"> </td>
                <td> <h1> Meus favoritos </h1> </td>
            </tr>
        </table>

             <div id="monografias_do_usuario"> 
                    <div id="trabalhos">
  <?php foreach ($favoritosAluno as $trabalho) { ?>
                        <div id="trabalho_usuario"> 
                    
                    <a href="trabalho.php?t=<?php echo $trabalho["cd_trabalho"]; ?>">
                        <div class="trabalho_esquerda"> 
                            <div id="img_cada_trabalho1"> </div>
                        </div>
                        
                        <div class="trabalho_direita">
                            <h1><?php echo $trabalho["nm_titulo"]; ?></h1>
                            <p><?php echo substr($trabalho["ds_resumo"], 0, 200) . "..."; ?> </p>
                        </div>
                        </a>
                    </div>
                    <?php } ?> 
                    </div>
                </div>
            </div>
        
        </div>
<?php
                    } else { ?>
        <div class="esquerda">
        <table style="width:auto;">
            <tr>
                <td> <img src="images/perfil_usuario/profile_.png" width="35px"> </td>
                <td> <h1> Sobre mim </h1> </td>
            </tr>
        </table>
        
            <p><?php echo  $aluno[0]["tx_bio"];?></p>

          

             <div id="monografias_do_usuario"> 
                <div id="trabalhos">
                
                <!-- se ele não tiver monografia -->
    <?php if(isset($trabalhoTop)) { ?>
        <header class="UltimosTrabalhos">
              <div class="latest_posts"> <h1>Trabalho em destaque </h1> </div>
        </header>
        
        <a href="trabalho.php?t=<?php echo $trabalhoTop[0]["cd_trabalho"]; ?>"> 
        <div id="monografia_destaque">
        
            <div id="foto_monografia_destaque"> 
                <!--img src="images/imagens_monografias/logo_tradeshop.jpg" class="img_destaque"-->
            </div>
            
            <div id="titulo_monografia_destaque">
                <h1><?php echo $trabalhoTop[0]['nm_titulo']; ?></h1>
                <p><?php echo /*$resumo = substr(*/$trabalhoTop[0]['ds_resumo']/*, 0, 450);

echo $resumo."..."; */;?>
</p>    
            </div>
        </div>
        </a>
                    
            <footer class="rodape_mono">
                <table>
                    <tr>
                        <td><?php $cd_trabalho = $trabalhoTop[0]['cd_trabalho'];
                        require("php/mediaAvaliacao.php"); 
                        if(isset($media)) { switch($media) {
                            case 1:
                                echo  "<img src='images/index_icons/umaestrela.png'>";
                                break;
                            case 2:
                                echo  "<img src='images/index_icons/duasestrelas.png'>";
                                break;
                            case 3:
                                echo  "<img src='images/index_icons/tresestrelas.png'>";
                                break;
                            case 4:
                                echo "<img src='images/index_icons/quatroestrelas.png'>";
                                break;
                            case 5:
                                echo "<img src='images/index_icons/cincoestrelas.png'>";  
                                break; }  }?>
                      </td>
                        <td> <!-- linkar com page monografia da escola x -->
                        <a href="explore.php?pesquisa=&amp;curso=<?php echo $trabalhoTop[0]["cd_curso"]; ?>"><?php echo $nomeCurso[0]['nm_curso'];?></a> </td>
                        <td> <a href="explore.php?pesquisa=&amp;escola=<?php echo $trabalhoTop[0]["cd_escola"]; ?>"><?php echo $nomeInstituicao[0]['nm_escola']; ?></a> </td> 
                        <td><?php echo $trabalhoTop[0]["aa_publicacao"]; ?></td>
                    </tr>
                </table>
         </footer>
                    <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div></div>
        <aside class="direita">
            
        	<div id="monografias_relacionadas" style="margin-top:-40px">
                    <header class="UltimosTrabalhos">
                          <div class="latest_posts"> 
                              <table>
                                <tr>
                                    <td> <h1> Meus cursos</h1> </td>
                                </tr>
                              </table>
                          </div>
                    </header>
            		<ul>
                        <?php foreach($cursosAluno as $curso) echo "
						<table id='table_curso'>
						<tr>
							<td> <p><a href='explore.php?pesquisa=&amp;curso={$curso["cd_curso"]}'>{$curso["nm_curso"]}</a></p> </td>
						</tr>
						</table>
						"; ?>
                    </ul> 
                </div>
            </div>  
           
            
            
           <?php if(isset($trabalhoTop[0]) and sizeof($relacionados) > 0) { ?> 
            <div id="monografias_relacionadas">
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
                    <?php foreach ($relacionados as $trabalhoRelacionado) {
                    if($trabalhoRelacionado['cd_trabalho'] <> $trabalhoTop[0]['cd_trabalho']){   ?>
                    <a href="trabalho.php?t=<?php echo $trabalhoRelacionado['cd_trabalho'];?>">
                         <div id="mono_recente">
                            <div class="imagem_monografia_relacionada"  style="background-image: url(images/imagens_monografias/img_vis.jpg)" id="relacionada_1"> </div>
                            <footer class="titulo_relacionada"> <h1> <?php echo substr($trabalhoRelacionado['nm_titulo'], 0, 20) . "...";?> </h1> </footer>
                        </div>
                    </a>
                    <?php }}?>
                </div>
            </div>  
           <?php } ?>
        </aside>
     </section>
    	<?php include 'footer.php'; ?>
</body>
</html>
