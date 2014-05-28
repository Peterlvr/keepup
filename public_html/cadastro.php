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
        <meta charset="UTF-8">
        <title>Cadastro - Keep Up</title>
    	<script type="text/javascript" src="js/prototype.js"></script>
    	<script type="text/javascript">
		function CarregaCidades(codEstado)
		{
			if(codEstado){
				var myAjax = new Ajax.Updater('cidadeAjax','php/carrega_cidades.php?codEstado='+codEstado,
				{
					method : 'get',
				}) ;
			}
			
		}
		</script>
    	<script type="text/javascript" src="js/jquery.js"></script>
    	<script type="text/javascript">
    	jQuery.noConflict();
    	</script>
    	
    </head>
    <body>
    	<?php require("header.php"); ?>
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
					<select name="estado" id="estado" onchange="CarregaCidades(this.value)">
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
				<div id="cidadeAjax">
      			<select name="cdCidade" id="cidade">
      			<option value="">Selecione o estado</option>
    			</select>
    			</div>
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
					<input type="date" name="dtNascimento">
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
		</form>
		<?php include 'footer.php'; ?>
	</body>
</html>
<script type="text/javascript" src="js/cadastro.js"></script>
