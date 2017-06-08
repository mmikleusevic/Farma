<?php



//radi provjere
$_POST["nazivzgrade"]=trim($_POST["nazivzgrade"]);
	if(strlen($_POST["nazivzgrade"])==0){
		$poruke["nazivzgrade"]="Naziv obavezno";
	}
	$_POST["opis"]=trim($_POST["opis"]);
	if(strlen($_POST["opis"])==0){
		$poruke["opis"]="Opis obavezno";
	}
	if(strlen($_POST["velicina"])>15){
		$poruke["velicina"]="Velicina zgrade ne može biti veća od 15 znamenki";
	}
	if(strlen($_POST["velicina"])==0){
		$poruke["velicina"]="Velicina zgrade obavezno";
	}
	if($_POST["vlasnik"]==0){
		$poruke["vlasnik"]="Vlasnik obavezno";
	}
	
	