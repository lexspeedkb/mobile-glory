<?php
/**
 * 
 */
class Users{

	public function getAllUsers(){
		$SQL = new SQL();

		$result = $SQL->query("SELECT * FROM `users` ORDER BY id");
		
		return $result;
	}
	
	/**
	 * @param (var)$login 	 - login or email of user
	 * @param (var)$password - password of user
	 * @return (int) - error code 
	 *			0 - correct
	 *			1 - user inactive
	 *			2 - user not exists
	 *			3 - incorrect password
	 *
	 * This function checks user's data for login. If OK, retuns error code
	 */
	public function entranceCheck($login, $password){
		$SQL = new SQL();
		//Protection inputs from injections //Защита полей форм от инъекции
		$login 		= Engine::inputProtection($login);
		$password 	= Engine::inputProtection($password);

		$result = $SQL->query("SELECT * FROM `users` WHERE login='$login' OR email='$login'");

		$password = Engine::crypto($password, $result['login']);

		if($result['id']==""){
			return 2;
		}else{
			if($password!=$result['password']){
				return 3;
			}else{
				if($result['active']==1){
					return 0;
				}else{
					return 1;
				}
			}
		}

	}

	/**
	 * @param (var)$login 	  - login of user
	 * @param (var)$email 	  - email of user
	 * @param (var)$password1 - password of user
	 * @param (var)$password2 - password of user
	 * @return (int) - error code 
	 *			0 - correct
	 *			1 - email exists
	 *			2 - different passwords
	 *			3 - login exists
	 *			4 - invalid email
	 *
	 * This function checks user's data for logupn. If OK, add user to DB and return error code
	 */
	// REGISTER CHECK!!!!!!!!!
	public function logupCheck($login, $password1, $password2, $fio, $email){
		$SQL = new SQL();

		//Protection inputs from injections //Защита полей форм от инъекции
		$login 		= Engine::inputProtection($login);
		$password1 	= Engine::inputProtection($password1);
		$password2 	= Engine::inputProtection($password2);
		$fio 		= Engine::inputProtection($fio);
		$email 		= Engine::inputProtection($email);

		if(emailValidation($email)==0){
			return 4;
			die;
		}

		$result = $SQL->query("SELECT * FROM `users` WHERE login='$login'");

		if($result['id']==""){
			$result = $SQL->query("SELECT * FROM `users` WHERE email='$email'");
			
			if($result['id']==""){
				if($password1==$password2){
					return 0;
				}else{
					return 2;
				}
			}else{
				return 1;
			}
		}else{
			return 3;
		}
	}

	/**
	 * @param (var )$login 	  - login of user
	 * @param (var )$password - password of user
	 * @param (bool)$remember - remember login
	 *
	 * Set user session
	 */
	// CHANGE REMEMBER TO FALSE ON PRODUCTION!!!!!!!!!
	public function login($login, $password, $remember=true){
		$SQL = new SQL();

		if(isInStr('@', $login)){
			$user = $this->getDataByEmail($login);
		}else{
			$user = $this->getDataByLogin($login);
		}

		$id = $user['id'];

		$date_time = date('Y-m-d H:i:s');

		//$SQL->query("INSERT INTO `session`(user_id, user_agent, date_time, hash) VALUES ('$id', '$user_agent', '$date_time', '$hash')");
		$hash =	$this->createHash($_SERVER['HTTP_USER_AGENT'], $id, $password);
		$this->addHash($_SERVER['HTTP_USER_AGENT'], $id, $password, $hash, $remember);
		
		if($remember){
			setcookie('id',   $id, 	 time()+60*60*24, '/');
			setcookie('hash', $hash, time()+60*60*24, '/');
		}else{
			setcookie('id',   $id, 	 time()+10, '/');
			setcookie('hash', $hash, time()+10, '/');
		}
	}
	

	public function currentLoginCheck(){
		$pieces=explode('/', $_SERVER['REQUEST_URI']);
		if($pieces[1]!=''&&$pieces[1]!='login'&&$pieces[1]!='logup'&&$pieces[1]!='api'&&$pieces[1]!='email_confirmation'){
			
			$checkHash = $this->checkHash($_COOKIE['id'], $_COOKIE['hash']);
	
			if($checkHash===false){
				//exit and go to index
				$this->exitUser(true);
			}else{
				return $this->getDataByID($_COOKIE['id']);
			}
		}else{
			
			$checkHash = $this->checkHash($_COOKIE['id'], $_COOKIE['hash']);
	
			if($checkHash===false){
				//exit and go to index
				return false;
			}else{
				return $this->getDataByID($_COOKIE['id']);
			}	
		}
	}

