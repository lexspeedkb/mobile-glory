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


	/**
	* 0 - OK
	* 1 - incorreck promo code
	* 2 - not enougth money
	*
	*/
	public function addTournament(){
		$Tournaments = new Tournaments();
		$PromoCodes  = new PromoCodes();
		$Users       = new Users();
		$Wallet		 = new Wallet();

		$title		 = $_GET['title'];
		$places		 = $_GET['places'];
		$free_places = $_GET['free_places'];
		$datetime	 = $_GET['datetime'];
		$game		 = $_GET['game'];
		$price		 = $_GET['price'];
		$description = $_GET['description'];
		$promo_code  = $_GET['promo_code'];

		$organizer = $_COOKIE['id'];

		if (empty($title) || empty($places) || empty($free_places) || empty($game) || empty($price) || empty($description)) {
			echo "3";
		} else {
			if (!empty($promo_code)) {
				if ($PromoCodes->usePromoCode($promo_code)) {
					$Tournaments->add($title, $places, $free_places, $datetime, $game, $price, $description, $organizer);
					echo "0";
				} else {
					echo "1";
				}
			} else {
				if ($Users->removeBalance($organizer, ONE_POST_PRICE)) {
					$removeSumm = ONE_POST_PRICE*(-1);
					$Wallet->addTransaction('UAH', $organizer, $removeSumm, 'NULL', 1);
					$Tournaments->add($title, $places, $free_places, $datetime, $game, $price, $description, $organizer);
					echo "0";
				} else {
					echo "2";
				}
			}
		}

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


	// INTERKASSA

	public function interkassa_interaction_UAH(){
		$Wallet = new Wallet();
		$Users  = new Users();

		$key      = 'NwHmqxhvETWJc07g';
		$keyDebug = 'rc5XaZ5TL2EmMshc';
		
		$status = 1;

		$dataSet = $_POST;

		if (!$dataSet) {
			$status = 2;
		}

		unset($dataSet['ik_sign']);
		ksort($dataSet, SORT_STRING);
		array_push($dataSet, $key);
		$signString = implode(':', $dataSet);
		$sign = base64_encode(md5($signString, true));

		if ($sign != $_POST['ik_sign']) {
			$status = 3;
		}

		$Wallet->addTransaction($_POST['ik_cur'], $_POST['ik_x_id'], $_POST['ik_am'], $_POST['ik_pm_no'], $status);

		if ($status == 1) {
			$Users->addBalance($_POST['ik_x_id'], $_POST['ik_am']);
		}
	}


	// ADMIN SCRIPTS

	public function admin(){
		$pieces = explode("/", $_SERVER['REQUEST_URI']);
		if ($pieces[1]!='admin') {
			die('NOT ADMIN CALL FOR ADMIN API!!!');
		}
	}

	public function banUser(){
		$this->admin();

		$Users = new Users();

		$id = $_GET['user_id_send'];

		$Users->banUser($id);

		return 0;
	}

	public function de_banUser(){
		$this->admin();

		$Users = new Users();

		$id = $_GET['user_id_send'];

		$Users->de_banUser($id);

		return 0;
	}

	public function setOrganizer(){
		$this->admin();

		$Users = new Users();

		$id = $_GET['user_id_send'];

		$Users->setOrganizer($id);

		return 0;
	}

	public function de_setOrganizer(){
		$this->admin();

		$Users = new Users();

		$id = $_GET['user_id_send'];

		$Users->de_setOrganizer($id);

		return 0;
	}

	public function addOrganizer(){
		$this->admin();

		$Organizers = new Organizers();

		$owner_id   = $_GET['owner'];
		$login      = $_GET['login'];
		$link       = $_GET['link'];
		$reputation = $_GET['reputation'];

		$Organizers->add($owner_id, $login, $link, $reputation);

		return 0;
	}

	public function editOrganizer(){
		$this->admin();

		$Organizers = new Organizers();

		$id         = $_GET['id'];
		$owner_id   = $_GET['owner'];
		$login      = $_GET['login'];
		$link       = $_GET['link'];
		$reputation = $_GET['reputation'];

		$Organizers->edit($id, $owner_id, $login, $link, $reputation);

		return 0;
	}

	public function generatePromoCodes(){
		$this->admin();

		$PromoCodes = new PromoCodes();

		$Organizers = new Organizers();

		$count = $_GET['count'];

		$PromoCodes->generate($count);

		return 0;
	}
}
?>