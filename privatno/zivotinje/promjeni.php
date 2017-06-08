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
	
	$izraz=$veza->prepare("select * from zivotinje where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
	$d = strtotime($_POST["datumrodenja"]);
				if($d!=""){
			$_POST["datumrodenja"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["datumrodenja"]="";
			}
}

if(isset($_POST["promjeni"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["datumrodenja"]);
	
	if(!$d){
 		$poruke["datumrodenja"]="Format datum nije dobar";
 	}
	
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		

		
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("update  zivotinje
		set	imezivotinje=:imezivotinje,vrsta=:vrsta,brojmarkice=:brojmarkice,
		datumrodenja=:datumrodenja,kilaza=:kilaza,cijena=:cijena,zgrada=:zgrada
		where sifra=:sifra");
		$izraz->bindParam("sifra",$_POST["sifra"]);
	$izraz->bindParam("imezivotinje",$_POST["imezivotinje"]);
	$izraz->bindParam("vrsta",$_POST["vrsta"]);
	$izraz->bindParam("brojmarkice",$_POST["brojmarkice"]);
	$izraz->bindParam("kilaza",$_POST["kilaza"]);
	$izraz->bindParam("cijena",$_POST["cijena"]);
	$izraz->bindParam("zgrada",$_POST["zgrada"]);
	
	if($_POST["datumrodenja"]==""){
		$izraz->bindValue("datumrodenja",$t=null,PDO::PARAM_NULL);
	}else{
		$izraz->bindParam("datumrodenja",$d->format("Y-m-d"));
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
				$("#imez").focus();
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
      	
      	 var datum = document.getElementById('datumrodenja').value;
				
		$("#datumrodenja").datepicker();
		$("#datumrodenja").datepicker("option", $.datepicker.regional['hr']);
		$("#datumrodenja").val(datum);
		</script>
	</body>
</html>
