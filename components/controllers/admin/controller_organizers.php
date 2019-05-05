<?php
//script here
$Organizers = new Organizers();

$organizersList = $Organizers->getAll();

//Other data here
$OG_data = array(
    'type'          => 'article',
    'title'         => SITE_NAME." - Главная",
    'site_name'     => SITE_NAME,
    'url'           => PROTOCOL.DOMAIN.REQUEST_URI,
    'image'         => PROTOCOL.DOMAIN.'/templates/assets/logo.png',
    'description'   => 'бла бла',
);

$META_data = array(
    'title'         => SITE_NAME." - Главная",
    'page_name'     => 'АДМИН - организаторы',
    'keywords'      => "MyRM, my real motivation",
    'description'   => 'бла бла',
);


// Assignment values to $data array 
$data['organizersList'] = $organizersList;

// Assignment other data to $OTHER_data array 
$OTHER_data['OG']   = $OG_data;
$OTHER_data['META'] = $META_data;
?>