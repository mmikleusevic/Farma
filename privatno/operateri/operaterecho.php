<div class="column medium-4 end">
	<ul class="pricing-table no-bullet text-center">
		<li class="slikali" title="slika">
			<img class="slika" id="o_<?php echo $red->oibgospodarstva ?>" src="<?php 
				
				$putanjaslika = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . $putanjaAPP."img/vlasnik/". $red->oibgospodarstva . ".jpg";
				//echo $putanjaslika;
				if(file_exists($putanjaslika)){
					echo $putanjaAPP ."img/vlasnik/" . $red->oibgospodarstva . ".jpg";
				}else{
					echo $putanjaAPP ."img/vlasnik/nepoznato.jpg";
				}
				
				
				
				?>" alt="" />
		</li>
		<li class="title" title="uloga operatera">
			<?php if($red->uloga==null){
				echo "&nbsp;";
			}else{
				echo $red->uloga;
			}
			 ?>
		</li>
		<li class="title" title="ime i prezime vlasnika">
			<?php if($red->ime  . " " . $red->prezime==null){
				echo "&nbsp;";
			}else{
				echo $red->ime  . " " . $red->prezime;
			}
			 ?>
		</li>
		<li class="description">
		<?php if($red->uloga==='korisnik'){ ?>
				<a class="obrisii" href="obrisi.php?sifra=<?php echo $red->sifra ?>">
				obriši
				</a>
				<?php } ?>
		</li>
	</ul>
</div>