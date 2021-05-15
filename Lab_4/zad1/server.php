<?php
	#===================================================================
	function getSum( $arg1, $arg2) {
		
		#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		$stderr = fopen('php://stderr', 'w');
		fwrite( $stderr, "Client: $arg1\t$arg2\n" );
		
		# ...lub krocej
		#fwrite( fopen('php://stderr', 'w'), "Client: $data\n" );
		#- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

		$sum = (int)$arg1 + (int)$arg2;
		return strval($sum);
		//return $_SERVER['REQUEST_TIME'];
	}
	#-------------------------------------------------------------------
	# wylaczanie pamieci cache jest sensowne jedynie przy tworzeniu serwisu
	#ini_set("soap.wsdl_cache_enabled", "0");
	
	$server = new SoapServer("auto.wsdl");
	$server->addFunction("getSum");
	$server->handle();
	#===================================================================

?>

