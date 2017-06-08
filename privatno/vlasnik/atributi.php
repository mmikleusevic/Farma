<?php
				 
				inputPolje("text","ime",$poruke);
				inputPolje("text","prezime",$poruke);
				inputPolje("text","nazivgospodarstva",$poruke);
				inputPolje("text","oibgospodarstva",$poruke);
				inputPolje("number","brojzgrada",$poruke);
				inputPolje("email","email",$poruke);
				if(isset($_SESSION[$sid . "autoriziran"]) && $_SESSION[$sid . "autoriziran"]->uloga==="admin"):
				inputPolje("text","lozinka",$poruke);
				endif; ?>