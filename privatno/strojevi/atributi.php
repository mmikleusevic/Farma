<?php
				 
				inputPolje("text","nazivstroja",$poruke);
				inputPolje("text","opis",$poruke);
				inputPolje("text","datumkupovine",$poruke);
				inputPolje("text","datumservisa",$poruke);
				inputPolje("number","vrijednost",$poruke);
				?>
				<label> Naziv zgrade
<select id="zgrada" name="zgrada" aria-describedby="zgradaPomoc">
	<option value="0">Odaberite zgradu</option>
	<?php 
	$izraz=$veza->prepare("select * from zgrada order by nazivzgrade");
		$izraz->execute();
		$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		foreach ($rezultati as $red):
		?>
		<option <?php 
		if(isset($_POST["zgrada"]) && $_POST["zgrada"]==$red->sifra){
			echo " selected=\"selected\" ";
		} 
		?>  value="<?php echo $red->sifra ?>"><?php echo $red->nazivzgrade?></option>
		<?php
		endforeach;
	
	?>
</select>
</label>
<?php if (isset($poruke["zgrada"])): ?>
				<p class="help-text" id="zgradaPomoc"><?php echo $poruke["zgrada"]; ?></p>
				<?php endif;  ?>
				 