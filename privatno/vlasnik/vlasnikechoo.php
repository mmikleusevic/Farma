<div class="column small-3 end ">
	<ul class="pricing-table no-bullet text-center ">
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
		<li class="title" title="ime i prezime vlasnika">
			<?php if($red->ime  . " " . $red->prezime==null){
				echo "&nbsp;";
			}else{
				echo $red->ime  . " " . $red->prezime;
			}
			 ?>
		</li>
		<li title="naziv gospodarstva">
			<?php if($red->nazivgospodarstva==null){
				echo "&nbsp;";
			}else{
				echo $red->nazivgospodarstva;
			}
			 ?>
		</li>
		<?php if(isset($_SESSION[$sid  .  "autoriziran"])):?>
		<li title="oib gospodarstva">
			<?php if($red->oibgospodarstva==null){
				echo "&nbsp;";
			}else{
				echo $red->oibgospodarstva;
			}
			 ?>
		</li>
		<?php endif; ?>
		<li title="broj zgrada">
			<?php if($red->brojzgrada==null){
				echo "&nbsp;";
			}else{
				echo $red->brojzgrada;
			}
			 ?>
		</li>
		<li title="email vlasnika">
			<?php if($red->email==null){
				echo "&nbsp;";
			}else{
				echo $red->email;
			}
			 ?>
		</li>
		
		<li class="description">
			<a class="promjeni" href="promjenip.php?sifra=<?php echo $_SESSION[$sid . "autoriziran"]->sifra ?>">
				promjeni
				</a>
				</a> <a href="#" class="postaviSlikuu" id="o_<?php echo $red->oibgospodarstva ?>">
				Slika
				</a>
		</li>
	</ul>
</div>