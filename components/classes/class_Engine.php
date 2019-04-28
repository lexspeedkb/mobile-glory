<?php
/**
 * 
 */
class Engine{

	public function error_400(){
		die("400 Запрос не может быть исполнен ввиду синтаксической ошибки.");
	}

	public function error_401(){
		die("401 Этот код связан с запросом к ресурсу, который требует авторизации. Ответ 401 указывает на то, что попытка авторизации была отклонена по тем данным, которые предоставил пользователь.");
	}

	public function error_403(){
		die("403 Пользователь пытается осуществить доступ к ресурсу, к которому у него нет доступа, и авторизация не изменит положения.");
	}

	public function error_404(){
		header("HTTP/1.0 404 Not Found");
		die("404 запрошенный ресурс не может быть найден");
	}

	public function error_500(){
		die("500 Внутренняя ошибка сервера. Если Вы администратор сайта - активируйте вывод ошибок для детальной информации");
	}
	
	//functions for all occasions //функции на все случаи жизни

	//crypto system //система шифрования
	//Don't forget also change Users::recoveryPassword //Не забыть также изменить Users::recoveryPassword
	public function crypto($text, $key=""){
		return $text.$key;
	}


	/**
	* @param (varc)$to 		- email of addressee
	* @param (varc)$subject - subject of E-mail
	* @param (text)$message - text of message
	*
	*	Mail with encoding UTF-8 //Отправка E-mail с кодировкой UTF-8
	*/
	public function mail_UTF8($to, $subject, $message){
		global $config;

		$headers = 'From: '.emailHeaderFromAdress."\r\n".'Content-Type: text/html; charset=utf-8'."\r\n";
		mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	}

	/**
	* @param  (int )$length - length of generated string
	*
	* @return (varc)$randomString - random string
	*
	*	Generates a random string of a given length
	*/
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	* @param  (int )$value - given value
	* @param  (int )$max   - maximum of value
	*
	* @return (int )$value - limit of value
	*
	*	Max limit of value //Ограничение максимального лимита числа
	*/
	public function LimitMAX($value, $max){
		if($value<=$max){
			return $value;
		}else{
			return $max;
		}
	}

	/**
	* @param  (int )$value - given value
	* @param  (int )$min   - minimum of value
	*
	* @return (int )$value - limit of value
	*
	*	Min limit of value //Ограничение минимального лимита числа
	*/
	public function LimitMIN($value, $min){
		if($value<=$min){
			return $min;
		}else{
			return $value;
		}
	}

	/**
	* @param  (varc)$value - given value
	*
	* @return (varc)$randomString - random string
	*
	*	Protection inputs from injections //Защита полей форм от инъекции
	*/
	public function inputProtection($value){
		$mysql = Db::getConnection();

		$value = mysqli_real_escape_string($mysql, $value);

		$value = str_replace("#", "\#", $value);

		$value = htmlspecialchars($value);

		return $value;
	}


	function return_bytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) 
		{
			case 'g':
			$val *= 1024;
			case 'm':
			$val *= 1024;
			case 'k':
			$val *= 1024;
		}
		return $val;
	}

	//GET PHP MAX FILE UPLOADE SIZE //Получаем максимальный размер файла, который можем загрузить посредством PHP
	//DEFINED UNITS: //Опредённые единицы
	// B  - 	Bytes 		Байты
	// Kb - KiloBytes	КилоБайты
	// Mb - MegaBytes	МегаБайты
	// Gb - GigaBytes	ГигаБайты
	// Tb - TeraBytes	ТераБайты
	public function max_file_upload() {
		global $config;
		//select maximum upload size //получения максимального размера загрузки
		$max_upload = Engine::return_bytes(ini_get('upload_max_filesize'));
		//select post limit //Получиаем лимит POST-запроса
		$max_post = Engine::return_bytes(ini_get('post_max_size'));
		//select memory limit //Получаем лимит памяти
		$memory_limit = Engine::return_bytes(ini_get('memory_limit'));
		// return the smallest of them, this defines the real limit //Возвращаем наименьшее значение из них. Это и будет лимитом
		$bytes = min($max_upload, $max_post, $memory_limit);
		
		//translate in different units //Перевод в разные единицы измерения
		return $bytes;
	}

	//Translate in different units //Перевод в разные единицы измерения
	public function units($bytes, $units='B'){
		if($units=="B"){
			return $bytes;
		}elseif($units=="Kb"){
			return $bytes/1024;
		}elseif($units=="Mb"){
			return $bytes/1024/1024;
		}elseif($units=="Gb"){
			return $bytes/1024/1024/1024;
		}elseif($units=="Tb"){
			return $bytes/1024/1024/1024/1024;
		}else{
			Engine::engineError("<b>AlPiEngine ERROR</b>: undefined unit ".$units." in function Engine::units.<br>
				B  - 	Bytes 		Байты <br>
				Kb - KiloBytes	КилоБайты <br>
				Mb - MegaBytes	МегаБайты <br>
				Gb - GigaBytes	ГигаБайты <br>
				Tb - TeraBytes	ТераБайты <br>
				", "undefined unit ".$units." in function Engine::units. DEFINED UNITS: B - Bytes Байты Kb - KiloBytes КилоБайты Mb - MegaBytes МегаБайты Gb - GigaBytes ГигаБайты Tb - TeraBytes ТераБайты"
			);
		}
	}

	public function engineError($errorMessage, $errorMessageAlert=""){
		global $config;

		if($config['engineDisplayErrors']){
			//If engine need to another text for alert() //Если движку нужен другой текст для alert()
			if($errorMessageAlert==""){
				$errorMessageAlert = $errorMessage;
			}

			if($config['alertEngineErrors']){
				alert($errorMessageAlert);
			}

			echo($errorMessage);

			if($config['stopScriptOnEngineError']){
				die;
			}
		}else{
			Engine::error_500();
		}
	}

	//Get auto increment for names of pictures //Получение автоинкремента для имён картинок
	public function getAI($name){
		$mysql = Db::getConnection();

		$result = $mysql->query("SELECT * FROM `ai` WHERE name='$name'");
		while ($row = $result->fetch_array()) {
			$ai = $row['ai'];
		}

		$ai2=$ai+1;
		$mysql->query("UPDATE `ai` SET ai='$ai2' WHERE name='$name'");
		return $ai;
	}

	//FILES DOWNLOADING
	public function downloadFiles($file){
		if(FILES_DOWNLOAD_METHOD=="PHP"){
			$file = $_SERVER['DOCUMENT_ROOT'].PATH_TO_FILES_FOR_DOWNLOAD.$file;
			Engine::file_php_download($file);
		}elseif(FILES_DOWNLOAD_METHOD=="SIMPLE"){
			$file = PATH_TO_FILES_FOR_DOWNLOAD.$file;
			Engine::file_simple_download($file);
		}
	}

	public function file_php_download($file){
		if (file_exists($file)) {
			// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
			// если этого не сделать файл будет читаться в память полностью!
			if (ob_get_level()) {
			  ob_end_clean();
			}
			// заставляем браузер показать окно сохранения файла
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			// читаем файл и отправляем его пользователю
			readfile($file);
		}
	}

	public function file_simple_download($file){
		echo '<meta http-equiv=refresh content="0; url='.$file.'">';
	}
}
?>