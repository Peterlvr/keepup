<?php # Função de validação de senha criptografada
function compararSenhas($senha, $hash) {
	if(crypt($senha, $hash) === $hash)
		return true;
	else
		return false;
}
?>