<?php


session_start();
$sid="Farma";
$dev=false;
$GLOBALS["sid"]=$sid;
$formatDatumaPHP="d.m.Y.";
$formatDatumaJS="dd.mm.yy.";


if($_SERVER["SERVER_NAME"]==="localhost"){
	$putanjaAPP="/Farma/";
	$server="localhost";
	$imeBaze="farma";
	$korisnik="edunova";
	$lozinka="edunova";
}else{
	$putanjaAPP="/Farma/";
	$server="sql308.byethost18.com";
	$imeBaze="b18_19194815_Registar";
	$korisnik="b18_19194815";
	$lozinka="13091995m";
}


$veza = new PDO(
	"mysql:host=" . $server . ";dbname=" . $imeBaze,
	$korisnik,
	$lozinka,
	array(
		PDO::ATTR_EMULATE_PREPARES=> false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	)
);

include_once 'uloge.php';







