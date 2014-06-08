<?php 
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();

    $nm_login = $_GET['u'];
    $usuario = "SELECT cd_usuario FROM usuario WHERE nm_login = '$nm_login'";
    $pageuser = $conexao->consultar($usuario);
    //seleciona dados da tabela escola pelo codigo de usuario
    $comando = "SELECT * FROM escola WHERE cd_usuario = {$pageuser[0]['cd_usuario']}";
    $escola = $conexao->consultar($comando);
    //busca o nome da cidade pelo codigo da cidade  
    $comando = "SELECT nm_cidade FROM cidade WHERE cd_cidade = {$escola[0]["cd_cidade"]}";
    $cidade = $conexao->consultar($comando);

$recente = $conexao->consultar(
    "SELECT t.*, c.nm_curso from trabalho t, curso c
    WHERE c.cd_curso = t.cd_curso and t.cd_escola = {$escola[0]["cd_escola"]}");

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de Escola</title>
        
        <link href="cs/global.css" type="text/css" rel="stylesheet">
        <link href="cs/estilo_escola.css" type="text/css" rel="stylesheet">
        <script src="js/jquery.js" type="text/javascript"> </script>	
        <script src="js/script.js" type="text/javascript"> </script>	
        
   </head>
    <body>
        <?php include("header.php"); ?>
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
               
               <div id="localizacao_instituicao"> </div>

                <p>
                 <?php if($escola[0]['tx_endereco'] == ''){ echo "Aqui vai o endereço";} 
				 else { echo $escola[0]['tx_endereco'];}?>
                </p>
            </div>
        </div>
     </div>
     
      <section id="descricao_escola"> 
              
    <!-- Parte dois - trabalhos  -->
    <?php if(isset($_GET["ver"]) and $_GET["ver"] == "trabalhos") { ?>
    <div class="esquerda">
            <table style="width:auto;">
                <tr>
                    <td> <img src="images/perfil_usuario/monografias_.png" width="35px"> </td>
                    <td> <h1> Monografias </h1> </td>
                </tr>
            </table>
            
            <div id="campo_pesquisa_monografia">
                <form>
                    <table>
                        <tr> 
                            <td> <input type="text" style="width:98%; padding-left:2%;" id="txtCampoPesquisaEscola" placeholder="Pesquise o tema de sua monografia aqui" /> </td>
                            <td> <input type="submit" style="width:100%" id="btnPesquisaEscola" value="Pesquisar"> </td>

                        </tr>
                    </table>
                </form>
                
                
            </div> 
            <a id="abrir_filtro" style="color:blue; cursor:pointer"> <h1> > Filtrar pesquisa  </h1  > </a>
                <div id="Filtrar_pesquisa">
                
                Não sei como vai ficar o filtro de pesquisa aqui dentro, mas qualquer coisa, só colocar :D
                
                </div>      
            
            <div id="resultados_monografias">
                <h1> Resultados para "X" </h1>
                    <h2> 1 a 15 - 500 </h2>
                
                <div id="lista_resultado">
                    <div class="box_monografia" id="fav3">
                        <div class="each_titulo_area">
                            <div class="each_titulo"> <h1> Moudelle </h1> </div>
                        </div>
                        
                        <div class="each_icon" id="imagem_fav3">
                        </div>
    
                        <div class="each_resumo"> 
                            <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                            </p>
                        </div>
                        
                        <div class="each_autor_curso"> 
                            <h1>                        
                           
                           <a href="#"> Informática para Internet </a>
                            
                            </h1>
                        </div>
                    </div>
                    
                  <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> <h1> Informática para Internet </h1> </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>  
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                    
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>
                     
                   <div class="box_monografia" id="fav3">
                    <div class="each_titulo_area">
                        <div class="each_titulo"> <h1> Moudelle </h1> </div>
                    </div>
                    
                    <div class="each_icon" id="imagem_fav3">
                    </div>

                    <div class="each_resumo"> 
                        <p> O objetivo deste sistema é agendar as consultas da clínica de forma rápida e prática e efetuar venda de produtos relacionados a tratamentos que a clínica oferece.
                        </p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                       
                       <a href="#"> Informática para Internet </a>
                        
                        </h1>
                    </div>
                </div>  
                </div>
    <!-- Fim parte dois - trabalhos  -->
</div>
     <!-- Parte um - Sobre mim -->
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
                        <p><?php echo $trabalho["ds_resumo"]; ?></p>
                    </div>
                    
                    <div class="each_autor_curso"> 
                        <h1>                        
                         <a href="#"><?php echo $trabalho["nm_curso"]; ?></a>
                        </h1>
                    </div>
                </div>   
            <?php } ?>
                  
                
                <?php } ?>
	<!-- Fim parte um - sobre mim -->                
                
                
     
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
                	<tr>
                    	<td> <a href="#"> Agenciamento de viagem </a>  </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Desenho de construção civil </a> </td>
                    </tr>
                    <tr>
                    	<td><a href="#">  Edificações </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Eletrônica </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Eletrotécnica </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> EM integrado com Informática</a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> EM integrado com Eletronica</a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Eventos</a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Informática </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Informática para Internet </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Mecânica </a> </td>
                    </tr>
                    <tr>
                    	<td> <a href="#"> Programação de Jogos Digitais </a> </td>
                    </tr>
                    
                </table>
            </div>
    	</aside>
        </section>
       
<?php include "footer.php"; ?> 
    </body>


</html>