<?php if(!$logado) { ?>
	<script src="js/loginBox.js"></script>
    <div id="bg_login">
        <div id="login_box">
    		<section id="login">
    			<aside>
    				<p>
    					<a href="#" class="login_link">[x]</a>
    				</p>
    			</aside>
    		<form action="php/login.php" method="POST">
            	<input type="hidden" name="de" value="javascript:location.href">
                    <table>
                        <tr>
                        	<td> <label for="nmLogin">Nome de usuário:</label> </td>
                            <td> <input name="nmLogin" type="text" placeholder="Nome de usuário" required> </td>
                        </tr>
                        <tr>
                        	<td> <label for="nmSenha">Senha:</label> </td>
                            <td> <input name="nmSenha" type="password" placeholder="Senha" required> </td>
                        </tr>
                        <Tr>
                        	<Td colspan="2"> <input type="submit" /></Td>
                        </Tr>
                    </table>
    		</form>
    		</section>
    	</div>
    </div>
<?php } ?>
	<header>
   		<a href="Index.html"> <div id="logo"> </div>  </a>
        
        <div class="nav"> 
            

				<a href="./"><div class="bot_nav">Página inicial</div></a>

				<a href="explore.php"> <div class="bot_nav"> Explore </div></a>

			<?php if(!$logado) { ?>

					<a href="cadastro.php"><div class="bot_nav">Cadastro</div></a>

			<?php } ?>
			<?php if($logado) { ?>

					<a href="publicar.php"><div class="bot_nav"> Publicar </div></a>

					<a href="favoritos.php"><div class="bot_nav"> Favoritos </div></a>

			<?php } ?>
            <a href="ajuda.php"> <div class="bot_nav"> Ajuda </div> </a>

        </div>
    <?php if($logado) { echo "<a href='usuario.php?u={$sessao["cd"]}'>"; } ?>
    	<div id="foto_usuario_menu">
          		
                       
		<?php if($logado) { ?>
                        <div id="quadrado_foto_usuario_menu">
                        <?php
			if($_SESSION['url_avatar'] <> '') {
				echo "<img src='images/upload/{$sessao["cd_aluno"]}/{$_SESSION['url_avatar']}' style='width:50px; height:50px' >";
			}
			else {
				echo "<img src='images/default/usericon.png' width='40px' alt=''>";
			}?>
                        </div>
                        <p> <?php echo $sessao["nome"]; ?> </p> 
<?php } ?>
		<?php if(!$logado) { ?>
			
				<a href="#" class="login_link">
                	<div class="bot_nav" id="alogin">Login</div></a>
			
		<?php } ?>
        </div>
        <?php if($logado) echo "</a>"; ?>
        	<?php if($logado) { ?>
    		<div id="configuracoes_menu"> </div>
            	<div id="configuracoes_aberto"> 
                	<table>
                    	<tr>
                        	<a href="editarUser/editarUser.html">
                            <td class="conf_aberto_classe" style="cursor:pointer" onClick="location.href='editarperfil.php'"> <p> Editar perfil </p> </td>
                            </a>
                        </tr>
                         <tr>             
                          	<td class="conf_aberto_classe" style="cursor:pointer" onclick="location.href='php/logout.php'"> <p> Sair </p> </td>
                        </tr>
                    </table>
                </div>
                <?php } ?>
       		<div id="pesquisa_menu"></div>
    	
    </header>
     <div id="pesquisa_aberto">
        <form method="GET" action="explore.php">
            <table id="table_pesquisa">
                <tr>
                    <td> <input type="text" id="txtPesquisa" name="pesquisa" placeholder="Pesquise sua monografia aqui..." /> </td>
                    <td> <input type="submit" value="Pesquisar" id="btnPesquisar" /> </td>
                </tr>
            </table>
        </form>
     </div>