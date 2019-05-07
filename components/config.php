<?php
//Parser must to return currency in '$parser' variable //Парсер должен возвращать курс в переменной '$parser'
include $_SERVER['DOCUMENT_ROOT'].'/components/parser.php';

$config = array(
	//Name of site //Название Сайта
	'SITE_NAME'						=> 'Mobile Glory',
	//Name, from whitch E-mails will sent //Имя, от которого будут приходить E-mail
	'emailHeaderFromAdress' 		=> 'test@artmyrm.xyz',
	'emailHeaderFromName'			=> 'Robot',
	//E-mail to receive feedback //E-mail, на который будут приходить отзывы
	'EMAIL_FOR_FEEDBACK'			=> 'mglorytournaments@gmail.com',
	//Protocol //Протокол
	'PROTOCOL'						=> 'https://',
	//Domail //Домен
	'DOMAIN'						=> $_SERVER['HTTP_HOST'],
	//Root dir //Корневая директория
	'ROOT'							=> $_SERVER['DOCUMENT_ROOT'],
	//Request Uri //Запрашиваемый uri
	'REQUEST_URI'					=> $_SERVER['REQUEST_URI'],
	//Dir for upload images //Директория для загружаемых изображений
	'DIR_UPLOAD_IMG'				=> $_SERVER['DOCUMENT_ROOT'].'/files/img/',
	//Image size limits //Лимит размера изображения
	'PRODUCT_PHOTO_MAX_SIZE_width'	=> 2000,//Max width  //Максимальная ширина
	'PRODUCT_PHOTO_MAX_SIZE_height'	=> 2000,//Max width  //Максимальная ширина
	//If you have an engine error, but can't find error message - set this to true //Если у вас ошибка движка, но вы не можете найти сообщение об ошибке - выставьте данный параметр на true
	'alertEngineErrors'				=> false,
	//Abort script on engine error //Остановить скрипт, если произошла ошибка движка
	'stopScriptOnEngineError'		=> true,
	//Did engine will display errors //Будет ли движок выводить ошибки
	'engineDisplayErrors'			=> true,
	//Files download method //Метод скачивания файлов
	'FILES_DOWNLOAD_METHOD'			=> "PHP", // PHP/SIMPLE //PHP is recommend
	//Path to files for download //Путь к файлам для скачивания
	'PATH_TO_FILES_FOR_DOWNLOAD'	=> '/files/download/',
	//Default language //Стандартный язык
	'DEFAULT_LANGUAGE'				=> 'ru',
	//Path to dir with language packages //Путь к папке с языковыми пакетами
	'PATH_TO_LANGUAGES'				=> '/components/lang/',
	//Access Control Allow Origin to API //Контроль доступа к API извне
	'OPEN_API'						=> true,
	//Time of short session //Время жизни короткой сессии
	'TIME_OF_SHORT_SESSION'			=> 1,
	//Default page of logged user //Стандартная страница, которая открывается залогиненному пользователю
	'USER_DEFAULT_PAGE'				=> 'list',

	//PRICES
	'ONE_POST_PRICE'				=> 50,
	
	
	// SMTP
	// Is use SMTP
	'USE_SMTP'						=> true,
	//SMTP settings
	'SMTP_HOST'						=> 'mx1.hostinger.ru',
	'SMTP_AUTH'						=> true,
	'SMTP_USER'						=> 'test@artmyrm.xyz',
	'SMTP_PASS'						=> 'qweqwe',
	'SMTP_PORT'						=> 587,
	'SMTP_SECU'						=> '', // SSL/TLS. If empty - don't use


	//TEMPLATES
	//Path to logo //Путь к лого
	'PATH_TO_LOGO'					=> '/templates/assets/img/logo.png',

	//ADMIN //АДМИНКА
	'adminLogin'	 				=> 'lexspeedkb',
	'adminPassword'	 				=> 'lexus2001',

	//PROMO CODE //ПРОМО КОД
	// 'promo_Available' 			=> 1, //1 - true, 0 - false
	// 'promo_Discount'  			=> 50, //discount in % //Скидка в %
	// 'promo_Code' 				=> '|qwe123|hfd|LexSpeedKB|', //Promo codes, separate by "|" //Промо-кода, разделённые "|"

	//PHP ini
	//If value isset, use default php values //Если значение пустое, то использовать стандартное значение PHP
	//Need to refresh page twice //Требует двойного перезапуска страницы
	//In Mb //Задаётся в мегабайтах
	'ini_upload_max_filesize'		=> '400',   //Recommended - 5
	'ini_post_max_size'				=> '400',  //Recommended - 18
	'ini_memory_limit'				=> '400', //Recommended - 128
);
//All config variables to constants
foreach ($config as $name => $value) {
	define($name, $value);
}

if($config['ini_upload_max_filesize']!=''){
	$htaccess = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
	$htaccess = preg_replace('/php_value upload_max_filesize [(0-9)]*M/', "php_value upload_max_filesize ".$config['ini_upload_max_filesize']."M", $htaccess);
	if(!empty($htaccess)){
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $htaccess);
	}
}
if($config['ini_post_max_size']!=''){
	$htaccess = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
	$htaccess = preg_replace('/php_value post_max_size [(0-9)]*M/', "php_value post_max_size ".$config['ini_post_max_size']."M", $htaccess);
	if(!empty($htaccess)){
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $htaccess);
	}
}
if($config['ini_memory_limit']!=''){
	$htaccess = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess');
	$htaccess = preg_replace('/php_value memory_limit [(0-9)]*M/', "php_value memory_limit ".$config['ini_memory_limit']."M", $htaccess);
	if(!empty($htaccess)){
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $htaccess);
	}
}
?>