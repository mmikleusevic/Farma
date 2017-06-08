<?php
include_once '../../konfiguracija.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../../odjava.php");
	exit;
}
	$izraz = $veza->prepare("select 
				   	 a.sifra,
				   	 a.nazivkulture,
				   	 a.opis,
				   	 a.marka,
				   	 c.nazivpolja
				   	 from kultura a
				   	 left join kulturaugodini b on a.sifra=b.kultura
				   	 left join polje c on c.sifra=b.polje
				   	 where concat(a.nazivkulture, ' ',a.marka) like :uvjet
				   	 and a.sifra not in (select kultura from kulturaugodini where polje=:polje)
				   	 order by a.nazivkulture, a.marka limit 10");
						$izraz->execute(array("uvjet" => "%" . $_GET["term"] . "%",
						"polje" => $_GET["polje"]));
						$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
	$t=new stdClass();
	$t->sifra=0;
	$t->nazivkulture="Nisu prikazani svi rezultati, filtrirajte dodatnim unosom";
	$t->opis="";
	$t->marka="";
	$rezultati[]=$t;
	echo json_encode($rezultati);