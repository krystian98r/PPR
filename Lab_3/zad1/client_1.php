#!/usr/bin/php

<?php
	#===================================================================
	$port 	= 12345;
	$host 	= '127.0.0.1';
	#-------------------------------------------------------------------
	$req = xmlrpc_encode_request(
		"method", 
		array( $argv[1], $argv[2] )
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
		echo "Suma podanych parametrow: ";
		print_r( $res['params']);
		echo "\n\n";
	}
	#===================================================================
?>
