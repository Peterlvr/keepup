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
    	<section id="erro_form">
				<?php if(isset($e)){ echo $e; } ?>
			</section>

			<form action="php/upload_file.php" method="post" enctype="multipart/form-data">
			<label for="file">Foto:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Enviar Foto de Perfil">
			</form>
    			
		<form action="php/editarperfil.php" method="POST" id="editarPerfilForm">
			<section id="painelUsuario">
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
					<label>Senha:</label>
				</p>
				<p>
					<label>Confirmar senha:</label>
				</p>	
				<p>
					<label>Data de Nascimento:</label>
				</p>
				<p>
					<input type="date" name="dtNascimento" value="<?php echo $dt_nascimento; ?>">
				</p>		
			</section>
						
			<input id="envia" type="submit" value="Enviar" >
		</form>
	</body>
</html>