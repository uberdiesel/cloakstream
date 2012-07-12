<?php

include_once("init.php");
session_start();
if(!isset($_SESSION['username'])){
    print_r("testing");
	header("Location: login.php");
   
}

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
	} else if ($_GET['view']=="movies"){
	
		$movies = find_movies($movie_dir);
		$title = "Movie List";
		//print_r($movies);
		include("views/movies.php");
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
	    //print_r($fileName);	
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
} else if (isset($_GET['m'])){
        $id = $_GET['m'];
		$code = sha1($id.time());
		$_SESSION['coded'] = array(
			'm' => $id,
			'code' => $code
		);
        $path= $movie_dir . $id	;
		$ep = find_movies($path);
		
		$secret = $config['AuthTokenSecret'];             // Same as AuthTokenSecret
		$protectedPath = $config['AuthTokenPrefix'];        // Same as AuthTokenPrefix
		$ipLimitation = false;                 // Same as AuthTokenLimitByIp
		$hexTime = dechex(time());             // Time in Hexadecimal      
		$fileName = $path . "/" .$ep[0];
    
        // Let's generate the token depending if we set AuthTokenLimitByIp
		if ($ipLimitation) {
		  $token = md5($secret . $fileName . $hexTime . $_SERVER['REMOTE_ADDR']);
		}
		else {
		  $token = md5($secret . $fileName. $hexTime);
		}
		
		// We build the url
		$url = $protectedPath . $token. "/" . $hexTime . $fileName;
		
		
		$title = $id;
		
		include("views/movie.php");


} else {
	header("Location: ".$_SERVER['PHP_SELF']."?view=tv");
} 


function find_movies($dir_name)
{
    chdir($dir_name);
    $movie_dir =opendir(".");
    $filenames = array(); 
    while (($file = readdir($movie_dir))!== false )
    {
        if ($file[0]=='.'){
            continue;
        } 
        
        if (is_dir($file))
        {
            if (find_mp4($file)){
                array_push( $filenames,$file);
            }
        }

        if (strstr($file,".mp4") )
        {
            array_push($filenames,$file);
        }
        chdir($dir_name);
    }

    return $filenames;
}

function find_mp4($dir_name)
{
    chdir($dir_name);
    $movie_dir =opendir(".");
    $found=0;
    while (($file = readdir($movie_dir))!== false )
    {
        if ($file[0]=='.'){
            continue;
        } 
        
        if (is_dir($file))
        {
           $found=find_mp4($file); 
        }

        if (strstr($file,".mp4") )
        {
           return 1;
        }

    }
    return $found;
}
?>
