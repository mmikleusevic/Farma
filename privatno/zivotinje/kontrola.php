<?php
	$_POST["imezivotinje"]=trim($_POST["imezivotinje"]);
	if(strlen($_POST["imezivotinje"])==0){
		$poruke["imezivotinje"]="Ime obavezno";
	}
	if(strlen($_POST["vrsta"])>30){
		$poruke["vrsta"]="Vrsta životinje ne može biti veća od 30 znamenki";
	}
	if(strlen($_POST["vrsta"])==0){
		$poruke["vrsta"]="Vrsta životinje obavezno";
	}	
	if(strlen($_POST["brojmarkice"])>20){
		$poruke["brojmarkice"]="Broj markice životinje ne može biti veći od 20 znamenki";
	}
	if(strlen($_POST["brojmarkice"])==0){
		$poruke["brojmarkice"]="Broj markice životinje obavezno";
	}	
	if(strlen($_POST["kilaza"])>18){
		$poruke["kilaza"]="Kilaža životinje ne može biti veća od 18 znamenki";
	}
	if(strlen($_POST["cijena"])>15){
		$poruke["kilaza"]="Cijena životinje ne može biti veća od 15 znamenki";
	}
	if($_POST["zgrada"]==0){
		$poruke["zgrada"]="Zgrada obavezno";
	}
	