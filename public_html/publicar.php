<?php # Visão 'index'
require("../sessao.php");
require("../conexao.class.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Publicar</title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
<link href="cs/global.css"  rel="stylesheet" type="text/css" />     <link  href="cs/estilo_publicar.css" rel="stylesheet" type="text/css"/>      <link href="js/jquery-ui-1.10.4.min.css" type="text/css"  rel="stylesheet">     <script src="js/jquery.js"  type="text/javascript"> </script>     <script  src="js/jquery-ui-1.10.4.min.js" type="text/javascript">  </script>     <script src="js/script.js"  type="text/javascript"> </script>

    
</head>

<body>
	<?php include_once("header.php"); ?>
    
    <Section id="section1">
     	<div id="img_publicar">
        	<div id="esquerda_pub">
            	<h1> Publique seu trabalho acadêmico </h1>
                <p> 
                	Impulsione seu currículo na web divulgando conosco seu trabalho acadêmico.  Nossa plataforma é o lugar ideal para expor seu trabalho que de outra forma ficaria ao alcance de poucos. 
                </p>
            </div>
            
            <div id="direita_pub">
            	<div id="img_vantagens_enviar"> 
                	<h1 style="font-size:1.3em; color:#15556b ;margin-bottom:0;"> Bons motivos </h1>
                    
                    <table id="table_pub">
                    	<tr>
                        	<td class="td"> <img src="images/check_pub.png" width="20"> </td>
                            <td>
                            	<p>
                               Seu trabalho fica sempre disponível e facilmente acessível na rede. 
                                </p>
                            </td>
                        </tr>
                        <tr>
                        	<td class="td"> <img src="images/check_pub.png" width="20"> </td>
                            <td>
                            	<p>
                                O Keep Up gera muita visibilidade entre o meio acadêmico, assim você recebe reconhecimento e pode interagir com demais profissionais de sua área.
                                </p>
                            </td>
                        </tr>
                        <tr>
                        	<td class="td"> <img src="images/check_pub.png" width="20"> </td>
                            <td>
                            	<p style="margin-bottom:0;">
                               Ao publicar seu trabalho na rede você torna-se de fato um autor, alcançando todos os leitores que buscam conteúdo relacionado com seu trabalho.
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p style=" color:#333; text-align:center;">
                     Ao clicar em "Publicar minha monografia", você aceita a nossa 
                     <a href="pp.php" style="color:#2c87af;">Política de Privacidade </a>
                    </p>
                   
                   	<div id="btnPublicar">
                    		<a href="publicartrabalho.php" style="color:white;">
                        <table>
                        	<tr>
                            	<td style=" width:50px;background-color:#db5f30; text-align:center;height:40px;"> 
                                	<img src="images/pencil.png" width=""> 
								</td>
                                <Td style="font-size:900;padding:5px;">
                                	Publicar minha monografia 
                                </Td>
                            </tr>
                        </table>
                        	</a>
                    </div>
                </div>
            </div>        	
        </div>
        
        <article>
       		<aside id="asideLeft">
            	<header class="UltimosTrabalhos">
            		<div class="latest_posts"> <h1 style="color:white;"> Como o Keep Up funciona? </h1> </div>
           		</header>
                
                <table>
                	<tr>
                    	<td style="width:70px">
                        	<img src="images/publicar_seu_trabalho.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                             Publique seu trabalho
                            </h2>
                            <p> 
                            Após preencher se cadastrar é hora de divulgar seu trabalho. Você verá como é simples e rápido publicar seu trabalho acadêmico no Keep Up. Para tornar-se um autor basta ir para a seção Publicar. 

                            </p>
                        </td>
                    </tr>
                    <tr>
                    	<td style="width:70px">
                        	<img src="images/Interaja.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                             Interaja com o meio acadêmico
                            </h2>
                            <p> 
                            Nós do Keep Up encorajamos todos os usuários a comentar e avaliar os trabalhos que lêem durante suas pesquisas. A prática de avaliação promove uma aproximação entre autores de mesmo interesse, além de servir como fomento ao avanço na formação de todos que compõe a comunidade profissional e acadêmica.

                            </p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<img src="images/Encontre_todos__trabalhos_seu_interesse.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                            Encontre todos os trabalhos de seu interesse
                            </h2>
                            <p> 
                            Durante sua visita ao Keep Up você não precisa perder seu tempo com conteúdo irrelevante ou que nada tenha a ver com seus interesses. A pesquisa em nossa plataforma é organizada de modo a extrair de nosso acervo exatamente o que você precisa. Navegue de modo inteligente e encontre exatamente aquilo que lhe interessa na seção Explore.
                            </p>
                        </td>
                    </tr>	
                    <tr>
                    	<td>
                        	<img src="images/organize_suas_leituras.png" height="40">
                        </td>
                        <td> 
                        	<h2>
                            Organize suas leituras
                            </h2>
                            <p> 
                            Toda a vez que encontrar algo de seu interesse você pode adicionar o trabalho a sua biblioteca pessoal e ter à sua disposição o acesso rápido àqueles trabalhos que você mais gostou. Tudo o que é de seu interesse fica facilmente acessível na seção Favoritos.
                            </p>
                        </td>
                    </tr>
                    <tr>
                    	<td style="width:70px">
                        	<img src="images/publicar_seu_trabalho.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                             Publique seu trabalho
                            </h2>
                            <p> 
                            Após preencher seu cadastro é hora de divulgar seu trabalho, é rápido e simples
Interaja com o meio acadêmico
	Todos os usuários podem comentar e avaliar os trabalhos que lêem durante suas pesquisas

                            </p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<img src="images/Encontre_todos__trabalhos_seu_interesse.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                            Encontre todos os trabalhos de seu interesse
                            </h2>
                            <p> 
                            Navegue de modo inteligente e encontre exatamente aquilo que lhe interessa na seção Explore	
                            </p>
                        </td>
                    </tr>	
                    <tr>
                    	<td>
                        	<img src="images/organize_suas_leituras.png" height="50">
                        </td>
                        <td> 
                        	<h2>
                            Organize suas leituras
                            </h2>
                            <p> 
                            Tudo o que é de seu interesse fica facilmente acessível em sua seção de Favoritos
                            </p>
                        </td>
                    </tr>		
                </table>
            </aside>
            
            <aside id="asideRight">
                
                <div id="accordion">
                      <h3>Que tipo de trabalho eu posso enviar?</h3>
                      <div>
                        <p>
                        Você pode enviar qualquer trabalho de conclusão de curso, monografia, pesquisa de iniciação científica ou artigo científico, realizado por uma ou mais pessoas, desde que você seja um dos autores legítimos. O seu trabalho deve seguir todas as normas do site, e, caso o curso para o qual ele tenha sido desenvolvido não conste no site, você deve colocar o curso mais próximo.
                        </p>
                      </div>
                      <h3>Eu preciso enviar uma imagem?</h3>
                      <div>
                        <p>
                        Não, o envio de uma imagem de capa para seu trabalho não é um requisito para que seu trabalho seja publicado. O Keep Up, no entanto, recomenda que você escolha uma imagem representativa do seu trabalho. O intuito da imagem é reforçar e transmitir de modo conciso a essência do seu trabalho, capturando a atenção dos leitores que busquem seu conteúdo.
                        </p>
                      </div>
                      <h3>Meu trabalho vai estar seguro?</h3>
                      <div>
                        <p>Preocupações com relação ao plágio são frequentes, e não podemos garantir que a conduta de terceiros seja antiética. Já estão disponíveis softwares modernos desenvolvidos especificamente para detectar práticas de plágio. É papel do orientador de desenvolvimento de trabalho de conclusão de curso utilizar dessas ferramentas para assegurar que o aluno não cometa essa prática ilegal como meio de obter sua certificação profissional. Como medida adicional encorajamos nossos autores mais preocupados com propriedade intelectual a registrarem suas ideias na Biblioteca Nacional ou utilizar licenças abertas da rede (como o Creative Commons). </p>
                      </div>
                       <h3>E se meus parceiros de trabalho não tiverem perfil?</h3>
                      <div>
                        <p>No caso de uma publicação de trabalho em que colaboradores ainda não tenham perfil no Keep Up, você pode inserir os nomes e e-mails dos mesmos e nós cuidamos do resto. Os usuários precisam estar cientes de que seus trabalhos estão na rede e eles também merecem crédito como autores, para isso geramos suas contas com senhas temporárias e eles recebem automaticamente perfis em nossa plataforma. </p>
                      </div>                        
                    </div>
                    
            </aside>
            
            <div style="width:100%; clear:both;"> </div>
        </article>
    </Section>
    <?php include_once("footer.php"); ?>
</body>
</html>