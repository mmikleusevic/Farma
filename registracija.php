<?php
include_once 'konfiguracija.php';

if (isset($_POST["registracija"])) {
	//kontrole
	unset($_POST["registracija"]);
	include_once 'kontrola.php';
	$izraz = $veza -> prepare("insert into registracija 
		(podaci) values 
		(:podaci)");
	$izraz -> execute(array("podaci" => json_encode($_POST)));
	$zadnji = $veza -> lastInsertId();

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://edunova.e-quinox.hr/registracijaAPI.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $_POST["email"] . "&ime=" . $_POST["ime"] . " " . $_POST["prezime"] . "&link=http://" . $_SERVER["SERVER_NAME"] . $putanjaAPP . "verificirajEmail.php?sifra=" . $zadnji);

	// in real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS,
	//          http_build_query(array('postvar1' => 'value1')));

	// receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close($ch);

	// further processing ....
	if ($server_output == "OK") {
		echo "poslano";
	} else { echo "Greška";
	}

}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
		<?php
		include_once 'predlozak/izbornik.php';
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
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		include_once 'predlozak/prijava.php';
		?>
		<?php
		include_once "predlozak/skripta.php";
		?>
	</body>
</html>
