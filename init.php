<?php

if(!file_exists("config.php")){
	die('no config file found. go <a href="install.php">here</a>');	
}

include_once("config.php");

/* SET DEPLOYMENT ENVIRONMENT */
	switch($config['env']){
		case "development":		
			ini_set('display_errors', 1); 
			error_reporting(E_ALL);	
			break;
		case "production":
			ini_set('display_errors', 0);
			error_reporting(0);
			break;
		
		default:
			
	}

	include_once("core.php");
	include_once("sickbeard_db.php");
	
	$core = new Core();
	$db = new SickBeard_DB($config['db_path']);
    $movie_dir = $config['movie_dir'];	

    $mysql_db = $config['mysql_db'];
    $mysql_user = $config['mysql_user'];
    $mysql_pass = $config['mysql_pass'];
