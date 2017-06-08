<?php

//radi provjere
	$_POST["nazivpolja"]=trim($_POST["nazivpolja"]);
	if(strlen($_POST["nazivpolja"])==0){
		$poruke["nazivpolja"]="Naziv obavezno";
	}
	if(strlen($_POST["nazivpolja"])>30){
		$poruke["nazivpolja"]="Dužina naziva mora biti manja od 30";
	}
	if($_POST["velicinapolja"]==0){
		$poruke["velicinapolja"]="Velićina polja obavezno";
	}
	if(strlen($_POST["velicinapolja"])>15){
		$poruke["velicinapolja"]="Velićina polja mora imati manje od 15 znamenki";
	}
	if($_POST["vlasnik"]==0){
		$poruke["vlasnik"]="Vlasnik obavezno";
	}
	