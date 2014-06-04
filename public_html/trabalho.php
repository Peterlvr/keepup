<?php
require("../sessao.php");
require("../conexao.class.php");
$conexao = new Conexao();	

$cd_trabalho = $_GET['t'];

$comando = "SELECT * FROM trabalho WHERE cd_trabalho = $cd_trabalho";
$trabalho = $conexao->consultar($comando);

$cd_escola = $trabalho[0]['cd_escola'];

$comando = "SELECT nm_escola FROM escola WHERE cd_escola = $cd_escola";
$escola = $conexao->consultar($comando);

if($logado and isset($_SESSION["cd_aluno"])) {
	$codigo_aluno = $_SESSION["cd_aluno"];

	$comando = "SELECT * FROM aluno WHERE cd_aluno = $codigo_aluno";
	$dados_aluno = $conexao->consultar($comando);	
}

$comando =
    "SELECT
        al.nm_aluno 'nome', al.cd_usuario 'cdUser', al.cd_aluno 'cd', al.nm_url_avatar 'urlAvatar',
        c.nm_curso 'nmCurso'
    FROM
        autoria au, trabalho t, aluno al, curso c
    WHERE
        t.cd_trabalho = $cd_trabalho and
        au.cd_trabalho = t.cd_trabalho and
        au.cd_aluno = al.cd_aluno and
        t.cd_curso = c.cd_curso";
    
$autores = $conexao->consultar($comando);
$autorDoTrabalho = false;
$_SESSION['ultimoTrabalhoVisitado'] = $cd_trabalho;

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de Trabalho</title>
   </head>
    <body>
        <?php include("header.php");?>
    	<h1>Pagina de Trabalho</h1>
		
		<p>Titulo do trabalho: <?php echo $trabalho[0]['nm_titulo']; ?></p>
        <p><a href="docs/<?php echo $cd_trabalho; ?>/main.pdf">Clique baixar ler o trabalho completo</a></p>

    	<p>Resumo: <?php echo $trabalho[0]['ds_resumo'];?></p>

    	
    	<p>Curso: <?php echo $autores[0]['nmCurso'];?> </p>
    	<p>Avaliacao: </p>
    	<p>Palavras-chave: </p>
    	<p>Autores: <?php 
           foreach ($autores as $autor) {
            if ($logado and $autor['cdUser'] == $_SESSION['cd_usuario']) { $autorDoTrabalho = true; }
                echo "<a href='usuario.php?u={$autor['cd']}'>";
                if($autor['urlAvatar'] <> '') { 
                    echo "<img id='fotoUsuario' src='images/upload/{$autor['cdUser']}/{$autor['urlAvatar']}' style='width: 100px; height:100px;'>";
                }
                else {
                    echo "<img id='fotoUsuario' src='images/default/usericon.png' style='width: 100px; height:100px;'>"; 
                }
                echo "{$autor['nome']}</a><br/>";
                }
        ?></p>
    	<p>Instituicao: <?php echo $escola[0]['nm_escola'];?></p> 
    	<h2>Comentarios</h2>
    	<p>
    		<?php if($logado and isset($_SESSION['cd_escola'])) 
    				{ echo "Escola não pode comentar";}

    			  if(isset($dados_aluno) and $autorDoTrabalho == true)
                    { echo 'Você não pode comentar o próprio trabalho.';}

    			  if(!$logado) 
    				{ echo "Tu nao podes comentar. Pois, não estás logado.";}

                  if(isset($dados_aluno) and $autorDoTrabalho == false) 
                    {   echo $dados_aluno[0]['nm_aluno'];
                        echo "<form action='php/novoComentario.php' method='POST' id='novoComentarioForm'> 
                        <p><textarea placeholder='Comente este trabalho...' name='campoComentario' rows='8' cols='60'></textarea>
                        <input type='submit' value='Fazer comentário'></p> 
                        </form>";
                    } ?>
        </p>
        <p>
            <?php
                $con = new Conexao(); 
                $comentariosTrabalho = $con->consultar("SELECT c.cd_autor, al.nm_aluno, al.nm_url_avatar, c.tx_comentario, c.dt_comentario 
                    FROM aluno al, comentario c WHERE c.cd_autor = al.cd_aluno AND c.cd_trabalho = $cd_trabalho");
                foreach ($comentariosTrabalho as $comentario) {
                    echo "<p>";
                    if($comentario['nm_url_avatar'] == '')
                        { echo "<img id='fotoUsuario' src='images/default/usericon.png' style='width: 100px; height:100px;'>";}
                    else 
                        { echo "<img id='fotoUsuario' src='images/upload/{$comentario['cd_autor']}/{$comentario['nm_url_avatar']}' style='width: 100px; height:100px;'>";; }
                    $dataComentario = explode("-", $comentario['dt_comentario']);
                    $ano = $dataComentario[0];
                    $mes = $dataComentario[1];
                    switch ($mes) {
                        case '1':
                            $mes = "Janeiro";
                            break;
                        case '2':
                            $mes = "Fevereiro";
                            break;
                        case '3':
                            $mes = "Março";
                            break;
                        case '4':
                            $mes = "Abril";
                            break;    
                        case '5':
                            $mes = "Maio";
                            break;
                        case '6':
                            $mes = "Junho";
                            break;
                        case '7':
                            $mes = "Julho";
                            break;
                        case '8':
                            $mes = "Agosto";
                            break;
                        case '9':
                            $mes = "Setembro";
                            break;
                        case '10':
                            $mes = "Outubro";
                            break;
                        case '11':
                            $mes = "Novembro";
                            break;
                        case '12':
                            $mes = "Dezembro";
                            break;
                        default:
                            $mes = "Janeiro";
                            break;
                    }
                    $diaHora = $dataComentario[2];
                    $separa = explode(" ", $diaHora);
                    $dia = $separa[0];
                    $hora = substr($separa[1], 0, 5);
                    echo "{$comentario['nm_aluno']} <br/> $dia de $mes de $ano - $hora <br/> {$comentario['tx_comentario']}</p>";

                }
            ?>
        </p>
    	

    	<?php include "footer.php"; ?>
    </body>
    </html>