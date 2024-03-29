<?php
class Page extends SQL{

	/**
	*	Index function
	*/
	public function getPage(){
		$pieces = explode("/", $_SERVER['REQUEST_URI']);

		require ROOT.'/db.php';
		require ROOT.'/components/config.php';

		//Pilipenko libraries
		include ROOT.'/libraries/php/pilipenko.php';
		include ROOT.'/libraries/php/pilipenko_debug.php';
		include ROOT.'/libraries/php/pilipenko_math.php';
		include ROOT.'/libraries/php/pilipenko_sql.php';
		//require ROOT.'/components/jQuery.js';
		//include ROOT.'/components/ajax.js';

		$Engine 	= new Engine();
		$Users  	= new Users();
		
		$pageName = $this->router($pieces);
		$lang 	  = $this->language();
		
		$data['MyAccount'] = $Users->currentLoginCheck();
		$data['pieces']	   = $pieces;

		if ($data['MyAccount']['admin']!='1' && $pieces[1]=='admin') {
			die('NOT ADMIN!!!');
		}

		// Is API
		$pos = strripos($pageName, "[api]");
		if($pos === false){
			if ($pieces[1] != 'admin') {
				//Require controller file. If controller don't exists - abort
				if(!empty($pageName)){
					if(file_exists(ROOT.'/components/controllers/controller_'.$pageName.'.php')){
						require ROOT.'/components/controllers/controller_'.$pageName.'.php';
					}else{
						$Engine->error_404();
					}
				}
				//Render page
				$Templates = new Templates();

				//Different includes for index and portal
				if ($pageName == "index") {
					$Templates->render($pageName, $data, $OTHER_data, $lang, true);
				}else {
					$Templates->render($pageName, $data, $OTHER_data, $lang);
				}
			} else {
				//Require controller file. If controller don't exists - abort
				if(!empty($pageName)){
					if(file_exists(ROOT.'/components/controllers/admin/controller_'.$pageName.'.php')){
						require ROOT.'/components/controllers/admin/controller_'.$pageName.'.php';
					}else{
						echo ROOT.'/components/controllers/admin/controller_'.$pageName.'.php';
						$Engine->error_404();
					}
				}
				//Render page
				$Templates = new Templates();

				$Templates->render('admin/'.$pageName, $data, $OTHER_data, $lang);
			}
		}else{
			//API
			if(OPEN_API){
				header('Access-Control-Allow-Origin: *');
			}

			$API = new API();

			$API_methodName = $this->filterApiName($pageName);
			
			if(method_exists($API, $API_methodName)){ //Chech method exists
				call_user_func(array($API, $API_methodName)); //Load method
			}else{
				$Engine->error_404();
			}
		}
	}

	/**
	 * @param  (arr)$pieces - exploded uri 
	 * 
	 * @return (var)$page 	- required page 
	 *
	 * Returns name of required page 
	 */
	public function router($pieces){
		$Users = new Users();
		$Engine = new Engine();
		
		if($pieces[1]==""){
			//get index //Получение главной страницы
			if($Users->currentLoginCheck()){
				redirect(USER_DEFAULT_PAGE);
				return USER_DEFAULT_PAGE; //if user logged in, redirect him on default page page
			}else{
				return 'index';
			}
			
		}elseif($pieces[1]=="exit"){
			//exit //выход
			$Users->exitUser(true);
		}elseif($pieces[1]=="api"){
			//API
			return "[api]_".$pieces[2];
		}elseif($pieces[1]=="admin" && $pieces[2]=="api"){
			//API
			return "[api]_".$pieces[3];
		}elseif($pieces[1]=="admin" && $pieces[2]!="api"){
			//API
			return $pieces[2];
		}else{
			return $pieces[1];
		}
	}

	/**
	* @param  (varc)$lang 	 - language code
	*
	* @return (stdO)$langRet - stdObject array with dictionary
	*	
	*/
	public function language($lang=DEFAULT_LANGUAGE){
		$langXML = file_get_contents(ROOT.PATH_TO_LANGUAGES.$lang.".xml");

		$lang = simplexml_load_string($langXML);

		$out = xml2array($lang);
		
		foreach ($out as $key => $value) {
			if($key!='comment'){
				$langRet[$key] = str_replace('[br]', '<br>', $value);
			}
		}
		$langRet = arrayToObject($langRet);
		return $langRet;
	}

	public function filterApiName($pageName){
		$API_methodName = explode('?', $pageName);

		$API_methodName = str_replace('[api]_', '', $API_methodName[0]);

		return $API_methodName;
	}
}
?>