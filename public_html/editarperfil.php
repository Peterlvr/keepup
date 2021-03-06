<?php 
include "../conexao.class.php";
include "../sessao.php";

$con  = new Conexao();
// retirar dados da sessao
$sessao["estados"] = $con->consultar("SELECT * FROM estado");
$_SESSION["login"]; //nm_login
$_SESSION["cd_usuario"];
$_SESSION["nome"];
$sessao["tipoConta"];

$email_usuario = $con->consultar("SELECT nm_email FROM usuario WHERE cd_usuario = {$_SESSION['cd_usuario']}");

if($sessao["tipoConta"] == "A") {
    $dados_aluno = $con->consultar("SELECT * 
        FROM aluno 
        WHERE cd_aluno = {$_SESSION["cd_aluno"]}; ");
    $dt_nascimento = $dados_aluno[0]['dt_nascimento'];
    $sessao["escolas"] = $con->consultar("SELECT nm_escola, cd_escola FROM escola");
    $aluno_matriculado = $con->consultar("SELECT e.nm_escola 
		FROM escola e, matricula m, aluno al 
		WHERE al.cd_aluno = m.cd_aluno AND e.cd_escola = m.cd_escola AND al.cd_aluno = {$_SESSION['cd_aluno']}");
    $aluno_cursos = $con->consultar("SELECT c.*
        FROM curso c, aluno a, cursando cu 
        WHERE c.cd_curso = cu.cd_curso and a.cd_aluno = cu.cd_aluno and
        a.cd_aluno = {$sessao["cd"]}");
    $favoritos = $con->consultar("SELECT t.*
        FROM trabalho t, favorito f, aluno a
        WHERE t.cd_trabalho = f.cd_trabalho and
        a.cd_aluno = f.cd_aluno and
        f.cd_aluno = {$sessao["cd"]} ORDER BY f.dt_favoritado LIMIT 3");
    $trabalhos = $con->consultar("SELECT t.*
        FROM trabalho t, autoria au
        WHERE t.cd_trabalho = au.cd_trabalho and au.cd_aluno = {$sessao["cd"]}
        ORDER BY t.dt_publicado LIMIT 3");
}
if($sessao["tipoConta"] == "E") {
    $dados_escola = $con->consultar("SELECT * 
        FROM escola 
        WHERE cd_escola = {$_SESSION["cd_escola"]}; ");
    $escola_cursos = $con->consultar(
        "SELECT c.* FROM curso c, escola e, curso_oferecido co
        WHERE c.cd_curso = co.cd_curso and e.cd_escola = co.cd_escola
        and e.cd_escola = {$sessao["cd"]}");
    $trabalhos = $con->consultar("SELECT *
        FROM trabalho
        WHERE cd_escola = {$sessao["cd"]}
        ORDER BY dt_publicado LIMIT 3");
}
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editar Perfil - Keep Up</title>
        <script type="text/javascript" src="js/jquery.js"></script>
    	<script type="text/javascript" src="js/carregaCidade.js"></script>
        <script type='text/javascript' src="js/toggleFields.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
        <link href="cs/global.css" rel="stylesheet" type="text/css" />
        <link href="cs/estilo_user.css" rel="stylesheet" type="text/css">
    	<link href="cs/estilo_editarUser.css" rel="stylesheet" type="text/css">
        <script src="js/slides.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <script>
            function rmFavorito(t, self) {
                $.post("php/favoritar.php", {trabalho: t})
                    .done(function(data) {
                        if(data == "0") {
                            $(self).parent().remove();
                        }
                        else {
                            console.log(data);
                        }
                    })
            }
        </script>
    </head>
<body>
<?php include_once("header.php"); ?>


<div id="usuario"> 
    	 <div id="lado_left"> 
            <div id="foto_perfil_usuario"> 
                <?php if($sessao["tipoConta"] == "A" and $dados_aluno[0]['nm_url_avatar'] == '') { ?>
                <img id="fotoUser" src='images/default/usericon.png'>  
                <?php } if($sessao["tipoConta"] == "A" and $dados_aluno[0]['nm_url_avatar'] <> '') { ?> 
                <img id="fotoUser" src="images/upload/<?php echo $sessao['cd_usuario']; ?>/<?php echo $dados_aluno[0]['nm_url_avatar']; ?>" style="width: 200px; height:200px;">  
                <?php } if($sessao['tipoConta'] == "E" and $dados_escola[0]['tx_url_avatar'] == '') { ?>
                 <img id="fotoUser" onclick="$('#file').click();" src='images/default/usericon.png'>  
                 <?php } if($sessao['tipoConta'] == "E" and $dados_escola[0]['tx_url_avatar'] <> '') { ?>
                 <img id="fotoUser" onclick="$('#file').click();" src="images/upload/<?php echo $sessao['cd_usuario']; ?>/<?php echo $dados_escola[0]['tx_url_avatar']; ?>" style="width: 200px; height:200px;">
                 <?php } ?>
                <div id="alterar_foto" style='position:absolute; top:9%; width:11%;'> 

                    <table style="width:100%; text-align:left;">
                        <tr><button onclick="$('#file').click();"> Atualizar foto de perfil </button>
                        <?php if($sessao['tipoConta'] == "A") { ?>
                        <form action="php/upload_file.php" method="post" enctype="multipart/form-data" id='form_upload' >
                            <input type="file" name="file" id="file" style="display: none;" />
                            <button type="submit" name="submit" id='btn'></button>
                        </form>
                        <?php } if($sessao['tipoConta'] == 'E') { ?>
                        <form action="php/upload_file_escola.php" method="post" enctype="multipart/form-data" id='form_upload' >
                            <input type="file" name="file" id="file" style="display: none;" />
                            <button type="submit" name="submit" id='btn'></button>
                        </form>
                        <?php } ?>
                        </tr>
                    </table>
                </div>
            
            </div>
            
            <div id="dados_usuario">
                <div id="texto_dados">
                    <h3> <?php if($sessao["tipoConta"] == "A") { echo $dados_aluno[0]['nm_profissao']; } ?> </h3>
                    <h1> <?php echo $_SESSION["nome"]; ?> </h1>
                    <?php if($sessao["tipoConta"] == "A") foreach ($aluno_matriculado as $matriculado) { ?> 
                        <h2> <?php echo $matriculado['nm_escola'];?> </h2>
                    <?php }?>
                </div>
            </div>
		</div>
        
       
        <div id="lado_right"> 
            <?php if($sessao["tipoConta"] == "A") { ?>
        	<div id="contato">
            	<header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts" style="margin:-10px auto auto 5%;"> <h1>  Contato </h1> </div>
                </header>
                <table style="background-color:white">
                	<tr>
                    	<td> <img src="images/face.png" width="30"></td>
                        <td style="text-align:left;"><?php if($dados_aluno[0]['nm_fb'] <> '') { echo $dados_aluno[0]['nm_fb']; }
                        else { echo 'Campo não preenchido.';} ?>
                        </td>
                    </tr>
                    <tr>
                    	<td> <img src="images/linkedin.png" width="30"> </td>
                        <td style="text-align:left;"> <?php if($dados_aluno[0]['tx_url_linkedin'] <> '') { echo $dados_aluno[0]['tx_url_linkedin']; } 
                        else { echo 'Campo não preenchido.';} ?> 
                        </td>
                    </tr>
                    <tr>
                    	<td> <img src="images/url.png" width="30"> </td>
                        <td style="text-align:left;"><?php if($dados_aluno[0]['tx_url_externo'] <> '') { ?>
                       		<a href="http://<?php echo $dados_aluno[0]['tx_url_externo']; ?>" target="_blank"> <?php echo $dados_aluno[0]['tx_url_externo']; ?> </a>
                            <?php } else { ?>  Campo não preenchido.  <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php }?>
        </div>

   </div>
   
     <section id="descricao_usuario"> 
     	<div class="esquerda">
        
       			<header class="UltimosTrabalhos">
                	<div class="latest_posts"> 
                    	<h1><img src="images/key.png" width="20px"> Configurações de Login e Senha </h1>
                    </div>   	
                </header>
        
        		<form action="php/editarDados.php" method="POST" id="editarContaForm">
    		<section id="painelConta">
             <table id="table_form">
                <tr>
                	<td class="td_left"> <h1> Email: </h1> </td>
                    <td> <input placeholder="exemplo@email.com" type="email" name="nmEmail" value="<?php echo $email_usuario[0]['nm_email']; ?>" required> <br>
						<cite> Para mudar seu e-mail digite sua senha e confirme </cite>
                    </td>
                </tr>
                <Tr>
                	<td clas="td_left"> <h1> Senha: </h1></td>
                    <td><input type="password" name="senhaConta" required> </td>
                </Tr>
                <Tr>
                	<td clas="td_left"> <h1> Confirmar senha: </h1></td>
                    <td><input type="password" name="confirmaSenhaConta" required> </td>
                </Tr>
             </table>
			</section>
			<input id="envia" type="submit" value="Alterar e-mail" style="position:relative; left:50%;">
    	</form>
        
<div id="formulario_editar_dados">        
       
				<header class="UltimosTrabalhos">
                	<div class="latest_posts"> 
                    	<h1><img src="images/perfil_usuario/profile.png" width="20px"> Dados pessoais </h1>
                    </div>   	
                </header>
        
        <?php if($sessao["tipoConta"] == "A") { ?>        
        <form action="php/editarperfil.php" method="POST" id="editarPerfilForm"> 
            <section id="painelUsuario">
                <table id="table_form">
                    <tr>
                        <td class="td_left"> <h1> Nome de aluno: </h1> </td>
                        <td colspan="2"> <input placeholder="Nome de Aluno" type="text" name="nmAluno" value="<?php echo $_SESSION["nome"]; ?>" required> </td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Data de nascimento: </h1> </td>
                        <td colspan="2"> <input type="date" name="dtNascimento" value="<?php echo $dt_nascimento; ?>"> </td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Sobre mim: </h1> </td>
                        <td colspan="2"> <textarea  rows="5" cols='45' placeholder="Sobre mim..." name="sobreMim" ><?php echo $dados_aluno[0]['tx_bio']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Profissão: </h1> </td>
                        <td colspan="2"> <input placeholder="Profissao" type="text" name="nmProfissao" value="<?php echo $dados_aluno[0]['nm_profissao'];?>" > </td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Facebook: </h1> </td>
                        <td colspan="2">facebook.com/<input placeholder="Endereço de Facebook" type="text" name="nmFB" value="<?php echo $dados_aluno[0]['nm_fb']; ?>" > </td>
                    </tr>
                     <tr>
                        <td class="td_left"> <h1> Linkedin: </h1> </td>
                        <td colspan="2"> <input placeholder="Url para linkedin" type="text" name="nmLinkedin" value="<?php echo $dados_aluno[0]['tx_url_linkedin']; ?>" > </td>
                    </tr>
                    <tr>
                    	<td class="td_left"> <h1> Link externo </h1></td>
                        <td colspan="2"> <input placeholder="Url para site externo" type="text" name="nmUrlExterno" value="<?php echo $dados_aluno[0]['tx_url_externo']; ?>" ></td>
                    </tr>
                </table>
		    </section>
            <input id="envia" type="submit" value="Salvar">
	    </form>
        <?php } else { ?>
        <form action="php/editarperfil.php" method="POST" id="editarPerfilForm"> 
            <section id="painelUsuario">
                <table id="table_form">
                    <tr>
                        <td class="td_left"> <h1> Nome da instituição: </h1> </td>
                        <td colspan="2"> <input placeholder="Nome da Instituição" type="text" name="nmEscola" value="<?php echo $_SESSION["nome"]; ?>" required> </td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Sobre a instituição: </h1> <cite> (informações) </cite> </td>
                        <td colspan="2"> <textarea  rows="5" cols='45' placeholder="Sobre a instituição..." name="sobreEscola"><?php echo $dados_escola[0]['tx_info'];?></textarea></td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Contato: </h1> <cite> (telefones - separados por vírgula) </cite>  </td>
                        <td colspan="2"> <input placeholder="Telefones para contato" type="text" name="Contato" value="<?php echo $dados_escola[0]['tx_contato'];?>" > </td>
                    </tr>
                    <tr>
                        <td class="td_left"> <h1> Site da instituição: </h1> </td>
                        <td colspan="2"> <input placeholder="Site da instituição" type="text" name="Url" value="<?php echo $dados_escola[0]['tx_url_externo'];?>" > </td>
                    </tr>
                     <tr>
                        <td class="td_left"> <h1> Localização: </h1> <cite> (endereço completo) </cite> </td>
                        <td colspan="2"> <input placeholder="Localização" type="text" name="Localizacao" value="<?php echo $dados_escola[0]['tx_endereco'];?>" > </td>
                    </tr>
                </table>
            </section>
            <input id="envia" type="submit" value="Salvar">
        </form>
        <?php }?>

            <?php if($sessao["tipoConta"] == "A") { ?>    
         		<header class="UltimosTrabalhos">
                	<div class="latest_posts"> 
                    	<h1><img src="images/perfil_usuario/profile.png" width="20px"> 
                        Localização e Instituição de ensino  </h1>
                    </div>   	
                </header>


				<?php if(isset($dados_aluno[0]['cd_cidade'])) { 
					$cidade_usuario = $con->consultar("SELECT e.sg_estado, c.nm_cidade 
					FROM estado e, cidade c WHERE c.cd_estado = e.cd_estado AND c.cd_cidade = {$dados_aluno[0]['cd_cidade']};");?>
                <form action="php/editarCidade.php" method="POST" name="editarCidadeForm" id="cidadesForm">
                        <table id="table_form">
                            <tr>
                                <td class="td_left"> <h1>Estado:</h1> </td>
                                <td colspan="2">   <?php echo $cidade_usuario[0]['sg_estado'];?> </td>
                                <td colspan="2"> 
                                    <select name="estado" id="estado">
                                        <?php foreach($sessao["estados"] as $estado) { ?>
                                            <option value="<?php echo $estado["cd_estado"]; ?>">
                                                <?php echo "{$estado["sg_estado"]}"; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left"> <h1>Cidade: </h1></td>
                                <td colspan="2">   <?php echo $cidade_usuario[0]['nm_cidade'];?> </td>
                                <td colspan="2">
                                    <select name="cdCidade" id="cidade">
                                        <option value="">Selecione o estado</option>
                                    </select> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"> <input id="envia" type="submit" value="Alterar cidade" style="position:relative; left:70%;"> </td>
                            </tr>
                        </table> 
                    </form>
      			<?php } ?>

              
                <table id="table_form"> 
                	<tr>
                    	<td class="td_left"> <h1 style=" margin-left:-25px;"> Instituição de Ensino: </h1> </td>
                    </tr>
                    <tr>    
                        
                        <td colspan="2"> 
          <?php if(isset($aluno_matriculado) and sizeof($aluno_matriculado) > 0) { ?>
                <?php foreach($aluno_matriculado as $matricula) { ?>
                    <p><?php echo $matricula["nm_escola"]; ?></p>
                <?php } ?>
           <?php } else { ?>
            <p>Você não está matriculado em nenhuma instituição de ensino.</p>
            <?php } ?>                        </td>
                	</tr>
                    <Tr>
                    	<td colspan="2" style=" float:right;width:500px;"> Mudar sua instituição de ensino?    </td>
                    </Tr> 
                </table>
                
				
				<div id="escola" style="display:none;">
					<form action="php/editarMatricula.php" method="POST" name="editarMatriculaForm" id="matriculaForm">
                    
                    <table id="table_form">
                    	<Tr>
                        	<td class="td_left"> <h1> Instituição de Ensino: </h1> </td>
                            <td colspan="2">
                                <?php if($sessao["tipoConta"] == "A") { ?>
                                    <select name="cdEscola">
                                        <?php foreach($sessao["escolas"] as $escola) { ?>
                                            <option value="<?php echo $escola["cd_escola"]; ?>">
                                                <?php echo $escola["nm_escola"]; ?>
                                            </option>
                                        <?php } ?>
                                        <!--option value="outra">Outra...</option-->
                                    </select>
                                <?php } ?>
                            </td>
                        </Tr>
                    </table>
				
					<input id="envia" type="submit" value="Alterar Instituição" >
    				</form>
				</div>
            <?php } ?>   
                
                
               <header class="UltimosTrabalhos">
                	<div class="latest_posts"> 
                    	<h1><img src="images/perfil_usuario/monografias.png" width="20px"> Meus trabalhos </h1>
                    </div>   	
                </header>
                
                <div id="form_monografias">
                	
                    <a href="publicar.php">
                        <div class="form_cada_monografia" id="form_postar_monografia">
                            <h1> Publicar monografia </h1>
                        </div>
                    </a>
                    <?php foreach($trabalhos as $trabalho) { ?>
                        <div class="form_cada_monografia">
                        	<a href="trabalho.php?t=<?php echo $trabalho["cd_trabalho"]; ?>"> 
                            	<img src="images/close.png" style="float:right; margin:-10px -10px 0 0">
                            </a>
                        	<div class="form_imagem_monografia"> </div>
                            <h1><?php echo $trabalho["nm_titulo"]; ?></h1>
                        </div>
                    <?php } ?>
                    
                    <div style="width:100%; clear:both;"></div>
                </div>
                <?php if(isset($favoritos) && sizeof($favoritos) > 0) { ?>
                <header class="UltimosTrabalhos">
                	<div class="latest_posts"> 
                    	<h1><img src="images/perfil_usuario/favoritos.png" width="20px"> Meus favoritos </h1>
                    </div>   	
                </header>
            
                <div id="form_favoritos">
                    <?php foreach($favoritos as $trabalho) { ?> 
                        <div class="form_cada_favorito"> 
                            <img src="images/close.png" style="float:right; margin:-10px -10px 0 0" onclick="javascript:rmFavorito(<?php echo $trabalho["cd_trabalho"]; ?>,this);">
                            <div class="form_imagem_favorito"> </div>
                            <h1> <?php echo $trabalho["nm_titulo"]; ?></h1>
                        </div>
                    <?php } ?>
                    <div style="width:100%; clear:both;"></div>
                </div>
            <?php } ?>
</div>  
                </div>
            </div>
       

     </section>
     <?php include "footer.php"; ?>
     <script type="text/javascript" src="js/jquery-ui-1.10.4.min.js"></script>
     <script src='js/mudaFoto.js'></script>
</body>
</html>