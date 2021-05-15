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
		
		#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		$stderr = fopen('php://stderr', 'w');

		$hex = strToHex($mess);
		fwrite( $stderr, "Meesage: $hex\n" );
		
		# ...lub krocej
		#fwrite( fopen('php://stderr', 'w'), "Client: $data\n" );
		#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

		return $hex;
		//return $_SERVER['REQUEST_TIME'];
	}
	#-------------------------------------------------------------------
	# wylaczanie pamieci cache jest sensowne jedynie przy tworzeniu serwisu
	#ini_set("soap.wsdl_cache_enabled", "0");
	
	$server = new SoapServer("auto.wsdl");
	$server->addFunction("sendMessage");
	$server->handle();
	#===================================================================

?>

