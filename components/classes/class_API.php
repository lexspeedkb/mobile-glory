<?php
/**
 * This class uses to send response on AJAX requests
 */
class API{

	
	public function register_check(){
		$Users = new Users();
		$login = $_GET['login'];
		$email = $_GET['email'];
		$pass1 = $_GET['pass1'];
		$pass2 = $_GET['pass2'];
		if($_GET['get']=='email' && empty($email)){
			echo "empty";
		}
		if($_GET['get']=='login' && empty($login)){
			echo "empty";
		}

		/**	
		 * codes:
		 * 0 - correct
		 * 1 - email exists
		 * 2 - different passwords
		 * 3 - login exists
		 * 4 - invalid email
		 * 5 - empty login
		 * 6 - empty email
		 * 7 - empty password1
		 * 8 - empty password2
		 */
		if (empty($pass1)) {
			echo "7";
			return 7;
			die;
		}
		if (empty($pass1)) {
			echo "8";
			return 8;
			die;
		}
		if ($pass1 != $pass2) {
			echo "2";
			return 2;
			die;
		}
		if($email!=""){
			//login that 100% not exists:) 
			//just don't touch this, its work great)
			$result = $Users->logupCheck("hdjfgklskjdhfgkjsdlfkjghdjsfklgjhdgjksldgjhj", "123", "321", '', $email);
	
			if($result==4){
				echo "4";
				return 4;
				die;
			}else{
				if($result==1){
					echo "1";
					return 1;
					die;
				}else{
					if($login!=""){
						$result = $Users->logupCheck($login, "123", "321", '', "asdhjskfgsjhgjkfzdsghjfsdgjhsdkhgjdkshg@gmail.com");

						if($result==3){
							echo "3";
							return 3;
							die;
						}else{
							echo "0";
							return 0;
							die;
						}
					}else{
						echo "5";
						return 5;
						die;
					}
				}
			}
		}else{
			echo "6";
			return 6;
			die;
		}
	}

	public function userToDB(){
		// if ($this->register_check()) {
		// 	# code...
		// }
		$this->register_check();
	}

	public function get_lang($lang){
		$XML_tag = $_GET['XML_tag'];
		echo $lang->$XML_tag;
		return $lang->$XML_tag;
	}

	public function activateUser(){
		$result = Users::activateUser($_GET['login'], $_GET['key']);

		if($result==1){
			echo "Вы успешно подтвердили аккаунт! <a href='/login'>Войдите</a>";
		}else{
			echo "Ссылка неактивна";
		}
	}

	/*EDITOR*/
	public function editor_Publish(){
		//print_r_pre($_POST['data']);
		echo $ser = serialize($_POST['data']);
		$ser = unserialize($ser);
	}
}
?>