<?php
include_once '../../konfiguracija.php';

if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../../odjava.php");
}

$uvjet="";
		if(isset($_GET["uvjet"])){
			$uvjet="%" . $_GET["uvjet"] . "%";
		}else{
			$uvjet="";
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
		
		<a class="success button expanded" href="unos.php">Unos novog polja</a>
		

		<div class="row">
			<div class="large-12 columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
			<input id="uvjet" value="<?php echo str_replace("%","", $uvjet); ?>" type="text" name="uvjet" placeholder="dio naziva" />
		</form>
			</div>
			<?php
		
			$poStranici=6;
			
			$izraz = $veza -> prepare(" select count(a.sifra) from polje a
			  							where a.sifra like :uvjet");
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
			

			$izraz = $veza -> prepare("
    		select a.sifra,c.polje,count(c.kultura) as kultura, a.nazivpolja, a.velicinapolja,a.koordinate,a.godinakulture as godinakulture, concat(d.nazivkulture, ' ',d.marka),b.ime,b.prezime
			 from polje a left join vlasnik b on a.vlasnik=b.sifra
			 left join kulturaugodini c on a.sifra=c.polje
			 left join kultura d on d.sifra=c.kultura
			 where concat(a.nazivpolja,b.ime,b.prezime,ifnull(kultura,''),a.godinakulture) like :uvjet
			 group by a.sifra,a.nazivpolja,d.nazivkulture,d.marka,a.velicinapolja,a.godinakulture,b.ime,b.prezime
			 order by b.ime,b.prezime,a.nazivpolja,a.sifra limit :odKuda,:poStranici;
    		");
			$izraz -> execute(array("uvjet"=>$uvjet,"odKuda"=>$odKuda,"poStranici"=>$poStranici));
			$niz = $izraz -> fetchAll(PDO::FETCH_OBJ);
			foreach ($niz as $red) {
				include 'stavkaPolje.php';
			}
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
		include_once '../../predlozak/prijava.php';
		?>
		<?php
		include_once '../../predlozak/skripta.php';
		?>
		<script>
			$("#uvjet").focus();
		</script>
	</body>
</html>
