<div class="column medium-4 end">

	<ul class="pricing-table no-bullet text-center">
		<li class="title" title="Naziv polja">
			<?php if($red->nazivpolja==null){
				echo "&nbsp;";
			}else{
				echo $red->nazivpolja;
			}
			 ?>
		</li>
		<li title="Ime i prezime vlasnika">
			<?php if($red->ime . " " . $red->prezime==null){
				echo "&nbsp;";
			}else{
				echo $red->ime . " " . $red->prezime;
			}
			 ?>
		</li>
		<li title="kultura i marka kulture na polju">
			<?php if($red->kultura==null){
				echo "&nbsp;";
			}else{
				echo $red->kultura;
			} ?>
		</li>
		<li title="Velicina polja">
			<?php if($red->velicinapolja==null){
				echo "&nbsp;";
			}else{
				echo $red->velicinapolja;
			}
			 ?>
		</li>
		<li title="Koordinate polja">
			<?php if($red->koordinate==null){
				echo "&nbsp;";
			}else{
				echo $red->koordinate;
			}
			 ?>
		</li>
		<li title="Godina kulture">
			<?php 			
			$d = strtotime($red->godinakulture);
			if($d!=""){
			echo date($formatDatumaPHP, $d ); 
			}		
			else if($d==""){
				echo date($red->godinakulture);
			}
			else{
				echo "&nbsp;";
			}	
			?>
		</li>
		<li>
			<a class="promjeni" href="promjena.php?sifra=<?php echo $red->sifra ?>">
				promjeni
				</a> <a class="obrisi" href="obrisi.php?sifra=<?php echo $red->sifra ?>">
				obriši
				</a>
		</li>
	</ul>

</div>