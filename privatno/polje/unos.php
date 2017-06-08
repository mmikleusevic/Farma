<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../../odjava.php");
}

$izraz=$veza->prepare("insert into polje 
		(nazivpolja,velicinapolja,koordinate,vlasnik,godinakulture) values 
		(:nazivpolja,:velicinapolja,:koordinate,:vlasnik,now())");
		
	$izraz->bindValue("nazivpolja","Promjeni me");
	$zadnji = $veza->lastInsertId();
	$izraz->bindValue("vlasnik",1);
	$izraz->bindValue("velicinapolja",0);
	$izraz->bindValue("koordinate",0);
	
	
	
		
		$izraz->execute();
		$zadnji = $veza->lastInsertId();
		header("location: promjena.php?sifra=" . $zadnji);

include_once '../../predlozak/unosPolja.php';
$poruke=array();

if(isset($_POST["dodaj"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["godinakulture"]);
	
	if(!$d){
 		$poruke["godinakulture"]="Format datum nije dobar";
 	}
	
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		

		
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("insert into polje 
		(nazivpolja,velicinapolja,koordinate,godinakulture,vlasnik) values 
		(:nazivpolja,:velicinapolja,:koordinate,:godinakulture,:vlasnik)");
		
	$izraz->bindParam("nazivpolja",$_POST["nazivpolja"]);
	$izraz->bindParam("velicinapolja",$_POST["velicinapolja"]);
	$izraz->bindParam("koordinate",$_POST["koordinate"]);
	
	if($_POST["godinakulture"]==""){
		$izraz->bindValue("godinakulture",$t=null,PDO::PARAM_NULL);
	}else{
		$izraz->bindParam("godinakulture",$d->format("Y-m-d"));
	}
	
	
		$izraz->bindParam("vlasnik",$_POST["vlasnik"]);
		
		$izraz->execute();
		$zadnji = $veza->lastInsertId();
		header("location: promjena.php?sifra=" . $zadnji);
	}
}

//$poruke["naziv"]="Naziv obavezno";

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../predlozak/head.php';
		?>
		<link rel="stylesheet" href="<?php echo $putanjaAPP ?>css/jquery-ui.css">
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
				$("#nazivp").focus();
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
		<script src="<?php echo $putanjaAPP ?>js/jquery-ui.js"></script>
		<script>
			
			$.datepicker.regional['hr'] = {
					closeText : 'Zatvori',
					prevText : 'Prethodni',
					nextText : 'Sljedeći',
					currentText : 'Trenutni',
					monthNames : ['Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj', 'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac'],
					monthNamesShort : ['sij', 'velj', 'ožu', 'tra', 'svi', 'lip', 'srp', 'kol', 'ruj', 'lis', 'stu', 'pro'],
					dayNames : ['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'],
					dayNamesShort : ['ned', 'pon', 'uto', 'sri', 'čet', 'pet', 'sub'],
					dayNamesMin : ['N', 'P', 'U', 'S', 'Č', 'P', 'S'],
					weekHeader : 'Tjedan',
					dateFormat : '<?php echo $formatDatumaJS; ?>',
					firstDay : 1,
					isRTL : false,
					showMonthAfterYear : false,
					yearSuffix : '',
					changeMonth : true,
					changeYear : true,
					showButtonPanel : true,
					yearRange : '1940:2020'
				};
      	$.datepicker.setDefaults($.datepicker.regional['hr']);
      	
      	 var datum = document.getElementById('godinakulture').value;
				
		$("#godinakulture").datepicker();
		$("#godinakulture").datepicker("option", $.datepicker.regional['hr']);
		$("#godinakulture").val(datum);
		</script>
	</body>
</html>
