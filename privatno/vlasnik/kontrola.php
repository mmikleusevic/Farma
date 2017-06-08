<?php

include_once '../../funkcije.php';

//radi provjere
	$_POST["ime"]=trim($_POST["ime"]);
	if(strlen($_POST["ime"])==0){
		$poruke["ime"]="Ime obavezno";
	}
	if(strlen($_POST["ime"])>30){
		$poruke["ime"]="Dužina imena mora biti manja od 30";
	}
	$_POST["prezime"]=trim($_POST["prezime"]);
	if(strlen($_POST["prezime"])==0){
		$poruke["prezime"]="Prezime obavezno";
	}
	if(strlen($_POST["prezime"])>50){
		$poruke["prezime"]="Dužina prezimena mora biti manja od 50";
	}
	
	$_POST["nazivgospodarstva"]=trim($_POST["nazivgospodarstva"]);
	if(strlen($_POST["nazivgospodarstva"])==0){
		$poruke["nazivgospodarstva"]="Naziv gospodarstva obavezno";
	}
	if(strlen($_POST["nazivgospodarstva"])>100){
		$poruke["nazivgospodarstva"]="Naziv gospodarstva mora biti manji od 100";
	}
	
	$_POST["oibgospodarstva"]=trim($_POST["oibgospodarstva"]);
	if(strlen($_POST["oibgospodarstva"])==0){
		$poruke["oibgospodarstva"]="OIB obavezno";
	}
	
	if(!$dev && !provjeriOIB($_POST["oibgospodarstva"])){
		$poruke["oibgospodarstva"]="OIB neispravan";
	}
	
	if($nacin=="insert"){
	$izraz=$veza->prepare("select count(sifra) from vlasnik where oibgospodarstva=:oibgospodarstva");	
		$izraz->execute(array("oibgospodarstva"=>$_POST["oibgospodarstva"]));
	}else{
		$izraz=$veza->prepare("select count(sifra) from vlasnik where oibgospodarstva=:oibgospodarstva and sifra<>:sifra");
		$izraz->execute(array("oibgospodarstva"=>$_POST["oibgospodarstva"],"sifra"=>$_POST["sifraVlasnika"]));
	}
	
	
	$ukupno = $izraz->fetchColumn();
	
	if($ukupno>0){
		$poruke["oibgospodarstva"]="OIB je već dodjeljen drugoj osobi";
	}
	if(strlen($_POST["brojzgrada"])>11){
		$poruke["brojzgrada"]="Broj zgrada ne smije imati više od 11 znamenki";
	}
	$_POST["email"]=trim($_POST["email"]);
	if(strlen($_POST["email"])==0){
		$poruke["email"]="Email obavezno";
	}
	if(strlen($_POST["email"])>100){
		$poruke["email"]="Dužina emaila mora biti manja od 100 znakova";
	}
	if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  	$poruke["email"]="Invalid email format"; 
	}
	if(isset($_SESSION[$sid . "autoriziran"]) && $_SESSION[$sid . "autoriziran"]->uloga==="admin"):
	$_POST["lozinka"]=trim($_POST["lozinka"]);
	if(strlen($_POST["lozinka"])==0){
		$poruke["lozinka"]="Lozinka obavezno";
	}
	if(strlen($_POST["lozinka"])>32){
		$poruke["lozinka"]="Lozinka mora biti manja od 32 znaka";
	}
	endif;
	?>
	
	