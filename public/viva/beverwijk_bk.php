<?php
	require './code/woningenarray.php';
	require './code/cookiecode.php';

	$current = $woningen['opties']['beverwijk'];
	$parent = $woningen;
	$breadcrumb = '<a href="' . $woningen['adress'] . '">' . $woningen['title'] . '</a>' ;
    $breadcrumb .= ' /  <span>' . $current['title'] . '</span>' ;

	$this_cookie = $current['cookiecode'];
	$parent_cookie = $parent['cookiecode'];

	pushcookie($parent_cookie, $this_cookie);
	pullcookie($this_cookie);
	currentvisited($parent_cookie, $this_cookie);

	$vimeo_code = $current['video'];

	require './partials/content.php';
?>