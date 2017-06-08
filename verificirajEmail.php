<?php

if(!isset($_GET["sifra"])){
	exit;
}


include_once 'konfiguracija.php';


$izraz=$veza->prepare("select podaci from registracija where sifra=:sifra");
$izraz->execute($_GET);
		
$podaci = json_decode($izraz->fetchColumn());

$veza->beginTransaction();
		
		$izraz=$veza->prepare("insert into vlasnik
		(oibgospodarstva,ime,prezime,email) values 
		(:oibgospodarstva,:ime,:prezime,:email)");
		$izraz->execute(array(
		"oibgospodarstva" => "22",
		"ime" => $podaci->ime,
		"prezime" => $podaci->prezime,
		"email" => $podaci->email,
		));
		
		$zadnji = $veza->lastInsertId();
		
		$izraz=$veza->prepare("insert into operater 
		(vlasnik,lozinka,uloga) values 
		(:vlasnik,md5(:lozinka),'korisnik')");
		$izraz->execute(array(
		"vlasnik" => $zadnji,
		"lozinka" => $podaci->lozinka
		));
		
		$izraz=$veza->prepare("delete from registracija where sifra=:sifra");
		$izraz->execute($_GET);
		
	
		
		$veza->commit();

header("location: index.php");