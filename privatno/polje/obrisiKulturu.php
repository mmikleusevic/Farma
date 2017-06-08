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
	$izraz = $veza->prepare("delete from kulturaugodini
	where polje=:polje and kultura=:kultura");
	$izraz->execute($_POST);
	
	echo "OK";