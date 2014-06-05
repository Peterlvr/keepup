<?php 
include "../conexao.class.php";
include "../sessao.php";

$con  = new Conexao();
// retirar dados da sessao
$sessao["estados"] = $con->consultar("SELECT * FROM estado");
$_SESSION["login"]; //nm_login
$_SESSION["cd_usuario"];
$_SESSION["cd_aluno"];
$_SESSION["nome"];
$sessao["tipoConta"];

$email_usuario = $con->consultar("SELECT nm_email FROM usuario WHERE cd_usuario = {$_SESSION['cd_usuario']}");

$dados_aluno = $con->consultar("SELECT * FROM aluno WHERE cd_aluno = {$_SESSION["cd_aluno"]}; ");

$dt_nascimento = $dados_aluno[0]['dt_nascimento'];

$sessao["escolas"] = $con->consultar("SELECT nm_escola, cd_escola FROM escola");

if($sessao["tipoConta"] == "A") {
$aluno_matriculado = $con->consultar("SELECT e.nm_escola 
		FROM escola e, matricula m, aluno al 
		WHERE al.cd_aluno = m.cd_aluno AND e.cd_escola = m.cd_escola AND al.cd_aluno = {$_SESSION['cd_aluno']}");
}
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editar Perfil - Keep Up</title>
        <script type="text/javascript" src="js/jquery.js"></script>
    	<script type="text/javascript" src="js/carregaCidade.js"></script>
    	<script language="javascript">
			$(document).ready(function () {
			    $('#mudaCidade').change(function () {
			      $('#cidades').fadeToggle(); });
			    $('#mudaMatricula').change(function () {
			    	$('#escola').fadeToggle();  });
	    	});
		
		</script>
    </head>
    <body>
    	<?php include "header.php"; ?>
    	<section id="erro_form">
			<?php if(isset($e)){ echo $e; } ?>
		</section>
		<?php if($dados_aluno[0]['nm_url_avatar'] <> '') {
			echo '<img id="fotoUsuario" src="images/upload/'.$sessao["cd_usuario"]."/".$dados_aluno[0]['nm_url_avatar'].'" style="width: 200px; height:200px;">';
		}?>
		<form action="php/upload_file.php" method="post" enctype="multipart/form-data">
			<label for="file">Foto:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="submit" value="Enviar Foto de Perfil">
		</form>
    	<form action="php/editarDados.php" method="POST" id="editarContaForm">
    		<section id="painelConta">
    			<p>
					<h1>Configurações de login e senha:</h1>
				</p>
				<p>
					<label>E-mail:</label>
				</p>
				<p>
					<input placeholder="exemplo@email.com" type="email" name="nmEmail" value="<?php echo $email_usuario[0]['nm_email']; ?>" required>
				</p>
				<p>
					<label> Para mudar seu e-mail digite sua senha e confirme </label>
				</p>
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
			<input id="envia" type="submit" value="Alterar dados pessoais" >
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
					<label>Data de Nascimento:</label>
				</p>
				<p>
					<input type="date" name="dtNascimento" value="<?php echo $dt_nascimento; ?>">
				</p>
				<p>
					<label>Sobre mim:</label>
				</p>
				<p>
					<textarea placeholder="Sobre mim..." name="sobreMim" ><?php echo $dados_aluno[0]['tx_bio']; ?></textarea>
				<p>
					<label>Profissao:</label>
				</p>
				<p>
					<input placeholder="Profissao" type="text" name="nmProfissao" value="<?php echo $dados_aluno[0]['nm_profissao'];?>" >
				</p>
				<p>
					<label>Facebook:</label>
				</p>
				<p>
					<input placeholder="Endereco de Facebook" type="text" name="nmFB" value="<?php echo $dados_aluno[0]['nm_fb']; ?>" >
				</p>
				<p>
					<label>Linkedin:</label>
				</p>
				<p>
					<input placeholder="Url para linkedin" type="text" name="nmLinkedin" value="<?php echo $dados_aluno[0]['tx_url_linkedin']; ?>" >
				</p>
				<p>
					<label>Link externo:</label>
				</p>
				<p>
					<input placeholder="Url para site externo" type="text" name="nmUrlExterno" value="<?php echo $dados_aluno[0]['tx_url_externo']; ?>" >
				</p>		
			</section>
						
			<input id="envia" type="submit" value="Alterar dados pessoais" >
		</form>
		</p>
				<?php if(isset($dados_aluno[0]['cd_cidade'])) { 
					$cidade_usuario = $con->consultar("SELECT e.sg_estado, c.nm_cidade 
					FROM estado e, cidade c WHERE c.cd_estado = e.cd_estado AND c.cd_cidade = {$dados_aluno[0]['cd_cidade']};");?>
				<p>
					<label>Estado:</label> <label><?php echo $cidade_usuario[0]['sg_estado'];?> </label>
				</p>
				<p>
					<label>Cidade:</label> <label><?php echo $cidade_usuario[0]['nm_cidade'];?></label>
				</p>
      			<?php } ?>

      			
      			Alterar sua cidade e estado? <input type="checkbox" id="mudaCidade"> 
				<div id="cidades" style="display:none;"> 
				<form action="php/editarCidade.php" method="POST" name="editarCidadeForm" id="cidadesForm">
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
	    			<input id="envia" type="submit" value="Alterar cidade" >
    			</form>
      			</div> 
				<p>
					<label>Instituição de Ensino:</label> 
					<label><?php if(isset($aluno_matriculado[0]['nm_escola'])) { echo $aluno_matriculado[0]['nm_escola']; }
					else { echo "Você não está matriculado em uma instituição de ensino.";} ?></label>
				</p>
				Mudar sua instituição de ensino? <input type="checkbox" id="mudaMatricula">
				<div id="escola" style="display:none;">
					<form action="php/editarMatricula.php" method="POST" name="editarMatriculaForm" id="matriculaForm">
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
					<input id="envia" type="submit" value="Alterar Instituição" >
    				</form>
				</div>
		<?php include "footer.php"; ?>
	</body>
</html>