<?php
	$pages_visited = [];	// Array for getting and displaying videos that have been watched. 
	$current_visited = false;

	function pushcookie($cookie_name, $cookie_value)
	{
		global $pages_visited;
		//If cookie doens't exist, create it and enter cookie_value
		//If it does exist, set cookie_value if not yet set. 
		if(!isset($_COOKIE[$cookie_name]))
		{
			$new_value = [$cookie_value => true];
			setcookie($cookie_name, serialize($new_value), 0, "/" );
		}
		else
		{
			$this_cookie = unserialize($_COOKIE[$cookie_name]);
			if(!isset($this_cookie[$cookie_value]))
			{
				$this_cookie[$cookie_value] = true;
				setcookie($cookie_name, serialize($this_cookie), 0, "/" );
			}
		}
	}

	function pullcookie($cookie_name, $current_name = null)
	{
		global $pages_visited;
		//Create cookie if it doesn't exist
		//Pull all the values from the cookie into $pages_visited
		if(!isset($_COOKIE[$cookie_name]))
		{
			setcookie($cookie_name, serialize($pages_visited), 0, "/" );
		}
		else
		{
			$pages_visited = unserialize($_COOKIE[$cookie_name]);	
			if($current_name != null)
			{
				$pages_visited[$current_name] = true;
			}
			
		}
	}

	function dropcookie($cookie_name, $cookie_value)
	{
		$this_cookie = [];
		$new_cookie = [];
		if(isset($_COOKIE[$cookie_name]))
		{
			$this_cookie = unserialize($_COOKIE[$cookie_name]);
			foreach ($this_cookie as $key => $value) {
				if($key != $cookie_value)
				{
					$new_cookie[$key] = true;
				}
			}
			setcookie($cookie_name, serialize($new_cookie), 0, "/" );
		}
	}

	function currentvisited($cookie_name, $current_name)
	{
		global $current_visited;
		//check to see if the current page has been visited already
		if(isset($_COOKIE[$cookie_name]))
		{
			$this_cookie = unserialize($_COOKIE[$cookie_name]);
			if(isset($this_cookie[$current_name]))
			{
				$current_visited = true;
			}
		}
	}

	$breadcrumb = '<span>' . $current['title'] . '</span>';
	$breadCrumber = $current;

	while($breadCrumber['parent'] !== 'top')
	{
		$nextCrumber = $breadCrumber['parent'];
		$nextCrumber = $$nextCrumber;
		$breadcrumb = ' <a href="' . $nextCrumber['adress'] . '">' . $nextCrumber['title'] . '</a> / ' . $breadcrumb;
		$breadCrumber = $breadCrumber['parent'];
		$breadCrumber = $$breadCrumber;
	}

	function nextlocation ($parent, $current)
	{
		if($parent['children'] < 2 || $current['type'] != 'woning' )
		{
			return null;
		}
		else
		{
			reset($parent['children']);
			while (current($parent['children']) != substr($current['adress'], 0, -4)) {
				next($parent['children']);
			}
			if(next($parent['children']) == false)
			{
				reset($parent['children']);
			}
			return current($parent['children']);
		}
	}

	function findLocaties ($code)
	{
		global $beverwijk_locaties;
		global $caslimak_locaties;
		global $heemskerk_locaties;
		global $heilo_locaties;
		global $uitgeest_locaties;
		global $heerhugowaard_locaties;

		if(fnmatch("B??", $code))
		{
			return $beverwijk_locaties;
		}
		elseif(fnmatch("C??", $code))
		{
			return $caslimak_locaties;
		}
		elseif(fnmatch("H??", $code))
		{
			return $heemskerk_locaties;
		}
		elseif(fnmatch("HEI??", $code))
		{
			return $heilo_locaties;
		}
		elseif(fnmatch("U??", $code))
		{
			return $uitgeest_locaties;
		}
		elseif(fnmatch("HEE??", $code))
		{
			return $heerhugowaard_locaties;
		}

	}

	if( !function_exists('mobile_user_agent_switch') ){
		function mobile_user_agent_switch(){
			$device = '';
			
			if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
				$device = "ipad";
			} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
				$device = "iphone";
			} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
				$device = "blackberry";
			} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
				$device = "android";
			}
			
			if( $device ) {
				return $device; 
			} return false; {
				return false;
			}
		}
	}

	
