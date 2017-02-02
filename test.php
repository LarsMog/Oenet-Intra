<?php 
	$pin = '';
	for( $i=0 ; $i<6 ; $i++ ) {
		$pin .= rand(0,9);
	}
	echo $pin;
	
?>	