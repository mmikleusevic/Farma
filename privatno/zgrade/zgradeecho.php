<div class="column medium-4 end">

	<ul class="pricing-table no-bullet text-center">
		<li class="title" title="velicina naziv">
			<?php if($red->nazivzgrade==null){
				echo "&nbsp;";
			}else{
				echo $red->nazivzgrade;
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
		<li class="description" title="opis zgrade">
			<?php if($red->opis==null){
				echo "&nbsp;";
			}else{
				echo $red->opis;
			}
			 ?>
		</li>
		<li title="velicina zgrade">
			<?php if($red->velicina==null){
				echo "&nbsp;";
			}else{
				echo $red->velicina;
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