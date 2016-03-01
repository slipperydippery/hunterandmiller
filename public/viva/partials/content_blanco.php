<?php
	include './partials/header.php';
	//$checkmark = "<img src='img/checkmark.png' class='checkmark' />";
	$checkmark = ''; 

	require_once './code/pages.php';
	$current = $$current;
	$parent = $$current['parent'];	

	require './code/cookiecode.php';
	pushcookie($parent['cookiecode'], $current['cookiecode']);
	pullcookie($current['cookiecode']);
	currentvisited($parent['cookiecode'], $current['cookiecode']);
	if(isset($_GET['replay']))
	{
		$current_visited = false;
	}

	$vimeo_code = $current['vimeo'];

?>
<script>
    var current_visited = <?php echo json_encode($current_visited); ?>; 
</script>

<div class="vimapp-wrap">
	<div class="vim-breadcrumb">
		<?= $breadcrumb ?>
	</div>
	<div class="h1custom">
		<h1><?= $current['title'] ?></h1>
	</div>
	<div class="vim-wrap">
		<div class="vim-noblack">
			<?php 
				$thumbnail = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_code.php"));
			?>
			<img src="<?= $thumbnail[0]['thumbnail_large'] ?>" />
		</div>
		<div class="vim-overlay" <?php if($current_visited){ echo "style='left:0px; opacity: 1;'";} ?>>
			<div class="vim-head">
				<h2><?= $type[$current['type']]['question'] ?> </h2>
			</div>
			<div class="vim-body">

				<div class="vim-playclick playclick"></div>
<?php 
				$optie_counter = 1;
				if($current['children'] !== null || $current['type'] == 'woning'){
					$options = $current['type'] == 'woning' ? $parent['children'] : $current['children'];
					foreach ($options as $child) {
						$child = $$child;
						$childtitle = isset($child['link_title']) ? $child['link_title'] : $child['title'];
						$imgid = $child['vimeo'];
						$thumbnail = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
?>
						<div class="vim-element__wrap">
							<div class="vim-element">
<?php
								if($child['cookiecode'] == $current['cookiecode'])
								{
?>
						    	<a href="<?= $child['adress'] ?>?replay=1" class="choice"> 
						    		<img src="<?= $thumbnail[0]['thumbnail_medium'] ?>" class="vimeo-thumb" />
						    	</a>

<?php									
								}
								else
								{
?>
						    	<a href="<?= $child['adress'] ?>" class="choice "> 
						    		<img src="<?= $thumbnail[0]['thumbnail_medium'] ?>" class="vimeo-thumb" />
						    	</a>
<?php
						    	}
							    	$title__long = isset($child['title_too_long']) ? 'vim-element__txt__long' : '';
						    	?>
						    	<a href="<?= $child['adress'] ?>" class="vim-element__txt <?= $title__long ?>"> 
						    		<?= $childtitle ?>
						    	</a>
<?php 
					    		if(isset($pages_visited[$child['cookiecode']])) {
					    			echo $checkmark;
					    		}
?>							    	
					    	</div>
					    </div>
<?php	
							$numbThumbnails = ($current['type'] == 'woning') ? count($parent['children']) : count($current['children']);
							if($numbThumbnails == 4 &&  $optie_counter == 2)
							{
								echo '<br/>';
							}
							if($numbThumbnails > 4 && $optie_counter == 3)
							{
								echo '<br/>';
							}
							$optie_counter++;
						}
					}
?>


			</div>  <!-- .vim-body -->

			<a href="#" class="vim-post-controls vim-post-controls--replay">
				<img src="img/replay.png" />
			</a>

		</div>  <!-- .vim-overlay -->
		<div class="vim-playpause">
			<img src="img/vimeo_play_blue.png" class="play playpause" />
			<img src="img/vimeo_pause_grey.png" class="pause playpause" />
		</div>		
<?php
		if($current['type'] != 'blanco_overzicht')
		{
?>
		<iframe class="vimeo" id="player1" src="https://player.vimeo.com/video/<?= $vimeo_code ?>?api=1&player_id=player1" width="630" height="354" frameborder="0" ></iframe>
<?php
		}
?>		

	</div>
    <div class="vim-shortcuts">
    	<?php 
			$backPage = $parent['type'] == 'woning_overzicht' ? $$parent['parent'] : $parent;
		?>
			<a href="<?= $backPage['adress'] ?>" class="vim-shortcut vim-shortcut--back" >
				<h3><?= ' '//$type[$backPage['type']]['back_to_here']?></h3>							
			</a>  

		<?php
			if(isset($next))
			{
				$next = $$next;
		?>	
				<a href="<?= $next['adress'] ?>" class="vim-shortcut vim-shortcut--next" >
					<h3><?= ' '//$next['title'] ?></h3>							
				</a>  
		<?php
			}
		?>
	</div>
	<div class="vim-infoblock-container vim-infoblock-container--left">
	    <div class="vim-controls vim-infoblock">
			<h2 class="vim-infoblock-head"><?= $type[$current['type']]['question'] ?></h2>
			<?php 
				if($current['children'] !== null || $current['type'] == 'woning')
				{
					$options = $current['type'] == 'woning' ? $parent['children'] : $current['children'];
					foreach ($options as $child) {
						$child = $$child;
						$childtitle = isset($child['link_title']) ? $child['link_title'] : $child['title'];
					?>
						<a href="<?= $child['adress'] ?>" class="vimeo-button"><span><?= $childtitle ?></span></a>

					<?php
					}
				}
			?>
	    </div>
	    <div class="vim-toeslag vim-infoblock">
		    	<p>
		    		De overheid bepaalt jaarlijks de spelregels rond de huurtoeslag. Wilt u weten of u in aanmerkizng komt voor een huurwoning met huurtoeslag neem dan contact met ons op via wonen@vivazorggroep.nl
		    	</p>
	    </div>

	</div>

	<div class="vim-infoblock-container vim-infoblock-container--right">
	    <div class="vim-contact vim-imfoblock">
	    	<h2 class="vim-infoblock-head">Neem contact op voor meer informatie</h2>
			<form>
				<input type="text" name="naam" placeholder="Uw naam">
				<input type="text" name="email" placeholder="Uw email">
				<input type="text" name="telefoon" placeholder="Uw telefoon nummer">

				<textarea name="bericht" rows="10" cols="75" placeholder="Uw bericht"></textarea>

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
				

	  			<input type="submit" value="Verstuur">
			</form>
		</div>
    </div>


    <br/><br/><br/><p>
    <a href="unsetcookies.php" style="display:inline-block; margin: 2rem 0 0 0 ;">reset demo</a></p>

</div>

<?php
	include './partials/footer.php';
?>	
