#!/usr/bin/php

<?php
	#===================================================================
	$port 	= 12345;
	$host 	= '127.0.0.1';
	#-------------------------------------------------------------------
	echo "Podaj tekst:\n> ";
	$stdin = trim(fgets(STDIN));
	$req = xmlrpc_encode_request(
		"method", 
		array( $stdin )
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
?>
