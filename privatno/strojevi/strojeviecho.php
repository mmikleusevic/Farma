<div class="column medium-4 end">

	<ul class="pricing-table no-bullet text-center">
		<li class="title" title="naziv stroja">
			<?php if($red->nazivstroja==null){
				echo "&nbsp;";
			}else{
				echo $red->nazivstroja;
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
		<li class="description" title="opis stroja">
			<?php if($red->opis==null){
				echo "&nbsp;";
			}else{
				echo $red->opis;
			}
			 ?>
		</li>
		<li title="datum kupovine">
			<?php
			$d = strtotime($red->datumkupovine);
			if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}		
			else if($d==""){
				echo date($red->datumkupovine);
			}
			else{
				echo "&nbsp;";
			}
			 ?>
		</li>
		<li title="datum servisa">
			<?php
			$d = strtotime($red->datumservisa);
			if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}		
			else if($d==""){
				echo date($red->datumservisa);
			}
			else{
				echo "&nbsp;";
			}
			 ?>
		</li>
		<li title="vrijednost stroja">
			<?php if($red->vrijednost==null){
				echo "&nbsp;";
			}else{
				echo $red->vrijednost;
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