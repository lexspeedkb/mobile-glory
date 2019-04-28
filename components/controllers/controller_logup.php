<?php
$Users = new Users();

$fio 		= $_POST['fioF'];
$login 		= $_POST['loginF'];
$email 		= $_POST['emailF'];
$password1 	= $_POST['password1F'];
$password2 	= $_POST['password2F'];
$warning	= $_POST['warningF'];

$abort = 0;


/**	
 * codes:
 * 0 - correct
 * 1 - email exists
 * 2 - different passwords
 * 3 - login exists
 * 4 - invalid email
 */

if($_POST['form']!=""){
	if($fio==""){
		$data['warning']['full_name'] = $lang->empty;
		$abort = 1;
	}
	if($login==""){
		$data['warning']['login'] = $lang->empty;
		$abort = 1;
	}
	if($email==""){
		$data['warning']['email'] = $lang->empty;
		$abort = 1;
	}
	if($password1==""){
		$data['warning']['password1'] = $lang->empty;
		$abort = 1;
	}
	if($password2==""){
		$data['warning']['password2'] = $lang->empty;
		$abort = 1;
	}

	if($abort==0){
		if($password1==$password2){
			$result = $Users->logupCheck($login, $password1, $password2, $fio, $email);
			if($result == 0){
				$Users->userToDB($login, $password1, $password2, $fio, $email);
				redirect('/email_confirmation');
			}
		}
	}
}

//Other data here
$OG_data = array(
	'type' 			=> 'article',
	'title' 		=> SITE_NAME." - Главная",
	'site_name' 	=> SITE_NAME,
	'url'			=> PROTOCOL.DOMAIN.REQUEST_URI,
	'image'			=> PROTOCOL.DOMAIN.'/templates/assets/logo.png',
	'description'	=> 'бла бла',
);

$META_data = array(
	'title' 		=> SITE_NAME." - Главная",
	'keywords'		=> "MyRM, my real motivation",
	'description'	=> 'бла бла',
);


// Assignment values to $data array 

// Assignment other data to $OTHER_data array 
$OTHER_data['OG'] 	= $OG_data;
$OTHER_data['META']	= $META_data;
?>