<?php
include_once 'konfiguracija.php';
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
	</head>
	<body>
<div class="row">
	<div class="large-6 large-centered columns">
		<div class="success callout">
	     <form method="post" action="autoriziraj.php">
    	<label>Korisnik
    		<input type="text" required="required" name="korisnik"
    		placeholder="pero" value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : "" ?>"/>
    		</label>
    		
    	<label>Lozinka
    		<input type="password" required="required" name="lozinka" />
    		</label>
    		
    		<input class="expanded button" type="submit" name="autorizacija" value="Prijava" />
    		
    		
    </form>
    <?php
    if (isset($_GET["korisnik"])):
    ?>
    <div class="alert callout">
    	Kriva lozinka.
    </div>
    <?php
	endif;
    ?>
		</div>
	</div> 
</div>
		<?php
	include_once "predlozak/skripta.php";
		?>
	</body>
</html>
