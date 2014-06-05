<?php

include_once("init.php");
session_start();

if(isset($_GET['view'])){
	if($_GET['view']=="latest_episodes"){
		$episodes = $db->new_episodes();
		$title = "Latest Episodes";
		include('views/latest.php');
		/*foreach($latest as $l){
			echo $l['show_name'].": ".$core->ordinal_to_datetime($l['airdate'])->format('l, M jS')."<br />";	
		}
		echo "<pre>";
		print_r($episodes);
		echo "</pre>";*/
	} else if ($_GET['view']=="upcoming_episodes"){
	
		$eps = $db->upcoming_episodes();
		$episodes = array();
		foreach($eps as $row){
			if(!isset($episodes[$row['airdate']]))
				$episodes[$row['airdate']] = array();
			array_push($episodes[$row['airdate']] ,$row);	
		}
		$title = "Upcoming Episodes";
#		print_r($episodes);
		include("views/upcoming.php");

	} else if ($_GET['view']=="tv"){
	
		$shows = $db->get_shows();
		$title = "Show List";
		//print_r($shows);
		include("views/tv.php");
	}
} else if(isset($_GET['v'])){ 
	if(is_numeric($_GET['v']) || $_GET['v']=="random"){

		$id = $_GET['v'];
		if($id == "random"){
			$id = $db->get_random_eid();
			$prev = NULL;
			$next="random";
		} else {
			$nav = $db->get_episode_nav($id);
			extract($nav);
		}

		$code = sha1($id.time());
		$_SESSION['coded'] = array(
			'v' => $id,
			'code' => $code
		);
		
		$ep = $db->get_episode_info($id);

		$nav = $db->get_episode_nav($ep['episode_id']);
		extract($nav);

		$title = $ep['show_name']." - ".$ep['season']."x".$ep['episode'];
		
		// URL GENERATION
		$fileName = $ep['location'];
		$url = $core->serve_file($fileName);

		//build thumburl
		$file_info = pathinfo($fileName);
		$thumbFile = $file_info['dirname'].'/'.$file_info['filename']."-thumb.jpg";
		$thumb = $file_info['dirname'].'/'.$file_info['filename']."-thumb.jpg";
		$thumb_url = (file_exists($thumb)) ? $core->serve_file($thumb) : $config['default_thumb'];
		
		include("views/episode.php");
	}
} else if (isset($_GET['t'])){
	if(is_numeric($_GET['t'])){
		$show = $db->get_show_info($_GET['t']);
		$episodes = $db->get_episodes($_GET['t']);
		$title = $show['show_name'];
		
		include("views/show.php");
	}
} else if(isset($_GET['version'])){
	echo "<pre>";
	print_r($core->check_version());
	echo "</pre>";
} else {
	header("Location: ".$_SERVER['PHP_SELF']."?view=tv");
} 
?>
