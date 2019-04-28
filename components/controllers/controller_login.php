<?php
$Users = new Users();

$form 		= $_POST['form'];
$login 		= $_POST['login'];
$password 	= $_POST['password'];

if($_POST['anothers_pc']=="on"){
	$anothers_pc = true;
}else{
	$anothers_pc = false;
}

// 0 - correct
// 1 - user inactive
// 2 - incorrect login
// 3 - incorrect password
if($form==1){
	if($login!=""&$password!=""){
		$result = $Users->entranceCheck($login, $password);
		if($result==0){
			$Users->login($login, $password, $anothers_pc);
			redirect('/');
			die();
		}elseif($result==3){
			$warning = $lang->incorrect_password;
		}elseif($result==2){
			$warning = $lang->user_not_exist;
		}elseif($result==1){
			$warning = $lang->email_not_active;
		}
	}else{
		$warning = $lang->not_all_fields;
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
$data['warning']=$warning;

// Assignment other data to $OTHER_data array 
$OTHER_data['OG'] 	= $OG_data;
$OTHER_data['META']	= $META_data;
?>