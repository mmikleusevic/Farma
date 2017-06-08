<?php
include_once '../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../odjava.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../predlozak/head.php';
		?>
	</head>
	<body class="era">
		<?php
		include_once '../predlozak/izbornik.php';
		?>
		<img src="<?php echo $putanjaAPP ?>img/eradijagrammarinmikleusevic.png" / class="slikaera">
		<?php
	include_once "../predlozak/skripta.php";
		?>
		
	</body>
</html>
