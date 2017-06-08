<?php

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
	$_POST["lozinka"]=trim($_POST["lozinka"]);
	if(strlen($_POST["lozinka"])==0){
		$poruke["lozinka"]="Lozinka obavezno";
	}
	if(strlen($_POST["lozinka"])>30){
		$poruke["lozinka"]="Lozinka mora biti manja od 32 znaka";
	}
	
	