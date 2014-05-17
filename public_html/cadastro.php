<?php # Visão 'cadastro'
require("../sessao.php");
if($logado) {

}
require "../conexao.class.php";

$con = new Conexao();
$sessao["cidades"] = $con->consultar("SELECT * FROM cidade");

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro - Keep Up</title>
    	<script src="js/jquery.js"></script>
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
					<label>Cidade:</label>
				</p>
				<p>
					<select name="cdCidade">
						<?php foreach($sessao["cidades"] as $cidade) { ?>
							<option value="<?php echo $cidade["cd_cidade"]; ?>">
								<?php echo "{$cidade["nm_cidade"]} - {$cidade["sg_estado"]}"; ?>
							</option>
						<?php } ?>
					</select>
				</p>
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
				<?php echo $e; ?>
			</section>
		</form>
		<script src="js/cadastro.js"></script>
	</body>
</html>