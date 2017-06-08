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
	<body class="farma">
		<?php
		include_once 'predlozak/izbornik.php';
		?>
		<div>
		<h1>Farma</h1>
		<img src="<?php echo $putanjaAPP ?>img/farma.jpg" / class="farma">
		</div>
		<?php
		include_once 'predlozak/prijava.php';
		?>
		<?php
		include_once 'predlozak/skripta.php';
		?>
	</body>
</html>
