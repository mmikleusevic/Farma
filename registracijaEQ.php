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
		
		
		$to      = $_POST["email"];
$subject = 'Farma autorizacija email-a';

$email = file_get_contents("emailTemplate.html");
$email = str_replace("{{IME}}", $_POST["ime"] . " " . $_POST["prezime"], $email);
$email = str_replace("{{LINK}}", "<a href=\"http://" . $_SERVER["SERVER_NAME"] . $putanjaAPP .  "verificirajEmail.php?sifra=" . $zadnji . "\">Link</a>", $email);

$message = $email;


$headers = "From: Farma Registracija <registracija@edunova.e-quinox.hr>\r\n";
$headers .= "Reply-To: registracija@edunova.e-quinox.hr\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($to, $subject, $message, $headers);
		
		
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
