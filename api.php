<?php
include_once("init.php");
session_start();

if(isset($_GET['action'])){
	if($_GET['action']=="latest"){
		$episodes = $db->new_episodes();

		$formatted = array();

		foreach($episodes as $e){
			$ep = $db->get_episode_info($e['episode_id']);
			$title = $ep['show_name']." - ".$ep['season']."x".$ep['episode']." - ".$ep['name'];
			$video = $ep['location'];
			$file_info = pathinfo($video);
			$thumb = $file_info['dirname'].'/'.$file_info['filename']."-thumb.jpg";
			$thumb_url = (file_exists($thumb)) ? $core->serve_file($thumb) : $config['default_thumb'];
			array_push($formatted, array(
				"title" => $title,
				"description" => $ep['description'],
				"sources" => array(
					$core->serve_file($video)
				),
				"subtitle" => "powered by cloakstream",
				"thumb" => $thumb_url
			));
		}

		echo json_encode($formatted);
	}
}
