<?php
//Parser must to return currency in '$parser' variable //Парсер должен возвращать курс в переменной '$parser'
/*$file = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp?date_req=".date("d/m/Y"));

$valutes = array();

foreach ($file AS $el){
    $valutes[strval($el->CharCode)] = strval($el->Value);
}
$rub = $valutes['USD']/$valutes['UAH'];
$parser = $valutes['USD']/$rub;*/
?>