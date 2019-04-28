<?php
//Reduction of algebraic fraction //Сокращение алгебраической дроби
function gcd($a, $b){
	while ($a != $b)
		if ($a>$b)
			$a -= $b;
		else
			$b -= $a;
	return $a;
}

//Aspect ratio //Cоотношение сторон
function aspectRatio($width, $height){
	$gcd=gcd($width,$height);
	//echo $width."/".$height."(".$width/$gcd."/".$height/$gcd.")";
	return $width/$gcd."/".$height/$gcd;
}
?>