	public function userToDB($login, $password1, $password2, $email){
		$SQL = new SQL();

		$mysql = Db::getConnection();

		//Password hash
		$password = Engine::crypto($password1, $login);

		//CONFIRM EMAIL

		//get template
		$message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/templates/email/EMAIL_registration.tpl');
		
		//genetate activate link and key
		$href = Users::generateLink($login);
		$key  = $href['key'];

		//replacing
		$message = str_replace("{{FIO}}", 		$login, $message);
		$message = str_replace("{{shopName}}", 	$config['shopName'], $message);
		$message = str_replace("{{HREF}}", 		$href['href'], $message);

		$date = date('Y-m-d H:i:s');

		//send mail
		// $Mail = new Mail();
		// $Mail->send_email($email, SITE_NAME.": Подтверждение аккаунта", $message);

		$SQL->query("INSERT INTO `users` (login, fio, password, email, active_key, active, date_reg) VALUES ('$login', '$fio', '$password', '$email', '$key', '1', '$date')");

		//FOR DEBUG
		//$mysql->query("DELETE FROM `users` WHERE login='test'");
	}

	//Generate random string and href for activate link
	public function generateLink($login){
		$randomString = Engine::generateRandomString(200);
		
		$href['href'] = PROTOCOL.$_SERVER['HTTP_HOST']."/api/activateUser/?login=".$login."&key=".$randomString;
		$href['key']  = $randomString;

		return $href;
	}

	//Confirm email and activate user
	//RETURNS
	//0 - link inactive
	//1 - link active
	public function activateUser($login, $key){
		$SQL = new SQL();
		$mysql = Db::getConnection();

		$result = $SQL->query("SELECT * FROM `users` WHERE login='$login'");

		if($key==$result['active_key']){
			$SQL->query("UPDATE `users` SET active='1' WHERE login='$login'");
			$SQL->query("UPDATE `users` SET active_key='' WHERE login='$login'");
			return 1;
		}else{
			return 0;
		}
	}

	public function recoveryPassword($email){
		$SQL = new SQL();

		$mysql = Db::getConnection();

		//get template
		$message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/templates/EMAIL_recoveryPassword.tpl');

		$result = $SQL->query("SELECT * FROM `users` WHERE email='$email'");

		if($result['id']!=""){
			$password = Engine::generateRandomString(7);
			$newPassword = Engine::crypto($password, $result['login']);
			$mysql->query("UPDATE `users` SET password='$newPassword' WHERE email='$email'");

			$message = str_replace("{{FIO}}", 			$result['fio'], $message);
			$message = str_replace("{{shopName}}", 		$config['shopName'], $message);
			$message = str_replace("{{NEW_PASSWORD}}", 	$password, $message);
			
			$Mail		= new Mail();
			$Mail->send_email($email, $config['shopName'].": Восстановление пароля", $message);
			return 1;
		}else{
			return 0;
		}
	}

	public function changePassword($newPassword, $oldPassword){
		global $config;

		$mysql = Db::getConnection();

		$login = $_SESSION['login'];

		$result = $mysql->query("SELECT * FROM `users` WHERE login='$login'");
		while ($row = $result->fetch_array()) {
			$password = $row['password'];
		}
		
		if(Engine::crypto($oldPassword, $login)==$password){
			$np = Engine::crypto($newPassword, $login);
			$mysql->query("UPDATE `users` SET password='$np' WHERE login='$login'");
			return 1;
		}else{
			return 0;
		}
	}

	public function setBascet($login, $arr){
		$mysql = Db::getConnection();

		$mysql->query("UPDATE `users` SET bascet='$arr' WHERE login='$login'");
	}

	public function getBascet($login){
		$mysql = Db::getConnection();

		$result = $mysql->query("SELECT * FROM `users` WHERE login='$login'");
		if($result!=""){
			while ($row = $result->fetch_array()) {
				$bascet = $row['bascet'];
			}
		}

		if($bascet!=""){
			$_SESSION['arr']=$bascet;
		}

	}

	public function getDataByEmail($email){
		$SQL = new SQL();

		$mysql = Db::getConnection();

		$user = $SQL->query("SELECT * FROM `users` WHERE email='$email'");

		return $user;
	}

	public function getDataByLogin($login){
		$SQL = new SQL();

		$mysql = Db::getConnection();

		$user = $SQL->query("SELECT * FROM `users` WHERE login='$login'");

		return $user;
	}

