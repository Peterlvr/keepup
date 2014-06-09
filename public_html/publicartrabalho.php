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

if(isset($_GET["e"]) && $_GET["e"] == "7") {
    $msg = "Insira um arquivo PDF.";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Publicar trabalho acadêmico</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
    <link href="cs/estilo_index.css" rel="stylesheet" type="text/css" />
    <link href="cs/global.css" rel="stylesheet" type="text/css" />
    <link href="cs/estilo_publicar.css" rel="stylesheet" type="text/css"/>
    <link href="js/jquery-ui-1.10.4.min.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.js" type="text/javascript"> </script>
    <script src="js/jquery-ui-1.10.4.min.js" type="text/javascript"> </script>
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
                <h1>Publicar trabalho</h1>
                <p>
                    <label for="nmTitulo">Título:</label>
                </p>
                <p>
                    <input name="nmTitulo" required>
                </p>
                <p>
                    <label for="cdCurso">Para qual curso?</label>
                </p>
                <p>
                    <select name="cdCurso">
                        <?php foreach($sessao["cursos"] as $curso) { ?>
                            <option value="<?php echo $curso["cd_curso"]; ?>">
                                <?php echo $curso["nm_curso"]; ?>
                            </option>
                        <?php } ?>
                        <!--option value="outro">Outro...</option-->
                    </select>
                </p>
                <p>
                    <label for="cdEscola">Para qual instituição?</label>
                </p>
                <p>
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
                    <?php if($sessao["tipoConta"] == "E") { ?>
                        <select name="cdEscola" disabled>
                            <option value="<?php echo $sessao["cd_escola"]; ?>">
                                <?php echo $escola["nome"]; ?>
                            </option>
                        </select>
                    <?php } ?>
                </p>
                <p>
                    <label for="cdAluno">Cite os autores:</label>
                </p>
                <?php if($sessao["tipoConta"] == "E") { ?>
                    <p id="cdAluno">
                        <select name="cdAluno1" class="cdAluno">
                            <?php foreach($sessao["alunos"] as $aluno) { ?>
                                <option value="<?php echo $aluno["cd_aluno"]; ?>">
                                    <?php echo $aluno["nm_aluno"]; ?>
                                </option>
                            <?php } ?>
                            <!--option value="outra">Outra...</option-->
                        </select>
                    </p>
                <?php } else { ?>
                    <p>
                        <input type="hidden" name="cdAluno1" value="<?php echo $sessao["cd"]; ?>">
                        <?php echo $sessao["nome"]; ?>
                    </p>
                    <p id="cdAluno">
                        <select class="cdAluno" id="cdAluno1" disabled style="display:none">
                            <?php foreach($sessao["alunos"] as $aluno) { ?>
                                <option value="<?php echo $aluno["cd_aluno"]; ?>">
                                    <?php echo $aluno["nm_aluno"]; ?>
                                </option>
                            <?php } ?>
                            <!--option value="outra">Outra...</option-->
                        </select>
                    </p>
                <?php } ?>
                <p>
                    <input type="button" id="adicionarAutor" value="+ autor">
                </p>
                <p>
                    <label for="aaPublicacaoReal">Em que ano esse trabalho foi apresentado?</label>
                </p>
                <p>
                    <input name="aaPublicacaoReal" size="4" required pattern="[0-9]{4}" title="AAAA" placeholder="AAAA">
                </p>
                <p>
                    <label for="dsResumo">Faça um resumo do seu trabalho acadêmico para fácil visualização <small>(a Introdução do trabalho pode servir)</small>:</label>
                </p>
                <p>
                    <textarea name="dsResumo" required></textarea>
                </p>
                <p>
                    <label for="tx_pchaves">Palavras-chave <small>(mínimo 3; separadas por ponto)</small>:</label>
                </p>
                <p>
                    <input type="text" name="tx_pchaves" required pattern="^[^\.]+\.[^\.]+\.[^\.]+$" title="Digite no mínimo 3 palavras-chave, separadas por pontos finais.">
                </p>
                <p>
                    <label for="arquivoPrincipal">Insira o documento principal do trabalho (em PDF):</label>
                </p>
                <p>
                    <input type="file" required name="arquivoPrincipal">
                </p>
                <p>
                    <input type="submit" value="Publicar">
                </p>
            </form>
                </aside>
        </aside>
                
                <aside id="asideRight" class="etapa_pub">
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