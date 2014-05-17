<?php # Função de salt
function salt() {
	$cost = 10;
	$salt = strtr(base64_encode(mcrypt_create_iv(16,MCRYPT_DEV_URANDOM)), '+', '.');
	$salt = sprintf("$2a$%02d$", $cost) . $salt;
	return $salt;
}
?>