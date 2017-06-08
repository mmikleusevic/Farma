<?php
include_once 'konfiguracija.php';


if(isset($_POST["autorizacija"])){
	
	
	$izraz=$veza->prepare("select b.sifra,a.ime,a.prezime,a.email,
	 b.uloga,b.lozinka from vlasnik a inner join operater b on b.vlasnik=a.sifra
	 where a.email=:korisnik and b.lozinka=md5(:lozinka)");
	unset($_POST["autorizacija"]);
	$izraz->execute($_POST);
	$vlasnik = $izraz->fetch(PDO::FETCH_OBJ);
	
	if($vlasnik!=null){
		$_SESSION[$sid . "autoriziran"]=$vlasnik;
		header("location: privatno/index.php");
		exit;
	}
	else {
		header("location: autorizacija.php?korisnik=".$_POST["korisnik"]);
	}
}
