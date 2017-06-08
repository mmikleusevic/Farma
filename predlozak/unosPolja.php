<?php

function inputPolje($tip,$naziv,$poruke){
	?>
	<label><?php echo strtoupper(substr($naziv,0,1)) . substr($naziv, 1); ?>
				  <input 
				  <?php 
				  if(isset($_POST[$naziv])):
				  	?>
				  	value="<?php echo $_POST[$naziv] ?>"
				  	<?php
				  endif;
				   ?>
				   type="<?php echo $tip ?>" id="<?php echo $naziv ?>" name="<?php echo $naziv ?>" aria-describedby="<?php echo $naziv ?>Pomoc">
				</label>
				<?php if (isset($poruke[$naziv])): ?>
				<p class="help-text" id="<?php echo $naziv ?>Pomoc"><?php echo $poruke[$naziv]; ?></p>
				<?php endif; 
}
