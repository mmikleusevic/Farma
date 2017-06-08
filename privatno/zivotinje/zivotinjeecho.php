<div class="column medium-4 end">

	<ul class="pricing-table no-bullet text-center">
		<li class="title" title="ime zivotinje">
			<?php if($red->imezivotinje==null){
				echo "&nbsp;";
			}else{
				echo $red->imezivotinje;
			}
			 ?>
		</li>
		<li title="Ime i prezime vlasnika">
			<?php if($red->prezime . " " . $red->ime ==null){
				echo "&nbsp;";
			}else{
				echo $red->prezime . " " . $red->ime ;
			}
			 ?>
		</li>
		<li class="description" title="vrsta">
			<?php if($red->vrsta==null){
				echo "&nbsp;";
			}else{
				echo $red->vrsta;
			}
			 ?>
		</li>
		<li title="broj markice zivotinje">
			<?php if($red->brojmarkice==null){
				echo "&nbsp;";
			}else{
				echo $red->brojmarkice;
			}
			 ?>
		</li>
		<li title="datum rodenja zivotinje">
			<?php
			$d = strtotime($red->datumrodenja);
			if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}		
			else if($d==""){
				echo date($red->datumrodenja);
			}
			else{
				echo "&nbsp;";
			}
			 ?>
		</li>
		<li title="kilaza zivotinje">
			<?php if($red->kilaza==null){
				echo "&nbsp;";
			}else{
				echo $red->kilaza;
			}
			 ?>
		</li>
		<li title="cijena zivotinje">
			<?php if($red->cijena==null){
				echo "&nbsp;";
			}else{
				echo $red->cijena;
			}
			 ?>
		</li>
		<li title="naziv zgrade">
			<?php if($red->nazivzgrade==null){
				echo "&nbsp;";
			}else{
				echo $red->nazivzgrade;
			}
			 ?>
		</li>
		<li class="description">
			<a class="promjeni" href="promjeni.php?sifra=<?php echo $red->sifra ?>">
				promjeni
				</a> <a class="obrisi" href="obrisi.php?sifra=<?php echo $red->sifra ?>">
				obriši
				</a>
		</li>
	</ul>

</div>