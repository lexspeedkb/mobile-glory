<?php
/*
	 ////////////////////////////////////////////////////////////////////////////////////////////
	// library by ALEX PILIPENKO (LexSpeedKB) lexspeedkb@gmail.com . Thanks for using)		  //
	\\ V 1.3                                                                                  \\
	 \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
*/

//Mail with encoding UTF-8 //Отправка E-mail с кодировкой UTF-8
function mail_UTF8($to, $subject, $message){
	$headers = 'From: '.emailHeaderFromAdress."\r\n".'Content-Type: text/html; charset=utf-8'."\r\n";
	mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
}

function redirect($uri){
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL='.$uri.'">';
}

/*GET DATA BY IP*/
function getIP() {
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
		if (array_key_exists($key, $_SERVER) === true) {
			foreach (explode(',', $_SERVER[$key]) as $ip) {
				if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
					return $ip;
				}
			}
		}
	}
}

function getDataByIP(){
	$json = file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='. getIP()); 
	$data = json_decode($json, true);

	return $data;
}
/*GET DATA BY IP*/


function sitemapGenerator($url){
	$insertSITEMAP = "\n\t<url>\n\t\t<loc>".$url."</loc>\n\t</url>";

	//i don't know? wtf is this:/ If i parse any .xml file on my serwer, there is SQL server dovn :( 
	//So i make this boolshit :)
	//rename($_SERVER['DOCUMENT_ROOT']."/sitemap.xml", $_SERVER['DOCUMENT_ROOT']."/sitemap.xml1");

	$sitemapXML = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/sitemap.xml');

	$pos 	= strripos($sitemapXML, $url);
	$pos1 	= strripos($url, 'scripts');

	if($pos === false && $pos1 === false){
		$sitemapXML = preg_replace('<<!--insert-->>', $insertSITEMAP."\n\t<!--insert-->", $sitemapXML);
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/sitemap.xml', $sitemapXML);
	}

	//And this boolshit :)
	//rename($_SERVER['DOCUMENT_ROOT']."/sitemap.xml1", $_SERVER['DOCUMENT_ROOT']."/sitemap.xml");
}


function close_tags($content){
	//ЗА СКРИПТ СПАСИБО http://artkiev.com/blog/php-tags-close.htm
	$position = 0;
	$open_tags = array();
	//теги для игнорирования
	$ignored_tags = array('br', 'hr', 'img');
	while (($position = strpos($content, '<', $position)) !== FALSE){
		//забираем все теги из контента
		if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match)){
			$tag = strtolower($match[2]);
			//игнорируем все одиночные теги
			if (in_array($tag, $ignored_tags) == FALSE){
				//тег открыт
				if (isset($match[1]) AND $match[1] == ''){
					if (isset($open_tags[$tag]))
						$open_tags[$tag]++;
					else
						$open_tags[$tag] = 1;
				}
				//тег закрыт
				if (isset($match[1]) AND $match[1] == '/'){
					if (isset($open_tags[$tag]))
						$open_tags[$tag]--;
				}
			}
			$position += strlen($match[0]);
		}
		else
			$position++;
	}
	//закрываем все теги
	foreach ($open_tags as $tag => $count_not_closed){
		$content .= str_repeat("</{$tag}>", $count_not_closed);
	}
	return $content;
}

function search_in_deep_array($array, $key, $value){
	$results = array();

	if (is_array($array)) {
		if (isset($array[$key]) && $array[$key] == $value) {
			$results[] = $array;
		}

		foreach ($array as $subarray) {
			$results = array_merge($results, search_in_deep_array($subarray, $key, $value));
		}
	}

	return $results;
}

