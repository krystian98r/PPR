<?php
	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}
	#===================================================================
	$xml  = file_get_contents('php://input');
	$params = xmlrpc_decode( $xml );
	#-------------------------------------------------------------------
	# $method = $_SERVER[ 'SCRIPT_NAME' ];
	$method = basename( $_SERVER[ 'SCRIPT_FILENAME' ] );
	$method = substr( $method, 0, -4 );
	#-------------------------------------------------------------------
	$array = array( 
		'method' => $method,
		'params' =>	strToHex($params[0]),
	);
	error_log("Przekonwertowany tekst: ".strToHex($params[0]));
	$res = xmlrpc_encode_request(NULL, $array);
	#-------------------------------------------------------------------
	print $res;
	#===================================================================
?>
