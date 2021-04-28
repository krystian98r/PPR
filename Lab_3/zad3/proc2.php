#!/usr/bin/php

<?php
	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}
	#===================================================================
	$port 	= 12345;
	$host 	= '127.0.0.1';
	
	//Reduce errors
	error_reporting(~E_WARNING);

	//Create a UDP socket
	if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))) {
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Nie mozna utworzyc socketu: [$errorcode] $errormsg \n");
	}

	// Bind the source address
	if( !socket_bind($sock, $host , $port) )
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Blad bindowania socketu : [$errorcode] $errormsg \n");
	}
	echo "Polaczono";

	while(1) {
		//Receive data
		$r = socket_recvfrom($sock, $buf, 512, 0, $remote_ip, $remote_port);
		echo "\nKonwersja: ".$buf." -> ".strToHex($buf);
		
		#-------------------------------------------------------------------
		$req = xmlrpc_encode_request(
			"method", 
			array( strToHex($buf) )
		);
		#-------------------------------------------------------------------
		$ctx = stream_context_create(
			array(
				'http' => array(
					'method' 	=> "POST",
					'header' 	=> array( "Content-Type: text/xml" ),
					'content' 	=> $req
				)
			)
		);
		#-------------------------------------------------------------------
		$xml = file_get_contents( "http://$host:$port/RPC2", false, $ctx );
		#-------------------------------------------------------------------
		$res = xmlrpc_decode( $xml );
		#-------------------------------------------------------------------
		if( $res && xmlrpc_is_fault( $res ) ){
			print "xmlrpc: $response[faultString] ($response[faultCode])";
			exit( 1 );
		} else {

		}
		#===================================================================
	}
	socket_close($sock);	
?>
