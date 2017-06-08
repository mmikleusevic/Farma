<div class="reveal" id="exampleModal1" data-reveal>
	<form method="post" action="autoriziraj.php">
    	<label>E-mail korisnika
    		<input type="text" required="required" name="korisnik"
    		placeholder="pero" value="<?php 
    		if (isset($_GET["korisnik"])){
    			echo $_GET["korisnik"];
    		}else{
    			if($dev){
    				echo "nekiemail@nesto1.com";
    			}
    		}
    		
    		?>"/>
    		</label>
    		
    	<label>Lozinka
    		<input type="password" required="required" name="lozinka" <?php 
    		if($dev){
    				echo '1';
    			}
    		 ?> />
    		</label>
    		
    		<input class="expanded button" type="submit" name="autorizacija" value="Prijava" />
    		
    		
    </form>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>