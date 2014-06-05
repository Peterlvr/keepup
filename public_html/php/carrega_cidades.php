<?php
include "../../conexao.class.php";

$codEstado = $_GET['codEstado'];

$con = new Conexao();

$sessao["cidades"] = $con->consultar("SELECT * FROM cidade  WHERE cd_estado=$codEstado");

?>
<?php foreach($sessao["cidades"] as $cidade) { ?>
	<option value="<?php echo $cidade["cd_cidade"]; ?>">
		<?php echo "{$cidade["nm_cidade"]}"; ?>
	</option>
<?php } ?>