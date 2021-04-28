<?php
//Reduce errors
error_reporting(~E_WARNING);

$server = '127.0.0.1';
$port = 12345;

if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Blad tworzenia socketu: [$errorcode] $errormsg \n");
}
echo "Podaj tekst:\n";
while(1) {
	echo "> ";
	$input = fgets(STDIN);
		
	if( ! socket_sendto($sock, $input , strlen($input) , 0 , $server , $port)) {
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
			
		die("Blad wysylania danych: [$errorcode] $errormsg \n");
	}	
}
?>
