<?php
include_once '../../konfiguracija.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../../odjava.php");
}
//print_r(isAdmin());
if (!isAdmin()) {
	header("location: ../../odjava.php");
}
$uvjet = "";
$uvjet = "";
if (isset($_GET["uvjet"])) {
	$uvjet = "%" . $_GET["uvjet"] . "%";
} else {
	$uvjet = "";
}

$poStranici = 6;

$izraz = $veza -> prepare("
			select count(a.sifra) from operater a inner join vlasnik b on a.vlasnik=b.sifra where a.vlasnik like :uvjet;
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

		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
					<input id="uvjet" value="<?php echo str_replace("%", "", $uvjet); ?>" type="text" name="uvjet" placeholder="dio naziva" />
				</form>
			</div>
			<?php $izraz = $veza -> prepare("select a.uloga,a.sifra as sifra,a.vlasnik,b.sifra,b.ime,b.prezime,b.oibgospodarstva
											 from operater a inner join vlasnik b on a.vlasnik=b.sifra
											 where a.vlasnik like :uvjet
											 order by a.uloga,b.ime limit :odKuda,:poStranici; ");
			$izraz -> execute(array("uvjet" => $uvjet, "odKuda" => $odKuda, "poStranici" => $poStranici));

			$rezultati = $izraz -> fetchAll(PDO::FETCH_OBJ);

			foreach ($rezultati as $red) :

				include '../../privatno/operateri/operaterecho.php';

			endforeach;
			?>
		</div>
		<?php if(isset($_GET["uvjet"])):?>
			<ul class="pagination text-center" role="navigation" aria-label="Pagination" data-page="6" data-total="16">
			<li>
				<a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&<?php echo "stranica=" . ($stranica-1) ?>" >&#8592; <span class="show-for-sr">stranica</span></a>
			</li>	
			<?php 	
			$i=$stranica;	
			if($i!=1 && $i>1):?>
			<li><a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&stranica=1" ><?php echo 1 ?></a></li>
			<?php endif; ?>

			<?php if($i>1):?>
			<li>...</li>
			<?php endif; ?>
			
			<?php 
			if($i==$stranica):
			 ?>
			<li class="current"><span class="show-for-sr">Vi ste na stranici</span> <?php echo $i ?></li>
			<?php endif; ?>
			
			<?php if($i<$ukupnoStranica):?>
			<li>...</li>
			<?php endif; ?>

			<?php 
			if($i!=$ukupnoStranica):?>
			<li><a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&stranica=$ukupnoStranica" ><?php echo $ukupnoStranica ?></a></li>
			<?php endif; ?>
			<li>
				<a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&<?php echo "stranica=" . ($stranica+1) ?>">&#8594; <span class="show-for-sr">stranica</span></a>
			</li>
			
		</ul>
		<?php	endif; ?>
		<?php
		include_once "../../predlozak/skripta.php";
		?>
		<script>
			$("#uvjet").focus();
		</script>
	</body>
</html>
