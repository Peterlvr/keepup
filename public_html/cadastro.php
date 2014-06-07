<?php # Visão 'cadastro'
require("../sessao.php");
if($logado) {

}
require "../conexao.class.php";

$con = new Conexao();
$sessao["estados"] = $con->consultar("SELECT * FROM estado")

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
    <link href="js/jquery-ui-1.10.4.css" type="text/css" rel="stylesheet">
    <script src="js/jquery.js" type="text/javascript"> </script>
    <script src="js/jquery-1.10.2.js" type="text/javascript"> </script>
    <script src="js/jquery-ui-1.10.4.js" type="text/javascript"> </script>
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
        <h1>Cadastre-se</h1>
        <form action="php/cadastro.php" method="POST" id="cadastroForm">
            <section id="painelUsuario">
                <p>
                    <label>Nome de usuário:</label>
                </p>
                <p>
                    <input placeholder="Nome de usuário" type="text" name="nmLogin" pattern="[a-zA-Z0-9]{3,30}" title="Deve conter de 3 a 30 caracteres alfanuméricos." required>
                </p>
                <p>
                    <label>Senha <small>(mínimo de 8 caracteres; pelo menos uma letra e um dígito; diferencia maiúsculas e minúsculas)</small>:</label>
                </p>
                <p>
                    <input placeholder="Senha" type="password" name="nmSenha" id="senha" required title="Insira uma senha com pelo menos 8 caracteres e ao menos uma letra e um número." pattern="^(?=.*\d)(?=.*[a-zA-Z])(?!.*\s).*$">
                </p>
                <p>
                    <label>Digite a senha novamente:</label>
                </p>
                <p>
                    <input placeholder="Senha" type="password" id="confirmaSenha" required>
                </p>
                <p>
                    <label>E-mail:</label>
                </p>
                <p>
                    <input placeholder="exemplo@email.com" type="email" name="nmEmail" required>
                </p>
                <p>
                    <label>Estado:</label>
                </p>
                <p>
                    <select name="estado" id="estado">
                        <?php foreach($sessao["estados"] as $estado) { ?>
                            <option value="<?php echo $estado["cd_estado"]; ?>">
                                <?php echo "{$estado["sg_estado"]}"; ?>
                            </option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <label>Cidade:</label>
                </p>
                <select name="cdCidade" id="cidade">
                    <option value="">Selecione o estado</option>
                </select>
            </section>
            <section id="tipoForm">
                <p>
                    <label>Tipo de perfil:</label>
                </p>
                <p>
                    <input name="rbTipo" value="A" id="rbTipoA" type="radio"> <label>Estudante</label>
                </p>
                <p>
                    <input name="rbTipo" value="E" id="rbTipoE" type="radio"> <label>Instituição de ensino</label>
                </p>
            </section>
            <section id="painelAluno" class="condicional">
                <p>
                    <label>Seu nome:</label>
                <p>
                    <input placeholder="Seu nome" type="text" name="nmAluno">
                </p>
                <p>
                    <label>Quando você nasceu?</label>
                </p>
                <p>
                    <input type="text" id="dtNascimento" name="dtNascimento">
 <script>
$(function() {
$( "#dtNascimento" ).datepicker();
});
</script>
                </p>
            </section>
            <section id="painelEscola" class="condicional">
                <p>
                    <label>Nome da instituição:</label>
                </p>
                <p>
                    <input placeholder="Nome da instituição" type="text" name="nmEscola">
                </p>
                <p>
                    <label>CNPJ <small>(apenas números)</small>:</label>
                </p>
                <p>
                    <input placeholder="CNPJ" type="text" name="cdCNPJ" title="Insira apenas números." pattern="[0-9]{14}">
                </p>
            </section>
            <section id="final">
                <input type="hidden" value="false" name="jsAtivo" id="jsAtivo">
                <input id="envia" type="submit" value="Enviar" disabled="true">
            </section>
            <section id="erro_form">
                <?php if(isset($e)){ echo $e; } ?>
            </section>
            <script type="text/javascript" src="js/cadastro.js"></script>
        </form>
                </aside>
		</aside>
                
                <aside id="asideRight" class="etapa_pub">
                    <header class="UltimosTrabalhos" style="background-color:white;">
                          <div class="latest_posts"> <h1>Dicas de preenchimento</h1> </div>
                </header><p>
1) Aqui começa sua jornada para ter sua monografia no Keep Up. Use sua conta para pesquisar, avaliar monografias e perfis de outros usuários, além de favoritar suas teses favoritas.
</p><p>
2) Você pode preencher seu nome completo ou o apelido pelo qual você gosta de ser lembrado. Lembre-se: Em TODAS as etapas do cadastro, TODOS os campos são de preenchimento obrigatório.
</p><p>
3) Algumas vezes você é mais conhecido entre os usuários pelo seu apelido, então vamos aproveitar isto aqui.
</p><p>
4) Lembre de ler os Termos de compromisso e só avance se concordar.
</p>
                </aside>
                
                <div style="width:100%; clear:both;"> </div>
            </article>
     </section>
    
	<?php include_once("footer.php") ?>

</body>
</html>