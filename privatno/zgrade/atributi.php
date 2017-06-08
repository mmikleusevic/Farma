<?php
				 
				inputPolje("text","nazivzgrade",$poruke);
				inputPolje("text","opis",$poruke);
				inputPolje("number","velicina",$poruke);
				?>
				<label> Vlasnik
<select id="vlasnik" name="vlasnik" aria-describedby="vlasnikPomoc">
	<option value="0">Odaberite Vlasnika</option>
	<?php 
	$izraz=$veza->prepare("select * from vlasnik order by ime");
		$izraz->execute();
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		foreach ($rezultati as $red):
		?>
		<option <?php 
		if(isset($_POST["vlasnik"]) && $_POST["vlasnik"]==$red->sifra){
			echo " selected=\"selected\" ";
		} 
		?>  value="<?php echo $red->sifra ?>"><?php echo $red->ime . " " . $red->prezime?></option>
		<?php
		endforeach;
	
	?>
</select>
</label>
<?php if (isset($poruke["vlasnik"])): ?>
				<p class="help-text" id="vlasnikPomoc"><?php echo $poruke["vlasnik"]; ?></p>
				<?php endif;  ?>