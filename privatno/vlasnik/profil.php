<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../../odjava.php");
}
$uvjet = "";
if (isset($_GET["uvjet"])) {
	$uvjet = "%" . $_GET["uvjet"] . "%";
} else {
	$uvjet = "";
}

$poStranici = 6;

$izraz = $veza -> prepare("
			select count(a.sifra) from vlasnik a
			where a.sifra like :uvjet;
			");
$izraz -> execute(array("uvjet" => $uvjet));
$ukupno = $izraz -> fetchColumn();

$ukupnoStranica = ceil($ukupno / $poStranici);

if (isset($_GET["stranica"])) {
	$stranica = $_GET["stranica"];
} else {
	$stranica = 1;
}

if ($stranica > $ukupnoStranica) {
	$stranica = 1;
}

if ($stranica == 0) {
	$stranica = $ukupnoStranica;
}

$odKuda = $stranica * $poStranici - $poStranici;
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
	

		<?php

		$izraz = $veza -> prepare("
		select a.sifra,b.sifra, a.ime,a.prezime,a.nazivgospodarstva,a.oibgospodarstva,a.brojzgrada,a.email,a.lozinka from vlasnik a inner join operater b on a.sifra=b.vlasnik
		where b.sifra like :uvjet 
		");
		$izraz -> execute(array($_SESSION[$sid . "autoriziran"]->sifra));

		$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);

		foreach ($rezultati as $red) : 
		
		include '../../privatno/vlasnik/vlasnikechoo.php'; 
	
		endforeach;
		 ?>
<div class="reveal" id="slikaModal" data-reveal>
	<form method="post" action="slika.php" enctype="multipart/form-data">
    	<label>Slika
    		<input type="file" required="required" name="slika"/>
    		</label>
    		
    		<input type="hidden" id="oibgospodarstva" name="oibgospodarstva" />
    		
    		<input class="expanded button" type="submit" name="autorizacija" value="Postavi" />
    		
    		
    </form>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
		
		
		
		
		
		
		<?php
	include_once "../../predlozak/skripta.php";
		?>
		<script>

			$("#uvjet").focus();
			
			
			$(".postaviSlikuu").click(function(){
				$("#oibgospodarstva").val($(this).attr("id").split("_")[1]);
				$("#slikaModal").foundation("open");
				
				
				
				return false;
			});
			
		</script>
	</body>
</html>
