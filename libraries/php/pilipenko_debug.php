<?php 
/*
	 ///////////////////////////////////////////////////////////////////////////////////////////////
	// Debugging library by ALEX PILIPENKO (LexSpeedKB) lexspeedkb@gmail.com . Thanks for using) //
	\\ V 1.3                                                                                     \\
	 \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/
function alert($text=""){
	$text = str_replace('"', '\"', $text);
	echo '
	<script type="text/javascript">
		alert("'.$text.'");
	</script>
	';
}

function alert_r($array){
	$output = implode('\n', array_map(function($v,$k){return sprintf("%s => %s", $k, $v);},$array,array_keys($array)));
	$output = str_replace('"', '\"', $output);
	echo '
	<script type="text/javascript">
		alert("'.$output.'");
	</script>
	';
}

function print_r_pre($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function print_r_pre_die($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	die;
}
function print_r_die($arr){
	print_r($arr);
	die;
}


function display_errors_start(){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

function display_errors_end(){
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ERROR);
}

function br($count=1){
	$i=0;
	while($count>$i){
		echo "<br>";
		$i++;
	}
}

function hr($count=1){
	$i=0;
	while($count>$i){
		echo "<hr>";
		$i++;
	}
}

	 
//                EEEEEEEEEEEEEEEEEEE						
//				 E                 EE						
//	DDDDDD		EEEEEEEEEEEEEEEEEEE E	BBBBBB					
//	D     D     E                 E E	B					
// 	D      D    E                 EE	B					
// 	D       D   E    EEEEEEEEEEEEEE		B				
// 	D       D   E    E					B	
// 	D      D    E    E					B	
// 	D     D     E    EEEEEEEEEEEEEEEE	B					
//  DDDDDD      E    E             EE	B					
//              E    EEEEEEEEEEEEEE E	B					
//              E                 E E	B					
//              E                 EE	B					
//              E    EEEEEEEEEEEEEE		B				
//              E    E             		B				
//              E    E					B	
//              E    EEEEEEEEEEEEEEEE	B					
//              E    E             EE	B					
//              E    EEEEEEEEEEEEEE E	B					
//              E                 E E	B					
//              E                 EE	B					
//              EEEEEEEEEEEEEEEEEEE		B				
// 
// 
// 
// 
?>