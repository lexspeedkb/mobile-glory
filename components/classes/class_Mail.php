<?php
class Mail{
	public function send_email($to, $subject, $message){
	    if(USE_SMTP){
	        require ROOT.'/libraries/php/PHPMailer/PHPMailerAutoload.php';
        	$mail = new PHPMailer;
        	
        	$mail->CharSet = 'UTF-8';
        	$mail->isSMTP();
        	$mail->Host = SMTP_HOST;
        	$mail->SMTPAuth = SMTP_AUTH;
        	$mail->Username = SMTP_USER;    //Логин
        	$mail->Password = SMTP_PASS;              //Пароль
        	if(SMTP_SECU!=""){
        	    $mail->SMTPSecure = SMTP_SECU;
        	}
        	$mail->Port = SMTP_PORT;
        		
        	$mail->addAddress($to);
        		
        	$mail->setFrom(emailHeaderFromAdress, emailHeaderFromName);
        	$mail->isHTML(true);
        		 
        	$mail->Subject = $subject;
        	$mail->Body    = $message;
        	$mail->AltBody = $message;//without html
        		 
        	//Отправка сообщения
        	if(!$mail->send()){
        	//    echo 'Ошибка при отправке. Ошибка: ' . $mail->ErrorInfo;
        	}else{
        	//    echo 'Сообщение успешно отправлено';
        	}
	    }else{
	       	$headers = 'From: '.emailHeaderFromAdress."\r\n".'Content-Type: text/html; charset=utf-8'."\r\n";
    	    mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $message, $headers);
	    }
	} 
}
?>