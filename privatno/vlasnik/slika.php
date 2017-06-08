<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../../odjava.php");
}

if(!isset($_POST["oibgospodarstva"])){
	header("location: ../../odjava.php");
	exit;
}

$target_file=$_SERVER["CONTEXT_DOCUMENT_ROOT"] . $putanjaAPP."img/vlasnik/". $_POST["oibgospodarstva"] . ".jpg";
move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file);

header("location: index.php");