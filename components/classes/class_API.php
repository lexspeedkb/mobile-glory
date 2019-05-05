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
		if ($this->register_check()=="0") {
			$Users = new Users();

			$login = $_GET['login'];
			$email = $_GET['email'];
			$pass1 = $_GET['pass1'];
			$pass2 = $_GET['pass2'];

			$Users->userToDB($login, $pass1, $pass2, $email);
		}
	}

	/**
	 * 0 - correct
	 * 1 - user inactive
	 * 2 - user not exists
	 * 3 - incorrect password
	 */
	public function entrance_check($echo=true){
		$Users = new Users();

		$login = $_GET['login'];
		$pass  = $_GET['pass'];

		$result = $Users->entranceCheck($login, $pass);

		if ($result == 1) {
			echo "1";
			return 1;
			die;
		} elseif ($result == 2) {
			echo "2";
			return 2;
			die;
		} elseif ($result == 3) {
			echo "3";
			return 3;
			die;
		} elseif ($result == 0) {
			if ($echo) {
				echo "0";
			}
			return 0;
			die;
		}
	}

	public function login(){
		$Users = new Users();

		$login = $_GET['login'];
		$pass  = $_GET['pass'];

		if ($this->entrance_check(false)=="0") {
			$Users->login($login, $pass);
		}

		redirect('/list');
	}

	public function get_lang($lang){
		$XML_tag = $_GET['XML_tag'];
		echo $lang->$XML_tag;
		return $lang->$XML_tag;
	}

	public function addTournament(){
		$Tournaments = new Tournaments();

		$title		 = $_GET['title'];
		$places		 = $_GET['places'];
		$free_places = $_GET['free_places'];
		$datetime	 = $_GET['datetime'];
		$game		 = $_GET['game'];
		$price		 = $_GET['price'];
		$description = $_GET['description'];

		$organizer = $_COOKIE['id'];

		$Tournaments->add($title, $places, $free_places, $datetime, $game, $price, $description, $organizer);

		echo "0";
	}

	public function editTournament(){
		$Tournaments = new Tournaments();

		$id			 = $_GET['id'];
		$title		 = $_GET['title'];
		$places		 = $_GET['places'];
		$free_places = $_GET['free_places'];
		$datetime	 = $_GET['datetime'];
		$game		 = $_GET['game'];
		$price		 = $_GET['price'];
		$description = $_GET['description'];

		$organizer = $_COOKIE['id'];

		$Tournaments->edit($id, $title, $places, $free_places, $datetime, $game, $price, $description, $organizer);

		echo "0";
	}

	public function deleteTournament(){
		$Tournaments = new Tournaments();

		$id = $_GET['id'];

		$Tournaments->delete($id);

		echo "0";
	}

	public function activateUser(){
		$result = Users::activateUser($_GET['login'], $_GET['key']);

		if($result==1){
			echo "Вы успешно подтвердили аккаунт! <a href='/login'>Войдите</a>";
		}else{
			echo "Ссылка неактивна";
		}
	}

	// ADMIN SCRIPTS

	public function admin(){
		$pieces = explode("/", $_SERVER['REQUEST_URI']);
		if ($pieces[1]!='admin') {
			die('NOT ADMIN CALL FOR ADMIN API!!!');
		}
	}

	public function getAllUsers(){
		$this->admin();
	}

}
?>