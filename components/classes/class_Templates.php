<?php
/**
 * 
 */
class Templates{

	public function render($page="404", $data, $OTHER_data="", $lang){
		$template = array();

		$OTHER_data['OG'];


		// OG, META and other data generation
		// Open Graph generate
		if(!empty($OTHER_data['OG'])){
			$template['head']['OG'] = OG_generate($OTHER_data['OG']['type'], $OTHER_data['OG']);
		}
		$template['head']['META'] = $OTHER_data['META'];
	
		// Render all parts of page
		$this->render_head($lang, $template);
		$this->render_head_nav($lang, $data);
		if(!empty($page)){
			require ROOT."/templates/".$page.".php";
		}
		$this->render_footer_nav($lang, $data);
		$this->render_footer($lang, $template);
		
	}
	
	public function render_head($lang, $template){
		include $_SERVER['DOCUMENT_ROOT'].'/templates/includes/head.php';
	}

	public function render_footer($lang, $template){
		include $_SERVER['DOCUMENT_ROOT'].'/templates/includes/footer.php';
	}

	public function render_head_nav($lang, $data){
		include $_SERVER['DOCUMENT_ROOT'].'/templates/includes/head_nav.php';
	}

	public function render_footer_nav($lang, $data){
		include $_SERVER['DOCUMENT_ROOT'].'/templates/includes/footer_nav.php';
	}

}
?>