<?php
//script here
$Engine = new Engine();

$id_pm_no = date("Y_m_d__H_i_s")."_".$Engine->generateRandomString(5);

$user_id = $_COOKIE['id'];


//Other data here
$OG_data = array(
    'type'          => 'article',
    'title'         => SITE_NAME." - Мой кошелёк",
    'site_name'     => SITE_NAME,
    'url'           => PROTOCOL.DOMAIN.REQUEST_URI,
    'image'         => PROTOCOL.DOMAIN.'/templates/assets/logo.png',
    'description'   => 'бла бла',
);

$META_data = array(
    'title'         => SITE_NAME." - Мой кошелёк",
    'page_name'     => 'О нас',
    'keywords'      => "MyRM, my real motivation",
    'description'   => 'бла бла',
);


// Assignment values to $data array 
$data['id_pm_no'] = $id_pm_no;
$data['user_id']  = $user_id;

// Assignment other data to $OTHER_data array 
$OTHER_data['OG']   = $OG_data;
$OTHER_data['META'] = $META_data;
?>