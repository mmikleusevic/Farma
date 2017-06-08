<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid  .  "autoriziran"])){
	header("location: ../../odjava.php");
}

if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
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
	
	$izraz=$veza->prepare("select * from stroj where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
	$d = strtotime($_POST["datumkupovine"]);
				if($d!=""){
			$_POST["datumkupovine"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["datumkupovine"]="";
			}
	$e = strtotime($_POST["datumservisa"]);
				if($e!=""){
			$_POST["datumservisa"] = date( $formatDatumaPHP, $e ); 
			}else{
				$_POST["datumservisa"]="";
			}
	}

if(isset($_POST["promjeni"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["datumkupovine"]);
	
	if(!$d){
 		$poruke["datumkupovine"]="Format datum nije dobar";
 	}
	
	$e = DateTime::createFromFormat($formatDatumaPHP,$_POST["datumservisa"]);
	
	if(!$e){
 		$poruke["datumservisa"]="Format datum nije dobar";
 	}
	
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		

		
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("update stroj
		set nazivstroja=:nazivstroja,opis=:opis,datumkupovine=:datumkupovine,
		datumservisa=:datumservisa,vrijednost=:vrijednost,zgrada=:zgrada
		where sifra=:sifra");
		$izraz->bindParam("sifra",$_POST["sifra"]);
	$izraz->bindParam("nazivstroja",$_POST["nazivstroja"]);
	$izraz->bindParam("opis",$_POST["opis"]);
	$izraz->bindParam("vrijednost",$_POST["vrijednost"]);
	$izraz->bindParam("zgrada",$_POST["zgrada"]);

	if($_POST["datumkupovine"]==""){
		$izraz->bindValue("datumkupovine",$t=null,PDO::PARAM_NULL);
	}else{
		$izraz->bindParam("datumkupovine",$d->format("Y-m-d"));
	}	
	if($_POST["datumservisa"]==""){
		$izraz->bindValue("datumservisa",$t=null,PDO::PARAM_NULL);
	}else{
		$izraz->bindParam("datumservisa",$e->format("Y-m-d"));
	}		
	
		$izraz->execute();
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
		<link rel="stylesheet" href="<?php echo $putanjaAPP ?>css/jquery-ui.css">
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
				
				<input type="hidden" name="sifra" value="<?php echo $_POST["sifra"] ?>" />
				
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
				$("#nazivs").focus();
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
      	
      	 var datum = document.getElementById('datumkupovine').value;
				
		$("#datumkupovine").datepicker();
		$("#datumkupovine").datepicker("option", $.datepicker.regional['hr']);
		$("#datumkupovine").val(datum);
		
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
      	
      	 var datum = document.getElementById('datumservisa').value;
				
		$("#datumservisa").datepicker();
		$("#datumservisa").datepicker("option", $.datepicker.regional['hr']);
		$("#datumservisa").val(datum);
		</script>
	</body>
</html>
