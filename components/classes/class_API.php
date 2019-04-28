<?php
/**
 * This class uses to send response on AJAX requests
 */
class API{

	
	public function register_check(){
		$Users = new Users();
		$login = $_GET['login'];
		$email = $_GET['email'];
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
		 */
		if($login!=""){
			$result = $Users->logupCheck($login, "123", "321", '', "asdhjskfgsjhgjkfzdsghjfsdgjhsdkhgjdkshg@gmail.com");

			if($result==3){
				echo "3";
			}
		}
		if($email!=""){
				//login that 100% not exists:) 
				//just don't touch this, its work great)
				$result = $Users->logupCheck("hdjfgklskjdhfgkjsdlfkjghdjsfklgjhdgjksldgjhj", "123", "321", '', $email);
		
				if($result==4){
					echo "4";
				}else{
					if($result==1){
						echo "1";
					}
				}
			}else{
				echo "";
			}
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