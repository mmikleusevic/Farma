<?php

$to      = $_POST["email"];
$subject = 'Farma autorizacija email-a';

$email = file_get_contents("emailTemplate.html");
$email = str_replace("{{IME}}", $_POST["ime"], $email);
$email = str_replace("{{LINK}}", "<a href=\"" . $_POST["link"] . "\">Link</a>" , $email);

$message = $email;


$headers = "From: Farma Registracija <registracija@edunova.e-quinox.hr>\r\n";
$headers .= "Reply-To: registracija@edunova.e-quinox.hr\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

if (mail($to, $subject, $message, $headers)){
	echo "OK";
}else{
echo "GRESKA";	
}
	
	