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
	
	function ordinal_to_datetime($ordinal){
		$begin = new DateTime('0001-01-00');
		$date = new DateInterval("P".$ordinal."D");
		$begin->add($date);
		return $begin;
	}

	function datetime_to_ordinal($datetime){
		$begin = new DateTime('0001-01-00');
		$interval = $datetime->diff($begin);
		return $interval->days;		
	}
	
	function check_version(){
		$current = NULL;
		exec('git log -n1 --pretty="%H"',$current);	
		$current = $current[0];
		$commits = file_get_contents("https://api.github.com/repos/uberdiesel/cloakstream/commits");
		$commits = json_decode($commits);
		//print_r($commits);
		$count = 0;
		foreach($commits as $commit){
			if($commit->sha == $current)
				break;
			$count++;	
		}
		
		echo $count;
		
		return $current[0];
	}
	
	function update(){
		$del_install = false;
		if(!file_exists("install.php") && file_exists("config.php"))
			$del_install = true;
		exec("git pull origin master");	
		if($del_install)
			unlink("install.php");
	}
}
