<?php

include_once("init.php");
session_start();

if(isset($_GET['view'])){
	if($_GET['view']=="latest_episodes"){
		$episodes = $db->new_episodes();
		include('views/latest.php');
		/*foreach($latest as $l){
			echo $l['show_name'].": ".$core->ordinal_to_datetime($l['airdate'])->format('l, M jS')."<br />";	
		}
		echo "<pre>";
		print_r($episodes);
		echo "</pre>";*/
	} else if ($_GET['view']=="tv"){
	
		$shows = $db->get_shows();
		$title = "Show List";
		//print_r($shows);
		include("views/tv.php");
	}
} else if(isset($_GET['v'])){ 
	if(is_numeric($_GET['v'])){
		
		$id = $_GET['v'];
		$code = sha1($id.time());
		$_SESSION['coded'] = array(
			'v' => $id,
			'code' => $code
		);
		
		$ep = $db->get_episode_info($id);
		
		$secret = $config['AuthTokenSecret'];             // Same as AuthTokenSecret
		$protectedPath = $config['AuthTokenPrefix'];        // Same as AuthTokenPrefix
		$ipLimitation = false;                 // Same as AuthTokenLimitByIp
		$hexTime = dechex(time());             // Time in Hexadecimal      
		$fileName = $ep['location'];
		
		// Let's generate the token depending if we set AuthTokenLimitByIp
		if ($ipLimitation) {
		  $token = md5($secret . $fileName . $hexTime . $_SERVER['REMOTE_ADDR']);
		}
		else {
		  $token = md5($secret . $fileName. $hexTime);
		}
		
		// We build the url
		$url = $protectedPath . $token. "/" . $hexTime . $fileName;
		//echo $url;
		
		$nav = $db->get_episode_nav($ep['episode_id']);
		extract($nav);
		
		$title = $ep['show_name']." - ".$ep['season']."x".$ep['episode'];
		
		include("views/episode.php");
	}
} else if (isset($_GET['t'])){
	if(is_numeric($_GET['t'])){
		$show = $db->get_show_info($_GET['t']);
		$episodes = $db->get_episodes($_GET['t']);
		$title = $show['show_name'];
		
		include("views/show.php");
	}
} else {
	header("Location: ".$_SERVER['PHP_SELF']."?view=tv");
} 
?>