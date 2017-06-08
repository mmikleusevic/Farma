<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../../odjava.php");
}

if(!isset($_GET["sifra"]) && !isset($_POST["sifraVlasnika"])){
	header("location: ../../odjava.php");
	exit;
}

include_once '../../predlozak/unosPolja.php';
$poruke=array();


if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../odjava.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	
	$izraz=$veza->prepare("
	select a.sifra as sifraVlasnika,
	a.sifra, a.ime,a.prezime,a.nazivgospodarstva,a.oibgospodarstva,a.brojzgrada,a.email,a.lozinka from vlasnik a inner join operater b on b.vlasnik=a.sifra
	where b.sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST["promjeni"])){
	$nacin="update";
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["promjeni"]);
		$veza->beginTransaction();
		
		$izraz=$veza->prepare("update vlasnik 
		set ime=:ime,prezime=:prezime,nazivgospodarstva=:nazivgospodarstva,oibgospodarstva=:oibgospodarstva,brojzgrada=:brojzgrada,email=:email,lozinka=:lozinka
		where sifra=:sifra");
		$izraz->execute(array(
		"ime" => $_POST["ime"],
		"prezime" => $_POST["prezime"],
		"nazivgospodarstva" => $_POST["nazivgospodarstva"],
		"oibgospodarstva" => $_POST["oibgospodarstva"],
		"brojzgrada" => $_POST["brojzgrada"],
		"email" => $_POST["email"],
		"lozinka" => $_POST["lozinka"],
		"sifra" => $_POST["sifraVlasnika"]
		));
		
		$veza->commit();
		header("location: profil.php");
	}
}


?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../../predlozak/izbornik.php';
		?>
		
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" 
			method="post">
			<fieldset class="fieldset">
				<legend>Promjenite podatke</legend>
				
				
				<?php 	include_once 'atributi.php'; ?>
				
				<input type="hidden" name="sifraVlasnika" value="<?php echo $_POST["sifraVlasnika"] ?>" />
				
				
			</fieldset>
		
		
		<div class="row">
			<div class="large-6 columns">
				<a class="alert button expanded" href="index.php">Odustani</a>
		
			</div>
			<div class="large-6 columns">
				<input name="promjeni" class="success button expanded" type="submit" value="Promjeni" />
	
			</div>
		</div>
		
		</form>
			
		<?php
	include_once "../../predlozak/skripta.php";
		?>
		<script>
			<?php 
			if(!isset($_POST["dodaj"])){
				?>
				$("#ime").focus();
				<?php
			}else{
				foreach ($poruke as $key => $value) {
					?>
					$("#<?php echo $key ?>").focus();
					<?php
					break;
				}
				?>
				
				<?php
			}
			?>
		</script>
	</body>
</html>
