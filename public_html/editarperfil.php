<?php 
include "../conexao.class.php";
include "../sessao.php";

$con  = new Conexao();
// retirar dados da sessao

$_SESSION["login"]; //nm_login
$_SESSION["cd_usuario"];
$_SESSION["cd_aluno"];
$_SESSION["nome"];

$email_usuario = $con->consultar("SELECT nm_email FROM usuario WHERE cd_usuario = {$_SESSION['cd_usuario']}");

$dados_aluno = $con->consultar("SELECT * FROM aluno WHERE cd_aluno = {$_SESSION["cd_aluno"]}; ");

$dt_nascimento = $dados_aluno[0]['dt_nascimento'];


/*Nome: nm_aluno
Instituição: nm_escola 
Cidade: nm_cidade 
Email: nm_email (usuario)
*/
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil - Keep Up</title>
    </head>
    <body>
    	<?php include "header.php"; ?>
    	<section id="erro_form">
			<?php if(isset($e)){ echo $e; } ?>
		</section>
		<?php if($dados_aluno[0]['nm_url_avatar'] <> '')
			echo '<img id="fotoUsuario" src="images/upload/'.$sessao["cd_aluno"]."/".$dados_aluno[0]['nm_url_avatar'].'" style="width: 200px; height:200px;">';
		?>
		<form action="php/upload_file.php" method="post" enctype="multipart/form-data">
			<label for="file">Foto:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Enviar Foto de Perfil">
		</form>
    	<form action="php/editarconta.php" method="POST" id="editarContaForm">
    		<section id="painelConta">
    			<p>
					<h1>Configurações de login e senha:</h1>
				</p>
				<p>
					<label>Nome de login:</label>
				</p>
				<p>
					<input type="text" name="nomeConta" required>
				<p>
					<label>Senha:</label>
				</p>
				<p>
					<input type="text" name="senhaConta" required>
				</p>
				<p>
					<label>Confirmar senha:</label>
				</p>
				<p>
					<input type="text" name="confirmaSenhaConta" required>
				</p>
			</section>
    	</form>
		<form action="php/editarperfil.php" method="POST" id="editarPerfilForm">
			<section id="painelUsuario">
				<p>
					<h1>Dados pessoais:</h1>
				</p>
				<p>
					<label>Nome de aluno:</label>
				</p>
				<p>
					<input placeholder="Nome de Aluno" type="text" name="nmAluno" value="<?php echo $_SESSION["nome"]; ?>" required>
				</p>
				
				<p>
					<label>E-mail:</label>
				</p>
				<p>
					<input placeholder="exemplo@email.com" type="email" name="nmEmail" value="<?php echo $email_usuario[0]['nm_email']; ?>" required>
				</p>
				<p>
					<label>Data de Nascimento:</label>
				</p>
				<p>
					<input type="date" name="dtNascimento" value="<?php echo $dt_nascimento; ?>">
				</p>
				<p>
					<label>Instituicao de Ensino:</label>
				</p>
				<p>
					<input placeholder="Nome da instituicao" type="text" name="nmInstituica" value="Instituicao testando" required>
				</p>
				<p>
					<label>Profissao:</label>
				</p>
				<p>
					<input placeholder="Profissao" type="text" name="nmProfissao" value="Profissao testando" required>
				</p>
				<p>
					<label>Facebook:</label>
				</p>
				<p>
					<input placeholder="Endereco de Facebook" type="text" name="nmFb" value="<?php echo $dados_aluno[0]['nm_fb']; ?>" required>
				</p>
				<p>
					<label>Linkedin:</label>
				</p>
				<p>
					<input placeholder="Url para linkedin" type="text" name="nmLinkedin" value="<?php echo $dados_aluno[0]['tx_url_linkedin']; ?>" required>
				</p>
				<p>
					<label>Link externo:</label>
				</p>
				<p>
					<input placeholder="Url para site externo" type="text" name="nmUrlExterno" value="<?php echo $dados_aluno[0]['tx_url_externo']; ?>" required>
				</p>		
			</section>
						
			<input id="envia" type="submit" value="Enviar" >
		</form>
		<?php include "footer.php"; ?>
	</body>
</html>