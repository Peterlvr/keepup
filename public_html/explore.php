<?php
require "../conexao.class.php";
require "../sessao.php";
$conexao = new Conexao();

$cursos = $conexao->consultar("SELECT * FROM curso ORDER BY nm_curso");
$alunos = $conexao->consultar("SELECT * FROM aluno ORDER BY nm_aluno");
$escolas= $conexao->consultar("SELECT * FROM escola ORDER BY nm_escola");
$sessao["estados"] = $conexao->consultar("SELECT * FROM estado");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Explorar</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<link href="cs/estilo_explorar.css" type="text/css" rel="stylesheet">
    <link href="cs/global.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script src="js/explore.js"></script>
	<script src="js/carregaCidade.js"></script> 
</head>

<body>
		<?php include "header.php"; ?>
	<section>
    	<aside>
            <div id="pesquisa">
            <form name="pesquisa" id="pesquisaForm" method="GET" action="">
            <h1> Pesquisar </h1>
            	<table>
                       <tr>
                       		<td>
                       		<img src="images/explore_icons/search.png">
                            </td>
                            <td>
                            <input type="text" name="pesquisa" placeholder="Título ou conteúdo..." class="inputPesquisa">
                            </td>
                       </tr>
                       <Tr>
                       		<Td colspan="2"> <Cite> texto aqui pfvr parça </Cite> </Td>
                       </Tr>
                	<tr>
                    	<td> <input type="checkbox" data-activates="curso"></td>
                    	<td>
                        <select name="curso" class="largura" disabled>
                        <option>Selecione um curso...</option>
						<?php foreach($cursos as $curso) { ?>
							<option value="<?php echo $curso["cd_curso"]; ?>">
								<?php echo $curso["nm_curso"]; ?>
							</option>
						<?php } ?>
					</select>
                        </td>
                    </tr>
					<tr>
                    	<Td>
                        <input type="checkbox" data-activates="autor">
                        </Td>
                        <Td>
                        <select name="autor" class="largura"  disabled>
                        <option>Selecione um autor...</option>
						<?php foreach($alunos as $aluno) { ?>
							<option value="<?php echo $aluno["cd_aluno"]; ?>">
								<?php echo $aluno["nm_aluno"]; ?>
							</option>
						<?php } ?>
					</select>
                        </Td>
                    </tr>
                    <Tr>
                    	<td> <input type="checkbox" data-activates="escola"> </td>
                        <Td>
                        	<select name="escola" class="largura"  disabled>
                            <option>Selecione uma instituição...</option>
						<?php foreach($escolas as $escola) { ?>
							<option value="<?php echo $escola["cd_escola"]; ?>">
								<?php echo $escola["nm_escola"]; ?>
							</option>
						<?php } ?>
					</select>
                        </Td>
                    </Tr>
                    <tr>
                    	<td colspan="2"><input type='submit' value='Buscar'> <td>
                    </tr>
				</table>
					
				</p>
			</form>
            	<?php /*<!--table id="table_aside">
                <h1> Refinar resultado </h1>
                	<tr>
                    	 <td id="pes1"> <a href="#"> <p> Por curso </p> </a> </td> 
                    </tr>
                    <tr>
                    	<td id="pes2"> <a href="#"> <p> Por cidade </p> </a> </td>
                    </tr>
                    <tr>
                    	<td id="pes3"> <a href="#"> <p> Por autor </p> </a> </td>
                    </tr>
                    <tr>
                    	<td id="pes4"> <a href="#"> <p> Por instituição de ensino </p> </a> </td>
                    </tr>
                    <tr>
                    	<td id="pes5"> <a href="#"> <p> Por data de publicação </p> </a> </td>
                    </tr>
                </table>
           
            
             <div id="pes1_abrir">
             	<p style="text-align:center;"> <img src="../../images/explore_icons/curso.png" > </p>
             	
                <a href="#">
                     <p id="voltar" style="text-align:left;font-size:1.3em; padding:3%; width:93%; background-color:#999;">
                        voltar	
                    </p> 
             	</a>
                
                <table id="pes1_table">
                   	<tr>
                    	<td class="cursos"> <a href="#"> <p> Agenciamento de viagem </p> </a>  </td>
                         <td> <p style="color:#333; font-style:italic"> (5) </p> </td>
                    </tr>
                    <tr>
                    	<td class="cursos"> <a href="#"> <p> Desenho de construção civil </p>  </a> </td>
                        <td> <p style="color:#333; font-style:italic"> (5) </p> </td>
                    </tr>
                </table>
             </div>
            
            
            <div id="pes2_abrir">
            	<p style="text-align:center;"> <img src="../../images/explore_icons/localizacao.png"> </p>
             	
                <a href="#">
                     <p id="voltar2" style="text-align:left;font-size:1.3em; padding:3%; width:93%; background-color:#999;">
                        voltar	
                    </p> 
             	</a>
                
                <table>
                <form>
                	<tr>
                    	<td>
                	<select>
                    	<option> Escolha aqui seu estado </option>
                    	<option> SP </option>
                        <option> RJ </option>
                        <option> SC </option>
                        <option> BA </option>
                    </select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                    <select>
                    	<option> Escolha aqui sua cidade</option>
                    	<option> SP </option>
                        <option> RJ </option>
                        <option> SC </option>
                        <option> BA </option>
                    </select>
                    	</td>
                    </tr>
                    <Tr>
                    	<td colspan="2" style="margin:auto; text-align:center"> <input type="submit">  </td>
                    </Tr>
                </form>
                </table>
            </div>
            
            <div id="pes3_abrir">
           <p style="text-align:center;"> <img src="../../images/explore_icons/autores.png" > </p>
            <a href="#">
                     <p id="voltar3" style="text-align:left;font-size:1.3em; padding:3%; width:93%; background-color:#999;">
                        voltar	
                    </p> 
             	</a>
            	<table style="margin-bottom:15px;">
                	<tr> 
                    	<td>
                        	<input id="txtAutor" type="search" placeholder="Digite o nome do autor..." >
                        </td>
                    </tr>
                    <tr>
                    	  <td colspan="2" style="text-align:center"> 
                          	<input type="submit"> 
                          </td>
                    </tr>
                </table>
                
                <table id="table_autores">
                	<tr>
                    	<td  style="width:35px; height:35px" > 
                        	<div class="foto_pesquisa_usuario"> </div>	
                        </td>
                        <td> <p> José Luiz </p> </td>
                    </tr>
                    
                    <tr>
                    	<td> 
                        	<div class="foto_pesquisa_usuario"> </div>	
                        </td>
                        <td> <p> José Luiz </p> </td>
                    </tr>
                </table>
                
            </div>
            
            <div id="pes4_abrir">
             <p style="text-align:center;"> <img src="../../images/explore_icons/ensino.png" > </p>
            <a href="#">
                     <p id="voltar4" style="text-align:left;font-size:1.3em; padding:3%; width:93%; background-color:#999;">
                        voltar	
                    </p> 
             	</a>
                
                <table id="table_autores">
                	<tr>
                    	<td  style="width:35px; height:35px" > 
                        	<div class="foto_pesquisa_escola"> </div>	
                        </td>
                        <td> <p> ETEC Aristóteles Ferreira </p> </td>
                    </tr>
                    
                    <tr>
                    	<td> 
                        	<div class="foto_pesquisa_escola"> </div>	
                        </td>
                        <td> <p> ETEC Aristóteles Ferreira </p> </td>
                    </tr>
                    
                   <tr>
                    	<td> 
                        	<div class="foto_pesquisa_escola"> </div>	
                        </td>
                        <td> <p> ETEC Aristóteles Ferreira </p> </td>
                    </tr>
                    
                    <tr>
                    	<td> 
                        	<div class="foto_pesquisa_escola"> </div>	
                        </td>
                        <td> <p> ETEC Aristóteles Ferreira </p> </td>
                    </tr>
                </table>
                
            </div>
            
            <div id="pes5_abrir">
            	<p style="text-align:center;"> <img src="../../images/explore_icons/curso.png" > </p>
             	
                <a href="#">
                     <p id="voltar5" style="text-align:left;font-size:1.3em; padding:3%; width:93%; background-color:#999;">
                        voltar	
                    </p> 
             	</a>
            </div>
            
            </div-->*/ ?>
        </aside>
    	
        <article>
        	<div id="area__monografias">
            	<div id="div_monografias">
                    <div id="resultado_para">
		                        <table class="resultado_para_table">
                                	<tr>
                                    	<td> <h1> Resultados<!-- para "Informática para Internet" --> </h1> </td>
                                        <td style="text-align:right"> 
                                        	<select>
                                              <option value="">Ordenar</option>
                                              <option value="audi">Mais votados</option>
                                              <option value="audi">Mais vistos</option>
                                              <option value="saab">de A-Z</option>
                                              <option value="mercedes">de Z-A</option>
                                            </select>
                                     </td>
                                     
                                    </tr>
                        		</table>                           
                    </div>
                    
                    <div id="monografias"> 
                    
                    <!--div id="pesquisa_imagem"> </div-->
                    
                	<div id="resultados">
                    	</div>
                    </div>
                    
                 </div>

            </div>
        </article>
    </section>
    <script>
    $().ready(function() {
       pesquisaAjax("<?php echo $_SERVER["QUERY_STRING"]; ?>"); 
    });
    </script>
</body>
</html>