function dateToArray($date){
	$para = explode(" ", $date);

	$dat = $para[0];
	$tim = $para[1];
	
	$dat = explode("-", $dat);
	$dateArray['Y'] = $dat[0];
	$dateArray['m'] = $dat[1];
	$dateArray['d'] = $dat[2];

	$tim = explode(":", $tim);
	$dateArray['H'] = $tim[0];
	$dateArray['i'] = $tim[1];
	$dateArray['s'] = $tim[2];

	if($dateArray['m']=="01"){
		$dateArray['m_name'] = "ЯНВАРЬ";
	}elseif($dateArray['m']=="02"){
		$dateArray['m_name'] = "ФЕВРАЛЬ";
	}elseif($dateArray['m']=="03"){
		$dateArray['m_name'] = "МАРТ";
	}elseif($dateArray['m']=="04"){
		$dateArray['m_name'] = "АПРЕЛЬ";
	}elseif($dateArray['m']=="05"){
		$dateArray['m_name'] = "МАЙ";
	}elseif($dateArray['m']=="06"){
		$dateArray['m_name'] = "ИЮНЬ";
	}elseif($dateArray['m']=="07"){
		$dateArray['m_name'] = "ИЮЛЬ";
	}elseif($dateArray['m']=="08"){
		$dateArray['m_name'] = "АВГУСТ";
	}elseif($dateArray['m']=="09"){
		$dateArray['m_name'] = "СЕНТЯБРЬ";
	}elseif($dateArray['m']=="10"){
		$dateArray['m_name'] = "ОКТЯБРЬ";
	}elseif($dateArray['m']=="11"){
		$dateArray['m_name'] = "НОЯБРЬ";
	}elseif($dateArray['m']=="12"){
		$dateArray['m_name'] = "ДЕКАБРЬ";
	}

	$dateArray['m_name_short'] = mb_substr($dateArray['m_name'], 0, 3,'UTF-8');
	

	return $dateArray;
}

//Open Graph
function OG_generate($type, $data){
	if($type==""){
		return "";
	}

	// Important!
	$OG = '<meta property="og:type" content="'.$type.'">'."\n";

	// ARTICLE
	// og:type 					- article">
	// og:title 				- title">
	// og:site_name 			- myrm">
	// og:url				 	- http://myrm/">
	// og:image					- img">
	// article:published_time 	- 2018-08-08">
	// article:author 			- http://myem/user/1">

	// Profile
	// og:type 				- profile
	// og:title 			- MyRM - Алексей Пилипенко
	// og:url 				- http://myrm/user/1
	// og:image 			- http://myrm/img/photos/1.png
	// profile:first_name 	- Алексей
	// profile:last_name 	- Пилипенко
	foreach ($data as $key => $value) {
		$OG .= "\t".'<meta property="og:'.$key.'" content="'.$value.'">'."\n";
	}

	return $OG;
}

//RETURNS
//0 - invalid
//1 - valid
function emailValidation($email){
	if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
		return 1;
	}else{
		return 0;
	}
}

function xml2array($xmlObject, $out=array()){
	foreach((array)$xmlObject as $index => $node)
		$out[$index] = (is_object($node))?xml2array($node) : $node;
	return $out;
}


//ARRAY TO OBLECT
function array_to_obj($array, &$obj){
	foreach ($array as $key => $value){
		if(is_array($value)){
			$obj->$key = new stdClass();
			array_to_obj($value, $obj->$key);
		}else{
			$obj->$key = $value;
		}
	}
	return $obj;
}

function arrayToObject($array){
	$object= new stdClass();
	return array_to_obj($array,$object);
}

function timeDiff($date, $date2='now'){
	$datetime1 = new DateTime("now");
	$datetime2 = new DateTime($date);
	$interval = $datetime1->diff($datetime2);
	
	$intervalRet['Y'] = $interval->format('%Y');
	$intervalRet['M'] = $interval->format('%M');
	$intervalRet['D'] = $interval->format('%D');
	$intervalRet['H'] = $interval->format('%H');
	$intervalRet['I'] = $interval->format('%I');
	$intervalRet['R'] = $interval->format('%R');
	$intervalRet['r'] = $interval->format('%r');
	$intervalRet['daysTotal'] = $interval->format('%a');

	return $intervalRet;
}

function showTree($folder, $space) {
	/* Получаем полный список файлов и каталогов внутри $folder */
	$files = scandir($folder);
	foreach($files as $file) {
    	/* Отбрасываем текущий и родительский каталог */
    	if (($file == '.') || ($file == '..')) continue;
    	$f0 = $folder.'/'.$file; //Получаем полный путь к файлу
    	/* Если это директория */
    	if (is_dir($f0)) {
    		/* Выводим, делая заданный отступ, название директории */
    		echo $space.$file."<br />";
    		/* С помощью рекурсии выводим содержимое полученной директории */
    		showTree($f0, $space.'&nbsp;&nbsp;');
    	}
    	/* Если это файл, то просто выводим название файла */
    	else echo $space.$file."<br />";
	}
	/* Запускаем функцию для каталога */
	// showTree($_SERVER['DOCUMENT_ROOT']."/", "");

	/* Запускаем функцию для текущего каталога */
	// showTree("./", "");
}


function isInStr($findme, $mystring){
	
	$pos = strpos($mystring, $findme);
	
	if($pos === false){
	    return false;
	}else{
	    return true;
	}
}
?>