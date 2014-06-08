<?php # Visão 'publicar'
require "../sessao.php";
if($logado) {
	require "../conexao.class.php";
	$con = new Conexao();
	$sessao["cursos"] = $con->consultar(
		"SELECT nm_curso, cd_curso
		from curso");
	$sessao["escolas"] = $con->consultar(
		"SELECT nm_escola, cd_escola
		from escola");
	$sessao["alunos"] = $con->consultar(
		"SELECT nm_aluno, cd_aluno
		from aluno");
}
else {
	header("location:./");
}

$msg = "";
if(isset($_GET["e"])) {
	switch($_GET["e"]) {
		case 6:
			$msg = "Você não pode publicar um trabalho que não é seu!";
			break;
		default:
			$msg = "Erro indefinido";
	}
}

if(isset($_GET["status"]) && $_GET["status"] == "sucesso") {
	$msg = "Publicação realizada com sucesso!";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Publicar trabalho - Keep Up</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	<link href="cs/estilo_index.css" rel="stylesheet" type="text/css" />
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <link href="cs/estilo_publicar.css" rel="stylesheet" type="text/css"/>
    <script src="js/script.js" type="text/javascript"> </script>
    <script src="js/publicar.js" type="text/javascript"> </script>
</head>

<body>
	<?php include_once("header.php") ?>
    
    
    <section id="section2">
            
            <article id="formulario_publicar">
				<aside id="asideLeft">
                    			<?php echo $msg; ?>
			<form enctype="multipart/form-data" action="php/publicar.php" method="POST">
				<header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts"> <h1> Publicar trabalho </h1> </div>
                </header>
                
                <table id="table_publicar_1">
                        	<tr>
                            	<td>
                                	<h1> Dê ao seu trabalho um título </h1>
                                    <input id="txtTituloMonografia" name="nmTitulo" required><br>

                                    <cite> Em algumas palavras, sobre o que é seu trabalho? </cite>
                                </td>
                            </tr>
                          	<tr>
                            	<td>
                                	<h1> Descreva seu projeto </h1>
                                    <textarea required rows="8" cols="80" id="txtTituloMonografia"  name="dsResumo"></textarea><br>
                                    <cite> Em algumas palavras, sobre o que é seu trabalho? </cite>
                                </td>
                            </tr>
                            <tr>
                            	<td> 
                                	<h1> Palavras-chave </h1>
                                    <input  id="txtTituloMonografia" name="tx_pchaves" required></input><br>
                                     <cite> Escreva , no mínimo, três palavras-chave para o seu trabalho  </cite>
                                </td>
                            </tr>
                             <tr>
                            	<td>
                                	<h1> Escolha o curso </h1>
                                    <select required id="txtTituloMonografia" name="cdCurso">
	                                    <option ></option>
										<?php foreach($sessao["cursos"] as $curso) { ?>
                                            <option value="<?php echo $curso["cd_curso"]; ?>">
                                                <?php echo $curso["nm_curso"]; ?>
                                            </option>
                                        <?php } ?>
                                        <!--option value="outro">Outro...</option-->
                                    </select>	
                                </td>
                            </tr>
                            <tr>
                            	<td>
                                	<h1> Nome dos autores </h1>
                                    <div id="cdAluno">
                                    <select id="txtTituloMonografia" name="cdAluno1" class="cdAluno">
										<?php foreach($sessao["alunos"] as $aluno) { ?>
                                            <option value="<?php echo $aluno["cd_aluno"]; ?>">
                                                <?php echo $aluno["nm_aluno"]; ?>
                                            </option>
                                        <?php } ?>
                                        <!--option value="outra">Outra...</option-->
                                    </select>
                                    </div>
                                    <input  id="adicionarAutor" type="button" value="+ Adicionar autor"><br>

                                    <cite> Rlx se ele não tiver perfil a gnt dar um jeito </cite>
                                </td>
                            </tr>
                             <tr>
                            	<td>
                                	<h1> Instituição de ensino </h1>
                                   <?php if($sessao["tipoConta"] == "A") { ?>
                                        <select id="txtTituloMonografia" name="cdEscola">
                                        <option ></option>
                                            <?php foreach($sessao["escolas"] as $escola) { ?>
                                                <option value="<?php echo $escola["cd_escola"]; ?>">
                                                    <?php echo $escola["nm_escola"]; ?>
                                                </option>
                                            <?php } ?>
                                            <!--option value="outra">Outra...</option-->
                                        </select>
                                    <?php } ?>
                                    <?php if($sessao["tipoConta"] == "E") { ?>
                                        <select  id="txtTituloMonografia" name="cdEscola" disabled>
                                            <option value="<?php echo $sessao["cd_escola"]; ?>">
                                                <?php echo $escola["nome"]; ?>
                                            </option>
                                        </select>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                            	<td> 
                                	<h1> Em que ano esse trabalho foi apresentado?</h1>
                                    <input id="txtTituloMonografia" name="aaPublicacaoReal" size="4" required pattern="[0-9]{4}" title="AAAA" placeholder="AAAA"><br>
                                </td>
                            </tr>
                            <tr>
                            	<td> 
                                	<h1> Selecionar trabalho </h1>
                                  <input required type="file" name="arquivoPrincipal"> <br>
	
                                </td>
                            </tr>
                             <tr>
                            	<td>
                                <h1> Selecionar capa do trabalho </h1>
                                	<div class="inputFile">
                                    	<span><h1>Selecione um arquivo</h1></span>
                                    	<input type="file" name="arquivo" id="arquivo" /> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="2" style="text-align:center;">
                            	<input id="btnPublicarTrabalho"type="submit">
                                </td>
                            </tr>
				</table>
               </form>
                </aside>
		</aside>
        
        		
        <aside id="asideRight" class="etapa_pub">
                	<header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts" style="margin:-10px auto auto auto"> <h1>  Dicas para uma boa apresentação </h1> </div>
                </header>
                    <p>
                   <b>Seja descritivo </b>- Expresse o mais claramente possível o conteúdo do seu trabalho no campo de resumo.
					</p>
                    <p>
                   <b>Prenda a atenção </b>- Dê ao leitor uma reforço visual para transmitir sua mensagem, se cabível utilize uma boa imagem de capa do trabalho.
                    </p>
                    <p>
                   <b>Seja instigante </b>- Provoque a curiosidade do leitor, utilize de artimanhas para prender sua atenção por questionamentos. 
                    </p>
                </aside>
                
                <aside id="asideRight" style="margin-top:5%;" class="etapa_pub">
                	<header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts"> <h1>  Uma imagem vale mais que mil palavras </h1> </div>
                </header>
                    <p>
                        Trabalhos com imagens de qualidade são significamente mais atraentes do que sem.
                    </p>
                    <p>
                        Para sua precaução, use imagens originais ou as padrões do Keep Up para previnir reclamações por direitos autorais.
                    </p>
                </aside>
                <div style="width:100%; clear:both;"> </div>
            </article>
     </section>
    
	<?php include_once("footer.php") ?>

</body>
</html>