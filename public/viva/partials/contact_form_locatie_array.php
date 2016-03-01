<?php
	$locaties_array = findLocaties($current['cookiecode']);
	if($locaties_array != null)
	{
?>
	<span>Over welke locatie wilt u meer weten?</span>
	<div class="vim-check-container">
<?php
		foreach($locaties_array as $locatie)
		{
?>				
			<div class="vim-check">
				<input type="checkbox" name="checkbox" value="<?=$locatie?>" id="bhtw">
				<label for="bhtw"><?=$locatie?></label>
			</div>
<?php					
		}
?>
	</div>					
<?php				
	}
?>