
<?php if(!$logado) { ?>
	<script src="js/loginBox.js"></script>
	<div id="login_box" style="display: none">
		<section id="login">
			<aside>
				<p>
					<a href="#" class="login_link">[x]</a>
				</p>
			</aside>
			<form action="php/login.php" method="POST">
				<input type="hidden" name="de" value="javascript:location.href">
				<p>
					<label for="nmLogin">Nome de usuário:</label>
					<input name="nmLogin" type="text" placeholder="Nome de usuário" required>
				</p>
				<p>
					<label for="nmSenha">Senha:</label>
					<input name="nmSenha" type="password" placeholder="Senha" required>
				</p>
				<input value="Enviar" type="submit">
			</form>
		</section>
	</div>
<?php } ?>
<header>
	<div>le logo</div>
	<nav>
		<ul>
			<li>
				<a href="./">Página inicial</a>
			</li>
			<li>
				<a href="explore.php">Explore</a>
			</li>
			<?php if(!$logado) { ?>
				<li>
					<a href="cadastro.php">Cadastro</a>
				</li>
			<?php } ?>
			<?php if($logado) { ?>
				<li>
					<a href="publicar.php">Publicar</a>
				</li>
				<li>
					<a href="favoritos.php">Favoritos</a>
				</li>
			<?php } ?>
		</ul>
	</nav>
	<section id="usuario">
		<?php if($logado) { 
			if($_SESSION['url_avatar'] <> '') {
				echo "<img src='images/upload/{$sessao["cd_aluno"]}/{$_SESSION['url_avatar']}' style='width:50px; height:50px' >";
			}
			else {
				echo "Edite seu perfil e insira uma foto.";
			}?>
			<p>
				<?php echo $sessao["nome"]; ?>
			</p>
			<ul>
				<li>
					<a href="editarperfil.php">Editar perfil</a>
				</li>
				<li>
					<a href="php/logout.php">Sair</a>
				</li>
			</ul>
		<?php } ?>
		<?php if(!$logado) { ?>
			<p>
				<a href="#" class="login_link">Login</a>
			</p>
		<?php } ?>
	</section>
</header>