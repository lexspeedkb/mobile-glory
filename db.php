<?php
// подключение к БД
class Db{
//mysql.hostinger.com.ua
	public static function getConnection(){
		if($_SERVER['HTTP_HOST']=="mobile-glory"){
			$mysqli = new mysqli('127.0.0.1', 'root', '', 'mobile_glory');
		}elseif($_SERVER['HTTP_HOST']=="mobile-glory.xyz"){
			$mysqli = new mysqli('mysql.hostinger.ru', 'u358382877_myrm', 'j$?:2TBJcu?jI4OlPA', 'u358382877_myrm');
		}else{
			$mysqli = new mysqli('127.0.0.1', 'root', '', 'mobile_glory');
		}
		$mysqli->query( "SET CHARSET utf8" );
		if (mysqli_connect_errno()) {
			echo "error".mysqli_connect_error();
		}
		return $mysqli;
	}
}
?>