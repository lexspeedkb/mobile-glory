<?php
session_start();
//pubg
define("ROOT", $_SERVER['DOCUMENT_ROOT']);

ini_set('error_reporting', E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require ROOT.'/components/autoloader.php';

$Page = new Page();
$Page->getPage();

// GET ERRORS
// BASCET
// 1 - Empty email
// 2 - Wrong email
if($_GET['err']==1){
	alert("Пустой E-mail");
}elseif($_GET['err']==2){
	alert("Неверный E-mail");
}elseif($_GET['err']==3){
	alert("Вы успешно подписались на новостную рассылку!");
}
?>
<?php
//print_r_pre($_SESSION);
//echo "<hr>";
//print_r_pre($_POST);
//Payment::activateZacaz("lexspeedkb@gmail.com");
//print_r_pre(unserialize($_SESSION['arr']));
?>