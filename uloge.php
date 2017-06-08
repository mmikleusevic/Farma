<?php

function isAdmin() {
	//print_r($_SESSION[$GLOBALS["sid"] . "autoriziran"]);
	if ($_SESSION[$GLOBALS["sid"] . "autoriziran"] -> uloga === "admin") {
		return true;
	} else {
		return false;
	}
}


function isAdminORKorisnik(){
	if ($_SESSION[$GLOBALS["sid"] . "autoriziran"] -> uloga === "admin" || 
	$_SESSION[$GLOBALS["sid"] . "autoriziran"] -> uloga === "korisnik") {
		return true;
	} else {
		return false;
	}
}
