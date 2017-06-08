<?php
include_once 'konfiguracija.php';

if(isset($_POST["registracija"])){
	//kontrole
	unset($_POST["registracija"]);
		$izraz=$veza->prepare("insert into registracija 
		(podaci) values 
		(:podaci)");
		$izraz->execute(array("podaci"=>json_encode($_POST)));
		$zadnji=$veza->lastInsertId();
		//slanje mail
		require 'phpmailer/PHPMailerAutoload.php';
			//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "milardovicpaula";
//Password to use for SMTP authentication
$mail->Password = "jisd2y3an";
//Set who the message is to be sent from
$mail->SetFrom('milardovicpaula@gmail.com', 'Paula Farma');

//Set an alternative reply-to address
   $mail->AddReplyTo("milardovicpaula@gmail.com","Paula Farma");

//Set who the message is to be sent to
$mail->AddAddress($_POST["email"], "");
//Set the subject line
$mail->Subject = 'Farma autorizacija email-a';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("Klik na <a href=\"http://" . $_SERVER["SERVER_NAME"] . $putanjaAPP .  "verificirajEmail.php?sifra=" . $zadnji . "\">Link</a> za potvrdu email-a");
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
	</head>
	<body>
<div class="row">
	<div class="large-6 large-centered columns">
		<div class="success callout">
	     <form method="post" action="<?php echo $_SERVER["PHP_SELF"]  ?>">
    	
    	<label>Ime
    		<input type="text" required="required" name="ime"
    		placeholder="Pero" value="<?php echo isset($_GET["ime"]) ? $_GET["ime"] : "" ?>"/>
    		</label>
    		
    		<label>Prezime
    		<input type="text" required="required" name="prezime"
    		placeholder="Perić" value="<?php echo isset($_GET["prezime"]) ? $_GET["prezime"] : "" ?>"/>
    		</label>
    		
    		<label>Email
    		<input type="email" required="required" name="email"
    		placeholder="pero@gmail.com" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : "" ?>"/>
    		</label>
    	
    	<label>Korisnik
    		<input type="text" required="required" name="korisnik"
    		placeholder="pero" value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : "" ?>"/>
    		</label>
    		
    	<label>Lozinka
    		<input type="password" required="required" name="lozinka" />
    		</label>
    		
    		<label>Lozinka ponovo
    		<input type="password" required="required" name="lozinkaponovo" />
    		</label>
    		
    		<input class="expanded button" type="submit" name="registracija" value="Prijava" />
    		
    		
    </form>
    <?php
    if (isset($_GET["korisnik"])):
    ?>
    <div class="alert callout">
    	Kriva lozinka.
    </div>
    <?php
	endif;
    ?>
		</div>
	</div> 
</div>
		<?php
	include_once "predlozak/skripta.php";
		?>
	</body>
</html>
