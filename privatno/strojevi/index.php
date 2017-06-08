<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../../odjava.php");
}
$uvjet="";
		if(isset($_GET["uvjet"])){
			$uvjet="%" . $_GET["uvjet"] . "%";
		}else{
			$uvjet="";
		}
		
		
		$poStranici=6;
			
			$izraz = $veza -> prepare("
			select count(a.sifra) from stroj a inner join zgrada b on a.zgrada=b.sifra where a.sifra like :uvjet;
			");
			$izraz -> execute(array("uvjet" => $uvjet));
			$ukupno = $izraz->fetchColumn();
			
			$ukupnoStranica=ceil($ukupno/$poStranici);
			
			
			if(isset($_GET["stranica"])){
				$stranica=$_GET["stranica"];
			}else{
				$stranica=1;
			}
			
			if($stranica>$ukupnoStranica){
				$stranica=1;
			}
			
			if($stranica==0){
				$stranica=$ukupnoStranica;
			}
			
			$odKuda = $stranica*$poStranici-$poStranici;
			
			
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
		
		
			<a class="success button expanded" href="unos.php">Unos novog stroja</a>
		
		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
			<input id="uvjet" value="<?php echo str_replace("%","", $uvjet); ?>" type="text" name="uvjet" placeholder="dio naziva" />
		</form>
			</div>
		<?php 
		
		
		
		$izraz=$veza->prepare("
		
		select a.sifra, a.nazivstroja, a.opis,a.datumkupovine,a.datumservisa,a.vrijednost,b.nazivzgrade,c.ime,c.prezime from stroj a 
		inner join zgrada b on a.zgrada=b.sifra
		inner join vlasnik c on c.sifra=b.vlasnik
		where a.sifra like :uvjet
		order by c.ime,c.prezime,a.nazivstroja,a.sifra,a.zgrada,a.opis limit :odKuda,:poStranici;
		");
		$izraz->execute(array("uvjet" => $uvjet, "odKuda"=>$odKuda,"poStranici"=>$poStranici));
		
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		foreach ($rezultati as $red):
		
			include '../../privatno/strojevi/strojeviecho.php';
		
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
