<?php

	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}
	#===================================================================
	function sendMessage( $mess) {
		$port 	= 1235;
		$host 	= '127.0.0.1';
		
		#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		$stderr = fopen('php://stderr', 'w');

		$hex = strToHex($mess);
		fwrite( $stderr, "Conversion: $mess -> $hex\n" );

		#---xml-rcp---------------------------------------------------------
		$req = xmlrpc_encode_request(
			"method", 
			array( $hex )
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

		return $hex;
	}
	#-------------------------------------------------------------------
	# wylaczanie pamieci cache jest sensowne jedynie przy tworzeniu serwisu
	#ini_set("soap.wsdl_cache_enabled", "0");
	
	$server = new SoapServer("auto.wsdl");
	$server->addFunction("sendMessage");
	$server->handle();
?>