	public function getDataByID($id){
		$SQL = new SQL();

		$mysql = Db::getConnection();

		$user = $SQL->query("SELECT * FROM `users` WHERE id='$id'");

		return $user;
	}

	public function exitUser($goToIndex=false){
		foreach($_COOKIE as $key => $value){
			setcookie($key, '', time()-100000000);
			setcookie($key, '', time()-100000000, '/');
		}
		if($goToIndex){
			redirect('/');			
		}
	}
	
	/**
	 * @param (varchar)$REMOTE_ADDR - user $_SERVER['REMOTE_ADDR'];
	 * @param (varchar)$HTTP_USER_AGENT - user $_SERVER['HTTP_USER_AGENT'];
	 * @param (int)$id - user id
	 * @param (varchar)$password - user password
	 *
	 * This function creates hash by the special algorithm
	 */
	public function createHash($HTTP_USER_AGENT, $id, $password){
		$hash = md5($HTTP_USER_AGENT.$id.$password);

		return $hash;
	}


	/**
	 * @param (varchar)$REMOTE_ADDR - user $_SERVER['REMOTE_ADDR'];
	 * @param (varchar)$HTTP_USER_AGENT - user $_SERVER['HTTP_USER_AGENT'];
	 * @param (int)$id - user id
	 * @param (varchar)$password - user password
	 * @param (varchar)$hash - hash
	 *
	 * This function add new session after registration and autorisation
	 */
	public function addHash($HTTP_USER_AGENT, $id, $password, $hash, $remember){
		$SQL = new SQL();

		$time = date("Y-m-d H:i:s");

		$ha = $SQL->query("SELECT * FROM `session` WHERE hash = '$hash'");

		if($ha==""){
			if($remember){
				$SQL->query("INSERT INTO `session` (user_id, user_agent, date_time, hash, remember_me) VALUES ('$id', '$HTTP_USER_AGENT', '$time', '$hash', '1')");
			}else{
				$SQL->query("INSERT INTO `session` (user_id, user_agent, date_time, hash, remember_me) VALUES ('$id', '$HTTP_USER_AGENT', '$time', '$hash', '1')");
			}
		}

	}


	/**
	 * @param (int)$id - user id
	 * @param (varchar)$hash - hash from cookie
	 * @return (BOOL)
	 *
	 * This function checks, is user hash valid. If isn't - return false. If valid - return
	 * true and update date of last usage of this sission. Also it delete old short sessions
	 */
	public function checkHash($id, $hash){
		$SQL = new SQL();

		$user = $this->getDataByID($id);
		$password = $user['password'];

		$i=0;
		$ha = $SQL->query("SELECT * FROM `session` WHERE user_id='$id' AND hash='$hash'");

		if(empty($ha)){
			return false;
		}else{
			if($ha['remember_me']!=1){
				$timeDiff = timeDiff($ha['date_time']);
				$delete = false;
				if($timeDiff['daysTotal']>1){
					$delete = true;
				}else{
					if($timeDiff['H']>1){
						$delete = true;
					}else{
						if($timeDiff['I']>TIME_OF_SHORT_SESSION){
							$delete = true;
						}
					}
				}

				if($delete){
					$SQL->query("DELETE FROM `session` WHERE user_id='$id' AND hash='$hash'");
					return false;
				}
			}
			
			$time = date("Y-m-d H:i:s");

			$SQL->query("UPDATE `session` SET date_time='$time' WHERE user_id = '$id' AND hash = '$hash'");
			$SQL->query("UPDATE `users` SET date_last_seen='$time' WHERE id = '$id'");
			return true;
		}


	}

	public function addBalance($id, $summ){
		$SQL = new SQL();

		$user = $SQL->query("SELECT * FROM `users` WHERE id = '$id'");

		$newBalance = $user['balance']+$summ;

		$SQL->query("UPDATE `users` SET balance='$newBalance' WHERE id = '$id'");
	}

	public function banUser($id){
		$SQL = new SQL();

		$SQL->query("UPDATE `session` SET hash='' WHERE user_id = '$id'");
		$SQL->query("UPDATE `users` SET active='0' WHERE id = '$id'");
	}

	public function de_banUser($id){
		$SQL = new SQL();

		$SQL->query("UPDATE `users` SET active='1' WHERE id = '$id'");
	}

	public function setOrganizer($id){
		$SQL = new SQL();

		$SQL->query("UPDATE `users` SET organizer='1' WHERE id = '$id'");
	}

	public function de_setOrganizer($id){
		$SQL = new SQL();

		$SQL->query("UPDATE `users` SET organizer='0' WHERE id = '$id'");
	}
}
?>