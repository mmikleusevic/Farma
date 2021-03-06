<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../../odjava.php");
}

if(!isset($_GET["sifra"]) && !isset($_POST["sifraZgrade"])){
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
	select a.sifra as sifraZgrade,
	a.opis,a.nazivzgrade, a.velicina,a.vlasnik,v.ime,v.prezime from zgrada a inner join vlasnik v on a.vlasnik=v.sifra
	where a.sifra=:sifra");
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
				
		$izraz=$veza->prepare("update zgrada 
		set nazivzgrade=:nazivzgrade,velicina=:velicina,opis=:opis,vlasnik=:vlasnik
		where sifra=:sifra");
		$izraz->execute(array(
		"nazivzgrade" => $_POST["nazivzgrade"],
		"velicina" => $_POST["velicina"],
		"opis" => $_POST["opis"],
		"sifra" => $_POST["sifraZgrade"],
		"vlasnik" => $_POST["vlasnik"]
		));
		
		$veza->commit();
		header("location: index.php");
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
				
				<input type="hidden" name="sifraZgrade" value="<?php echo $_POST["sifraZgrade"] ?>" />
				
				
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
				$("#nazivz").focus();
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
