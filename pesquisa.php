<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pesquisa </title>
</head>

<body>
<form name="pesquisa" method="GET" action="">
<input type="text" name="pesquisa" /> <input type='submit' value='buscar' /> 
</form>

<?php 
//quando o campo pesquisa está preenchido ele executa o GET
if(isset($_GET['pesquisa']) and $_GET['pesquisa'] <> '')
{
	//a pesquisa é separada por termos(palavras pesquisadas)
	$termos = explode(' ', $_GET['pesquisa']);
	//contagem dos termos
	$num = count($termos);
	//string pesquisa na TABELA quando...
	$pesquisar = "SELECT * FROM curso WHERE ";
	
	for($i=0; $i<$num; $i++)
	{
		// adiciona a string de pesquisa cada termos desde que ele corresponda a todos os termos pesquisados
		$pesquisar .= "nm_curso LIKE '%".$termos[$i]."%'  ";
		if($i<>$num-1) 
			{ 
				$pesquisar .= " AND "; 
			}
	}
	
	//conecta ao banco
	mysql_connect("localhost", "root", "root") or die("nao conecta");
	mysql_select_db("keepup") or die ('sem banco');

	//executa a busca pelas palavras
	$pesquisando = mysql_query($pesquisar) or die("erro");
	//conta o resultado da busca
	$linhas = mysql_num_rows($pesquisando);
	
	//existindo resultado da busca são exibidos na tela 
	if($linhas>0)
	{
		while($row = mysql_fetch_array($pesquisando))
		{	
			echo $row['nm_curso'].'<br/>';
		}
	}
	else 
	{
		echo "Sem resultados";
	}

}

?>
</body>