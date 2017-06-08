<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../../odjava.php");
}
include_once '../../predlozak/unosPolja.php';
$poruke=array();

if(isset($_POST["dodaj"])){
	$nacin="insert";
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["dodaj"]);
		$veza->beginTransaction();
		
		$izraz=$veza->prepare("insert into vlasnik 
		(ime,prezime,nazivgospodarstva,oibgospodarstva,brojzgrada,email,lozinka) values 
		(:ime,:prezime,:nazivgospodarstva,:oibgospodarstva,:brojzgrada,:email,md5(:lozinka))");
		$izraz->execute(array(
		"ime" => $_POST["ime"],
		"prezime" => $_POST["prezime"],
		"nazivgospodarstva" => $_POST["nazivgospodarstva"],
		"oibgospodarstva" => $_POST["oibgospodarstva"],
		"brojzgrada" => $_POST["brojzgrada"],
		"email" => $_POST["email"], 
		"lozinka" => $_POST["lozinka"]
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
				<legend>Unesite podatke</legend>
				
				
				<?php 	include_once 'atributi.php'; ?>
				
				
				
			</fieldset>
		
		
		<div class="row">
			<div class="large-6 columns">
				<a class="alert button expanded" href="index.php">Odustani</a>
		
			</div>
			<div class="large-6 columns">
				<input name="dodaj" class="success button expanded" type="submit" value="Dodaj" />
	
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
