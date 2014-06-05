<?
class Core {
	function __construct(){
		Core::start_timer();	
	}

	function start_timer(){
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$GLOBALS['start_timer'] = $time;
	}
	
	function end_timer(){
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		return round(($finish - $GLOBALS['start_timer']), 4);
	}
	
	function server_load(){
		$load = sys_getloadavg();
		$one_min = $load[0];
		return (($one_min*100)/2)."%";
		/* AVERAGE OF ALL 3 LOAD NUMBERS
		$sum = array_sum($load);
		return (($sum/count($load))*100)."%";*/
	}
	
	static function  ordinal_to_datetime($ordinal){
		$begin = new DateTime('0001-01-00');
		$date = new DateInterval("P".$ordinal."D");
		$begin->add($date);
		return $begin;
	}

	static function  datetime_to_ordinal($datetime){
		$begin = new DateTime('0001-01-00');
		$interval = $datetime->diff($begin);
		return $interval->days;		
	}
	
	function check_version(){
		$current = NULL;
		exec('git log -n1 --pretty="%H"',$current);	
		$current = $current[0];
			$options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
			$context  = stream_context_create($options);
		$commits = file_get_contents("https://api.github.com/repos/uberdiesel/cloakstream/commits",false, $context);
		$commits = json_decode($commits);
		//print_r($commits);
		$count = 0;
		$master = $commits[0]->sha;
		foreach($commits as $commit){
			if($commit->sha == $current)
				break;
			$count++;	
		}

		//if not found, then you're ahead
		if($count == count($commits))
			$count = -1;
		
		//echo $count;
		
		return array(
			"current" => $current,
			"master" => $master,
			"distance" => $count
		);
	}
	
	function update(){
		$del_install = false;
		if(!file_exists("install.php") && file_exists("config.php"))
			$del_install = true;
		exec("git pull origin master");	
		if($del_install)
			unlink("install.php");
	}

	function serve_file($path){
		global $config;
		$secret = $config['AuthTokenSecret'];             // Same as AuthTokenSecret
		$protectedPath = $config['AuthTokenPrefix'];        // Same as AuthTokenPrefix
		$ipLimitation = false;                 // Same as AuthTokenLimitByIp
		$hexTime = dechex(time());             // Time in Hexadecimal      
		$fileName = $path;
		
		// Let's generate the token depending if we set AuthTokenLimitByIp
		if ($ipLimitation) {
		  $token = md5($secret . $fileName . $hexTime . $_SERVER['REMOTE_ADDR']);
		} else {
		  $token = md5($secret . $fileName. $hexTime);
		}
		
		// We build the url
		return $protectedPath . $token. "/" . $hexTime . $fileName;
	}
}
