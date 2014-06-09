<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();

if(isset($_GET["u"])) {
    $nm_login = $_GET['u'];
    $usuario = "SELECT cd_usuario, CONVERT(ic_desativado, SIGNED) 'ic_desativado' FROM usuario WHERE nm_login = '$nm_login'";
    $pageuser = $conexao->consultar($usuario);
    if(sizeof($pageuser) != 0 and $pageuser[0]["ic_desativado"] != 1) { 
        //seleciona dados da tabela escola pelo codigo de usuario
        $comando = "SELECT * FROM escola WHERE cd_usuario = {$pageuser[0]['cd_usuario']}";
        $escola = $conexao->consultar($comando);
        //busca o nome da cidade pelo codigo da cidade  
        $comando = "SELECT nm_cidade FROM cidade WHERE cd_cidade = {$escola[0]["cd_cidade"]}";
        $cidade = $conexao->consultar($comando);

        $cursos = $conexao->consultar(
            "SELECT c.* FROM curso c, curso_oferecido co WHERE co.cd_curso = c.cd_curso and co.cd_escola = {$escola[0]["cd_escola"]}");

        $recente = $conexao->consultar(
            "SELECT t.*, c.nm_curso from trabalho t, curso c
            WHERE c.cd_curso = t.cd_curso and t.cd_escola = {$escola[0]["cd_escola"]}
            ORDER BY t.dt_publicado LIMIT 6");
    }
    else $inexistente = true;
}
else $inexistente = true;
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de Escola</title>
        
        <link href="cs/global.css" type="text/css" rel="stylesheet">
        <link href="cs/estilo_escola.css" type="text/css" rel="stylesheet">
        <script src="js/jquery.js" type="text/javascript"></script>	
        <script src="js/script.js" type="text/javascript"></script>	
        
   </head>
    <body>
        <?php include("header.php"); ?>
     <?php if(isset($inexistente)) { ?>
        <h1>Conta não encontrada!</h1>
     <?php die(); } ?>
       <div id="escola"> 
      	<div id="lado_left">
            <div id="foto_perfil_escola"> </div>
            
            <div id="dados_escola">
                <div id="texto_dados">
                    <h1><?php echo $escola[0]['nm_escola']; ?> </h1>
                </div>
                
                <div id="icones_dados"> 
                    <a href="?ver=perfil&amp;u=<?php echo $_GET["u"]; ?>">
                        <div class="bot_perfil" id="profile" style="border-bottom:5px solid #2c87af"> </div>
                    </a>
                    <a href="?ver=trabalhos&amp;u=<?php echo $_GET["u"]; ?>">
                        <div class="bot_perfil" id="monografias"> </div> 
                    </a>
                </div>
                
            </div>
        </div>
        
        <div id="lado_right">
      	  <div id="contato" style="width:80%; margin:auto;">
            <header class="UltimosTrabalhos"  style="background-color:white;">
              <div class="latest_posts">
                <Table>
                    <tr>
                        <Td>
                            <img src="images/tag_mapa.png" style="height:25px">
                        </Td>
                        <td >
                            <h1 style="margin-left:5px;">  Localização </h1> 
             
                        </td>
                    </tr>
               </Table>
               </div>
            </header>
               
               <div id="localizacao_instituicao"> 
<iframe style="width:100%;height:100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=<?php echo $escola[0]["tx_endereco"]; ?>&amp;aq=t&amp;sll=37.0625,-95.677068&amp;sspn=40.324283,56.513672&amp;ie=UTF8&amp;hq=&amp;hnear=Pra%C3%A7a+Vinte+e+Dois+de+Janeiro+-+Centro,+S%C3%A3o+Paulo,+11310-090,+Brasil&amp;ll=-23.969883,-46.387468&amp;spn=0.011392,0.013797&amp;t=m&amp;z=14&amp;output=embed"></iframe>
               </div>

                <p>
                 <?php echo $escola[0]['tx_endereco'];?>
                </p>
            </div>
        </div>
     </div>
     
      <section id="descricao_escola"> 
              
    <?php if(isset($_GET["ver"]) and $_GET["ver"] == "trabalhos") { ?>
    <div class="esquerda">
            <table style="width:auto;">
                <tr>
                    <td> <img src="images/perfil_usuario/monografias_.png" width="35px"> </td>
                    <td> <h1> Monografias </h1> </td>
                </tr>
            </table>
            
            <div id="campo_pesquisa_monografia">
                <form action="" id="pesquisaForm">
                    <table>
                        <tr> 
                            <td>
                                <input type="text" style="width:98%; padding-left:2%;" id="txtCampoPesquisaEscola" placeholder="Pesquise o tema de sua monografia aqui" name="pesquisa">
                            </td>
                            <td>
                                <input type="hidden" value="<?php echo $escola[0]["cd_escola"]; ?>" name="escola"> 
                                <input type="submit" style="width:100%" id="btnPesquisaEscola" value="Pesquisar"> </td>

                        </tr>
                    </table>
                </form>
                
                
            </div> 
                    
            
            <div id="resultados_monografias" style="min-height: 500px;">
                
                <div id="lista_resultado">
                    <section id="resultados">
                    </section>
                    <script src="js/explore.js"></script>
                </div>
</div>
     <?php } else { ?>
     	<div class="esquerda">
        	<table style="width:auto;">
        	<tr>
            	<td> <img src="images/perfil_usuario/profile_.png" width="35px"> </td>
        		<td> <h1> Sobre a instituição de ensino </h1> </td>
            </tr>
		</table>
        
        	<p> 
            
            <?php echo $escola[0]['tx_info']; ?>
            
            </p>

             <div id="monografias_do_usuario"> 
                <div id="trabalhos">
                
               
	<span id="without_monografia">
    
                    <header class="UltimosTrabalhos">
                          <div class="latest_posts"> <h1>  Trabalhos recentes </h1> </div>
                    </header>
 </span>
                    
                </div>
                    
            <article class="links_trabalhos">      
              
              <?php foreach($recente as $trabalho) { ?>
            	<div class="box_monografia" id="fav1">
                    	
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1><?php echo $trabalho["nm_titulo"]; ?></h1> </div>
                    </div>
                	
                    <div class="each_icon"></div>

                    <div class="each_resumo"> 
                        <p><?php echo substr($trabalho["ds_resumo"],0,200)."..."; ?></p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                         <a href="#"><?php echo $trabalho["nm_curso"]; ?></a>
                        </h1>
                    </div>
                </div>   
            <?php } ?>
                <?php } ?>
            </article>
    
                </div>
            </div>
        <aside class="direita">
        
            <div id="contato">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts">
                          	<Table>
                            	<tr>
                                	<Td>
                                    	<img src="images/contato.png" style="height:25px">
                                    </Td>
                                	<td >
                           				<h1 style="margin-left:5px;">  Contato </h1> 
                         
                                    </td>
                           		</tr>
                           </Table>
                           </div>
                </header>
                <!--table>
                	<tr>
                   		<td>
                        <a style="color:Black; color:#039;" target="_blank" href="http://www.etecaristotelesferreira.com.br"> Visite a página da Instituição </a>
                        </td>
                   </tr>
                	<tr>
                    	<td>
	                     (13) 3236-9973 
                        </td>
                   	</tr>
                    <tr>
                    	<td>
	                     (13) 3236-9998 
                        </td>
                   	</tr>
                   
                </table-->
                <?php if($escola[0]['tx_contato'] == ''){ 
                echo "Aqui vai o telefone, e-mail e site da instituicao";} 
                    else { echo $escola[0]['tx_contato'] ;}
                if ($escola[0]["tx_url_externo"] != '') {
                    echo '</p><p><a href="http://'.$escola[0]["tx_url_externo"].'">Nossa pagina web</a>';
                }
        ?>
                
            </div>
    
    		<div id="contato">
            	<header class="UltimosTrabalhos">
                          <div class="latest_posts"> <h1>  Cursos oferecidos </h1> </div>
                </header>
                <table id="cursos_oferecidos_cor">
                    <?php foreach($cursos as $curso) { ?>
                    	<tr>
                        	<td> <a href="explore.php?pesquisa=&amp;curso=<?php echo $curso["cd_curso"];?>"><?php echo $curso["nm_curso"]; ?></a>  </td>
                        </tr>                  
                    <?php } ?>
                </table>
            </div>
    	</aside>
        </section>
       
<?php include "footer.php"; ?> 
    </body>
</html>