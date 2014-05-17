
<?php if(!$logado) { ?>
	<script src="js/loginBox.js"></script>
	<div id="login_box">
		<section id="login">
			<aside>
				<p>
					<a href="#" class="login_link">[x]</a>
				</p>
			</aside>
			<form action="php/login.php" method="POST">
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
		<?php if($logado) { ?>
			<img src="<?php echo $sessao["imgUsuario"]; ?>" alt="">
			<p>
				<?php echo $sessao["nome"]; ?>
			</p>
			<ul>
				<li>
					<a href="#">Editar perfil</a>
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