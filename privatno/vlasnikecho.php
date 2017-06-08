<div class="column medium-4 end">
	<ul class="pricing-table no-bullet text-center">
		<li class="title">
			<?php echo $vlasnik->vlasnik?>
		</li>
		<li>
			<?php echo $vlasnik->nazivgospodarstva?>
		</li>
		<?php if(isset($_SESSION[$sid  .  "autoriziran"])):?>
		<li>
			<?php echo $vlasnik->oibgospodarstva?>
		</li>
				<?php endif; ?>
		<li>
			<?php echo $vlasnik->email?>
		</li>
	</ul>
</div>