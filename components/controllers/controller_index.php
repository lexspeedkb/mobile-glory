<?php
//script here
$newsList = array("news1","news2", 123, "Asda");


//Other data here
$OG_data = array(
	'type' 			=> 'article',
	'title' 		=> SITE_NAME." - Главная",
	'site_name' 	=> SITE_NAME,
	'url'			=> PROTOCOL.DOMAIN.REQUEST_URI,
	'image'			=> PROTOCOL.DOMAIN.'/templates/assets/logo.png',
	'description'	=> 'Лучшие турниры по мобильным играм. Присоединяйся, и учавствуй в турнирах по PUBG Mobile, и другим онлайн-играм',
);

$META_data = array(
	'title' 		=> SITE_NAME." - Главная",
	'keywords'		=> "Mobile Glory",
	'description'	=> 'Лучшие турниры по мобильным играм. Присоединяйся, и учавствуй в турнирах по PUBG Mobile, и другим онлайн-играм',
);


// Assignment values to $data array 
$data['newsList'] 	= $newsList;

// Assignment other data to $OTHER_data array 
$OTHER_data['OG'] 	= $OG_data;
$OTHER_data['META']	= $META_data;
?>