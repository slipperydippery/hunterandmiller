<h2 class="vim-infoblock-head">Neem contact op voor meer informatie</h2>
<form method="post" action="">

<?php 
if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) {?>
	<p class="warning">Sorry, uw mail kon niet verstuurd worden. Probeert u het later nogmaals. </p>
<?php } ?>

	<input type="text" name="naam" placeholder="Uw naam" 
	<?php
		if ($missing || $errors)
		{
			echo 'value="' . htmlentities($naam) . '"';
		}
	?>
	>
<?php if ($missing && in_array('naam', $missing)) { ?>
	<span class="warning">Vul aub uw naam in </span>
<?php } ?>


	<input type="text" name="email" placeholder="Uw email" 
	<?php
		if ($missing || $errors)
		{
			echo 'value="' . htmlentities($email) . '"';
		}
	?>
	>
<?php if ($missing && in_array('email', $missing)) { ?>
	<span class="warning">Vul aub uw email in </span>
<?php } elseif (isset($errors['email'])) { ?>
	<span class="warning">Ongeldig emailadres</span>
<?php } ?>

	<input type="text" name="telefoon" placeholder="Uw telefoonnummer" 
	<?php
		if ($missing || $errors)
		{
			echo 'value="' . htmlentities($telefoon) . '"';
		}
	?>
	>

	<textarea name="bericht" rows="10" cols="75" placeholder="Uw bericht" ><?php
		if ($missing || $errors)
		{
			echo htmlentities($bericht);
		}
	?></textarea>


	<input name="submit" type="submit" value="Verstuur">
</form>
 
 
<div class="vim-contact-tel">
	<p>Interesse? Neem contact op via <span>088 &#8211; 995 86 40</span> met de afdeling Zorgbemiddeling.</p>
</div>