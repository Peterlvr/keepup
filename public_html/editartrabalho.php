<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar trabalho</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<link href="cs/style_monografia.css" type="text/css" rel="stylesheet">
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="script.js" type="text/javascript"> </script> 
</head>

<body>

	<section> 
    
    
    
    	<div id="bloco1_esquerda_resumo">
        		<div id="bloco1_esquerda_titulo"> 
                	<h1> TradeShop.com - Plataforma de Trocas na Baixada Santista </h1> 
                </div>
                
                	<a href="#">
                <div id="bloco1_esquerda_favorito"> </div>
                	</a>
                
                	<a href="monografias/tradeshop.pdf" target="_blank">
                <div id="bloco1_esquerda_baixar"> </div>
                	</a>
                    
                <div id="bloco1_esquerda_parte_escrita"> 
                   <form>
                   		<table id="table_publicar_1">
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
                              		<h1> Alterar título </h1>
                                    <input required id="txtTituloMonografia" type="text">
                                </td>
                            </tr>
                            <tr>
                            	<td>
                              		<h1> Alterar resumo</h1>
                                    <textarea rows="15" required id="txtTituloMonografia"></textarea>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                              		<h1> Alterar curso </h1>
                                     <select required>
                                    	<option> </option>
                                        <option> </option>
                                        <option> </option>
                                        <option> </option>
                                        <option> </option>
                                        <option> </option>
                                        <option> </option>
                                    </select>	
                                </td>
                            </tr>
                            <Tr>
                            	<Td>
                                	<h1> Alterar palavras-chave</h1>
                                    <input required id="txtTituloMonografia" type="text">
                                    <input required id="txtTituloMonografia" type="text">
                                    <input required id="txtTituloMonografia" type="text">
                                    	<input type="button" value="+ Adicionar campo">
                                </Td>
                            </Tr>
                            <Tr>
                            	<td> 
                                	<h1> Alterar instituição </h1>
                                    <input type="text" id="txtTituloMonografia"> 
                                </td>
                            </Tr>
                        	<tr>
                            	<Td colspan="2" style="text-align:center;">
                                	  <input id="btnSalvar" type="submit" value="Salvar alterações">
                                      <input id="btnCancelar" type="button" value="Cancelar" >
                                </Td>
                            </tr>                        
                        </table>
                        
                   </form>
                    
                
                    
                </div>

                
                <div id="bloco1_esquerda_comentario">
                	<table id="usuario_comentar">
                		<tr>
                        	
                        	<td class="foto"> <div id="foto_usuario_pracomentar"> </div> </td>
                            <td class="comentar">
                            <h1> Escreva um comentário sobre o projeto: </h1>
                            	<form>
                                	<textarea required id="txtEnviarComentario" placeholder="Envie seu comentário..."></textarea>
                                    <input id="btnEnviarComentario" type="submit" value="Enviar" />
                            	</form>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div id="comentrarios_dos_outros">
                	<div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<img src="images/usuario_postou/2.jpg" style="width:150px; height:150px">
                                    </div>
                                </td>
                                <td style="width:100%;">
                                <h1> Felipe Simões	 </h1>
                                <h2> 19 de Maio de 2014 - 23h06 </h2>
                                	<div class="texto_cada_comentario">
                                    	<p> 
                                        	Aliquam vel porttitor odio. Fusce ac erat tellus. Vivamus lobortis rhoncus mauris nec convallis. Integer fringilla nibh ipsum, vel pellentesque leo tincidunt in. Pellentesque lacinia scelerisque libero, id imperdiet arcu varius a. Cras pharetra diam quis nisl condimentum feugiat. Nullam ultricies sodales nisl ac imperdiet. Maecenas sodales eu quam vitae suscipit. Etiam accumsan nisl quam, eget faucibus nisl commodo at.Lorem ipsum dolor sit amet, consectetur adipiscing elit. 	
                                        </p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                        
                    </div>
                    
                    <div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<img src="images/usuario_postou/4.jpg" style="width:150px; height:150px">
                                    </div>
                                </td>
                                <td style="width:100%;">
                                <h1> Peterson Oliveira </h1>
                                <h2> 16 de Maio de 2014 - 2h36 </h2>
                                	<div class="texto_cada_comentario">
                                    	<p> 
                                        	Aenean a lorem magna. Suspendisse venenatis dolor a purus venenatis tincidunt. Donec sed urna porta, sagittis dui sit amet, posuere nunc. Fusce congue non neque eu lobortis. Fusce consequat eros vitae scelerisque vulputate. Nullam lobortis leo metus, ut placerat nisl facilisis vel. Sed viverra iaculis eros, vitae iaculis nibh dictum id. Quisque nec metus hendrerit, vehicula nisl id, aliquam nisi. 
                                        </p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                    </div>
                    
                    <div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<img src="images/usuario_postou/5.jpg" style="width:150px; height:150px">
                                    </div>
                                </td>
                                <td style="width:100%;">
                                <h1> Gabriel Chiconi </h1>
                                <h2> 10 de Maio de 2014 - 12h58 </h2>
                                	<div class="texto_cada_comentario">
                                    	<p> 
                                        	Donec porta magna vitae feugiat interdum. Proin at egestas lacus. Fusce tempor nibh tortor, pulvinar vehicula nulla tincidunt in. Sed non pharetra ipsum, a ornare eros. Phasellus elementum sapien augue, nec aliquet quam volutpat quis. Ut felis mauris, hendrerit eget tincidunt in, blandit sit amet elit.
                                        </p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                    </div>
                 
                 	<div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<img src="images/usuario_postou/10.jpg" style="width:150px; height:150px">
                                    </div>
                                </td>
                                <td style="width:100%;">
                                 <h1> Giulia Giusti </h1>
                                 <h2> 8 de Maio de 2014 - 10h27 </h2>
                                	<div class="texto_cada_comentario">
                                    	<p> 
                                        	Aenean a lorem magna. Suspendisse venenatis dolor a purus venenatis tincidunt. Donec sed urna porta, sagittis dui sit amet, posuere nunc. Fusce congue non neque eu lobortis. Fusce consequat eros vitae scelerisque vulputate. Nullam lobortis leo metus, ut placerat nisl facilisis vel. Sed viverra iaculis eros, vitae iaculis nibh dictum id. Quisque nec metus hendrerit, vehicula nisl id, aliquam nisi. 
                                        </p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                    </div>
                    
                    <div id="cada_comentario"> 
                    	<table id="table_cada_comentario">
                        	<tr>
                            	<td>
		                    		<div class="foto_cada_comentario">
                                    	<img src="images/usuario_postou/11.jpg" style="width:150px; height:150px">
                                    </div>
                                </td>
                                <td style="width:100%;">
                                 <h1> Cynthia Nunes </h1>
                                 <h2> 2 de Maio de 2014 - 2h22 </h2>
                                	<div class="texto_cada_comentario">
                                    	<p> 
                                        	Donec porta magna vitae feugiat interdum. Proin at egestas lacus. Fusce tempor nibh tortor, pulvinar vehicula nulla tincidunt in. Sed non pharetra ipsum, a ornare eros. Phasellus elementum sapien augue, nec aliquet quam volutpat quis. Ut felis mauris, hendrerit eget tincidunt in, blandit sit amet elit.
                                        </p>
                                    </div>
                                </td>
                        	</tr>
                        </table>
                    </div>
                    
                </div>
                
        </div>
        
        <div id="direita">
                        
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
            	<p> 
                	troca - 
					mercadorias -
                    consumo consciente
               </p>
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
            	
                	<table id="table_autores">
                    	<tr>
                        	<td style="width:80px;">
                            	<div id="foto_usuario_monografia">
                                	<img src="images/usuario_postou/6.jpg" class="imagem_usuario"> 
                                </div> 
                            </td>
                            <td style="padding-left:10px"> <p> Isabelle Lima </p> </td>
                        </tr>	
                    </table>
                    
                    <a href="../usuario/User.html" style="color:black;">
                    <table id="table_autores">
                    	<tr>
                        	<td style="width:80px;">
                            	<div id="foto_usuario_monografia">
                                	<img src="images/usuario_postou/8.jpg" class="imagem_usuario"> 
                                </div> 
                            </td>
                            <td style="padding-left:10px"> <p> Thiago Limeres </p> </td>
                        </tr>	
                    </table>
                    </a>
                    
                    
                    <table id="table_autores">
                    	<tr>
                        	<td style="width:80px;">
                            	<div id="foto_usuario_monografia">
                                	<img src="images/usuario_postou/9.jpg" class="imagem_usuario"> 
                                </div> 
                            </td>
                            <td style="padding-left:10px"> <p> Guilherme Ferreira </p> </td>
                        </tr>	
                    </table>
                    
                    <table id="table_autores">
                    	<tr>
                        	<td style="width:80px;">
                            	<div id="foto_usuario_monografia">
                                	<img src="images/usuario_postou/7.jpg" class="imagem_usuario"> 
                                </div> 
                            </td>
                            <td style="padding-left:10px"> <p> Pedro Medeiros </p> </td>
                        </tr>	
                    </table>
			</div>
            
            
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
                        	<img src="images/imagens_monografias/logo5.png" class="imagem_relacionada">
                        </div>
                        <footer class="titulo_relacionada"> <h1> Checkpoint Social </h1>  </footer>
                    </div>
				</a>
                
                <a href="#">
                    <div id="cada_monografia_relacionada">
                    	<div class="imagem_monografia_relacionada"> 
                        	<img src="images/imagens_monografias/logo3.png"  class="imagem_relacionada">
                        </div>
                        <footer class="titulo_relacionada"> <h1> Keep Up </h1>  </footer>
                    </div>
				</a>
                
                <a href="#">                    
                   <div id="cada_monografia_relacionada">
                    	<div class="imagem_monografia_relacionada">
                        	<img src="images/imagens_monografias/1.jpg"  class="imagem_relacionada">
                        </div>
                        <footer class="titulo_relacionada"> <h1> Redes sociais  </h1>  </footer>
                    </div>
                </a>
                    
                    
            	
                	
			</div>
        </div>	

    </section>
    
    <?php include_once("footer.php") ?>

</body>
</html>