<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../../odjava.php");
	exit;
}

if (!isset($_POST["polje"]) && !isset($_POST["kultura"])){ 
	header("location: ../../odjava.php");
	exit;
}
	$izraz = $veza->prepare("insert into kulturaugodini (polje, kultura) 
	values (:polje,:kultura)");
	$izraz->execute($_POST);
	
	echo "OK";