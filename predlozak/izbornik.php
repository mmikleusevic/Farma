<div data-sticky-container>
  <div class="sticky" id="example" data-sticky data-margin-top="0" style="width:100%;" data-margin-bottom="0" data-top="topAnchorExample" data-btm-anchor="bottomOfContentId:bottom">
    <nav data-magellan style="vertical-align: middle;">
      <ul class="horizontal menu expanded">
      <li><a href="<?php echo $putanjaAPP ?>index.php">Početna</a></li>
      <li><a href="<?php echo $putanjaAPP ?>kontakt.php">Kontakt</a></li>
      
      <?php if(!isset($_SESSION[$sid . "autoriziran"])): ?>
      <li><a href="<?php echo $putanjaAPP ?>registracija.php">Registracija</a></li>
      <?php endif; ?>
      
      <?php if(isset($_SESSION[$sid . "autoriziran"])): ?>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/index.php">Nadzorna ploča</a></li>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/zgrade/index.php">Zgrade</a></li>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/strojevi/index.php">Strojevi</a></li>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/zivotinje/index.php">Životinje</a></li>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/polje/index.php">Polje</a></li>
      	<?php endif; ?>
      	
      	<?php  if(isset($_SESSION[$sid . "autoriziran"]) && $_SESSION[$sid . "autoriziran"]->uloga==="admin"): ?>
      	<li><a class="era" href="<?php echo $putanjaAPP ?>privatno/era.php">ERA</a></li>
      	<li><a href="<?php echo $putanjaAPP ?>privatno/vlasnik/index.php">Vlasnik</a></li>
		<li><a href="<?php echo $putanjaAPP ?>privatno/operateri/index.php">Operateri </a></li>
		<?php endif; ?>
		
		<?php if(isset($_SESSION[$sid . "autoriziran"]) && $_SESSION[$sid . "autoriziran"]->uloga==="korisnik"): ?>
		<li><a href="<?php echo $putanjaAPP ?>privatno/vlasnik/profil.php" value=<?php echo $_SESSION[$sid . "autoriziran"]->sifra ?>>Profil </a></li>
		<?php endif; ?>
      <li>
      	<?php if(isset($_SESSION[$sid . "autoriziran"])): ?>
      		<a   href="<?php echo $putanjaAPP ?>odjava.php">Odjavi <br /><?php echo $_SESSION[$sid . "autoriziran"]->ime . " ". $_SESSION[$sid . "autoriziran"]->prezime ?></a>
      	<?php else: ?>
      		<a  data-open="exampleModal1" href="#">Prijava</a>
      	<?php endif; ?>
      	</li>
      </ul>
    </nav>
  </div>
</div>
<div id="destroy"></div>