<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
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
	
	$izraz=$veza->prepare("select * from polje where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
	$d = strtotime($_POST["godinakulture"]);
				if($d!=""){
			$_POST["godinakulture"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["godinakulture"]="";
			}
}

if(isset($_POST["promjeni"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["godinakulture"]);
	
	if(!$d){
 		$poruke["godinakulture"]="Format datum nije dobar";
 	}
	
	include_once 'kontrola.php';
	
	if(count($poruke)==0){
		

		
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("update  polje
		set 
		nazivpolja=:nazivpolja,velicinapolja=:velicinapolja,koordinate=:koordinate,godinakulture=:godinakulture,
		vlasnik=:vlasnik
		where sifra=:sifra");
		$izraz->bindParam("sifra",$_POST["sifra"]);
	$izraz->bindParam("nazivpolja",$_POST["nazivpolja"]);
	$izraz->bindParam("velicinapolja",$_POST["velicinapolja"]);
	$izraz->bindParam("koordinate",$_POST["koordinate"]);
	$izraz->bindParam("vlasnik",$_POST["vlasnik"]);
	
	if($_POST["godinakulture"]==""){
		$izraz->bindValue("godinakulture",$t=null,PDO::PARAM_NULL);
	}else{
		$izraz->bindParam("godinakulture",$d->format("Y-m-d"));
	}		
		$izraz->execute();
		header("location: index.php");
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
				<legend>Promjenite podatke</legend>
				
				Kultura
				
				<input id="uvjet" type="text" />
					<table>
    				<thead>
    					<tr>
    						<th>Naziv kulture</th>
    						<th>Akcija</th>
    					</tr>
    				</thead>
    				<tbody id="podaci">
    					
    				
    			<?php 
    			
				
				
    			
    		
				   	$izraz = $veza->prepare("select 
				   	 a.sifra,
				   	 concat(a.nazivkulture, ' ',a.marka) as kultura,
				   	 count(b.polje) as ukupno
				   	 from kultura a
				   	 left join kulturaugodini b on a.sifra=b.kultura
				   	 left join polje c on c.sifra=b.polje
				   	 where b.polje=:polje 
				   	 group by a.sifra,
				   	 concat(a.nazivkulture, ' ',a.marka)
				   	 order by a.nazivkulture,a.marka");
						$izraz->execute(array("polje" => $_POST["sifra"]));
						$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
						//d($rezultati);
						
						foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red -> kultura; ?></td>
								<td><a class="kultura" id="k_<?php echo $red -> sifra; ?>" href="#">Obriši</a>
									</td>
							</tr>
							
							<?php
							endforeach;
				?>
				</tbody>
    			</table>
				
				
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
				$("#nazivk").focus();
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
		
		
		
		$("#uvjet").autocomplete({
				    source: "traziKulturu.php?polje=<?php echo $_POST["sifra"] ?>",
				    minLength: 3,
				    focus: function( event, ui ) {
				    	event.preventDefault();
				    	},
				    select: function(event, ui) {
				        $(this).val('').blur();
				        event.preventDefault();
				        spremiUBazu(ui.item);
				    }
					}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
				      return $( "<li>" )
				        .append( "<a>" + objekt.nazivkulture + " " + objekt.marka + "</a>" )
				        .appendTo( ul );
				    };
		
		
		
		function spremiUBazu(kultura){
			if(kultura.sifra==0){
				return;
			}
				var polje = <?php echo $_POST["sifra"] ?>;
				
				$.ajax({
				type: "POST",
				url: "dodajKulturu.php",
				data: "polje=" + polje + "&kultura=" + kultura.sifra,
				success: function(vratioServer){
					if(vratioServer=="OK"){
						$("#podaci").append("<tr><td>" + kultura.nazivkulture
						+ " " + kultura.marka + "</td><td>" 
						+ "<a href=\"#\" class=\"kultura\" id=\"k_" + kultura.sifra + "\">Obriši</a></td></tr>");
						definirajBrisanje();
						$("#uvjet").focus();
					}else{
						alert(vratioServer);
					}
					}
					
				});
			}
		
		
		
		function definirajBrisanje(){
		$(".kultura").click(function(){
				var polje = <?php echo $_POST["sifra"]?>;
				var element = $(this);
				var kultura =element.attr("id").split("_")[1];
				$.ajax({
				type: "POST",
				url: "obrisiKulturu.php",
				data: "polje=" + polje + "&kultura=" + kultura,
				success: function(vratioServer){
					if(vratioServer=="OK"){
						element.parent().parent().remove();
					}else{
						alert(vratioServer);
					}
					}
					
				});
				
				
				return false;
			});
		
		}
		
		definirajBrisanje();
		
		</script>
	</body>
</html>
