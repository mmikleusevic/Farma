<?php

for($i=1;$i<66;$i++){
	$oibgospodarstva = "00000000000" . $i;
	$oibgospodarstva=substr($oibgospodarstva, count($oibgospodarstva)-11);
	echo "insert into vlasnik (ime,prezime,nazivgospodarstva,oibgospodarstva,brojzgrada,email,lozinka)
	values ('Ime" . $i . "','Prezime" . $i . "','NazivGospodarstva" . $i . "','" . $oibgospodarstva . "',15,'nekiemail@nesto" . $i . ".com',md5('1'));<br />";
}


for($i=1;$i<300;$i++){
	echo "insert into zgrada (nazivzgrade,opis,velicina,vlasnik)
	values ('Lorem ipsum','Lorem ipsum',500.50," . rand(1,65) . ");<br />";
}


for($i=1;$i<500;$i++){
	echo "insert into zivotinje (vrsta,imezivotinje,brojmarkice,datumrodenja,kilaza,cijena,zgrada)
	values ('Krava','Jagoda" . $i . "','ABCD12','19-2-2015',550.50,7000.50," . rand(1,299) . ");<br />";
}

for($i=1;$i<500;$i++){
	echo "insert into stroj (nazivstroja,opis,datumkupovine,datumservisa,vrijednost,zgrada)
	values ('Traktor','Služi za rad u polju','19-2-2015','19-2-2015',15000.00," . rand(1,299) . ");<br />";
}

for($i=1;$i<500;$i++){
	echo "insert into polje (nazivpolja,velicinapolja,koordinate,godinakulture,vlasnik)
	values ('Lorem ipsum" . $i ."',252.4,'lorem','2016'," . rand(1,65) . ");<br />";
}

for($i=1;$i<500;$i++){
	echo "insert into kultura (nazivkulture,opis,marka)
	values ('kukuruz','lorem ipsum','lorem');<br />";
}
for($i=1;$i<500;$i++){
	echo "insert into kulturaugodini (kultura,polje)
	values (" . rand(1,499) . "," . rand(1,499) . ");<br />";
}
