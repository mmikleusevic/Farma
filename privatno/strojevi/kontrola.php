<?php



//radi provjere
	$_POST["nazivstroja"]=trim($_POST["nazivstroja"]);
	if(strlen($_POST["nazivstroja"])==0){
		$poruke["nazivstroja"]="Naziv stroja obavezno";
	}
	if(strlen($_POST["nazivstroja"])>50){
		$poruke["nazivstroja"]="Naziv stroja ne može biti veći od 50 znamenki";
	}
	if(strlen($_POST["opis"])>100){
		$poruke["opis"]="Opis stroja ne može biti veća od 100 znamenki";
	}
	if(strlen($_POST["vrijednost"])>18){
		$poruke["vrijednost"]="Vrijednost stroja ne može biti veća od 18 znamenki";
	}
	if($_POST["zgrada"]==0){
		$poruke["zgrada"]="Zgrada obavezno";
	}
	