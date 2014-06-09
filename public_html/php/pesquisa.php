<?php
# vamos usar a conexão mais tarde
require "../../conexao.class.php";

$conexao = new Conexao();

$pesquisa = "";
//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']))
{
	$pesquisa = $_GET["pesquisa"];
	//a pesquisa é separada por termos(palavras pesquisadas)
	$termos = explode(' ', $_GET['pesquisa']);
	//contagem dos termos
	$num = count($termos);

	$from = "FROM
			trabalho t,
			curso c,
			escola e";

	# condições WHERE para evitar repetições
	$where = "WHERE t.cd_curso = c.cd_curso AND
		e.cd_escola = t.cd_escola";

	if(isset($_GET["autor"])) {
		$from .= ", autoria au";
		$where .= " AND t.cd_trabalho = au.cd_trabalho";
	}

	$pesquisar =
		"SELECT
			t.cd_trabalho 'cd',
			t.nm_titulo 'titulo',
			t.ds_resumo 'resumo',
			c.nm_curso 'curso',
			t.aa_publicacao 'publicado_em',
			e.nm_escola 'escola'
		$from $where AND (";
	
	for($i=0; $i < $num; $i++) {
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "t.nm_titulo LIKE '%{$termos[$i]}%' OR ";
		$pesquisar .= "t.ds_resumo LIKE '%{$termos[$i]}%' OR ";
		$pesquisar .= "t.tx_pchave LIKE '%{$termos[$i]}%' ";

		if($i < $num - 1) {
			$pesquisar .= " OR ";
		}
	}

	$pesquisar .= ")";

	if(isset($_GET["curso"])) {
		$pesquisar .= " AND t.cd_curso = {$_GET["curso"]}";
	}

	if(isset($_GET["escola"])) {
		$pesquisar .= " AND t.cd_escola = {$_GET["escola"]}";
	}

	if(isset($_GET["autor"])) {
		$pesquisar .= " AND au.cd_aluno = {$_GET["autor"]}";
	}

	$pesquisando = $conexao->consultar($pesquisar);
	
	$cursos = array();
	foreach($pesquisando as $row) {
		$jaFoi = false;
		foreach($cursos as $curso) {
			if($row["curso"] == $curso){
				$curso[1]++;
				$jaFoi = true;
			}
		}
		if(!$jaFoi)
			array_push($cursos, array($row["curso"], 1));
	}
}


?>
<h1> Resultados para "<?php echo $pesquisa; ?>"</h1>
<?php if(isset($pesquisando[0])) { ?>
	<?php foreach($pesquisando as $row)	{ ?>
        <a href="trabalho.php?t=<?php echo $row["cd"]; ?>">
            <div class="cada_monografia">
                <div class="cada_titulo_monografia"> 
                    <h1><?php echo substr($row["titulo"], 0, 50) . "..."; ?></h1>
                </div>
                <div class="img_cada_monografia"> </div>
                
                <div class="cada_resumo">
                    <p><?php echo substr($row["resumo"], 0, 300) . "..."; ?></p>
                </div>
                <!-- <?php echo $row["curso"]; ?>, <?php echo $row["publicado_em"]; ?> -->
            </div>
		</a>
	<?php } ?>
<?php } else { ?>
	<p>Sem resultados</p>
<?php } ?>

