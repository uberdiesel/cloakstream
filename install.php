<?php

/*ini_set('display_errors', 1); 
error_reporting(E_ALL);	*/
			
function good_file($file,$human_name,&$errors){
	if(!file_exists($file))
		array_push($errors,"ERROR: $human_name does not exist: <i>$sickbeard_db</i>");
	else if(!is_readable($file))
		array_push($errors,"ERROR: $human_name not readable: <i>$sickbeard_db</i>");
}



/* WEBSERVER TYPE DETECTION */
$webserver = strtolower($_SERVER['SERVER_SOFTWARE']);
if(strpos($webserver,"apache")!==FALSE)
	$webserver = "apache";
if(strpos($webserver,"lighttpd")!==FALSE)
	$webserver = "lighttpd";
if(strpos($webserver,"nginx")!==FALSE)
	$webserver = "nginx";
	
/* DIE IF NOT APACHE */
if($webserver != "apache")
	die("this installer only works with apache installations");
	
/* RETRIVE PREREQ VALUES */	
$modules = apache_get_modules();
$info['mod_h264_streaming'] = in_array("mod_h264_streaming",$modules);
$info['mod_auth_token'] = in_array("mod_auth_token",$modules);
$info['cwd_writable'] = is_writable(getcwd());


if(isset($_POST['install'])){
	foreach($info as $pre){
		if($pre == false)
		die('prerequities failed. go <a href="'.$_SERVER['PHP_SELF'].'">back</a>');
	}
	$modules = apache_get_modules();
	$info['mod_h264_streaming'] = in_array("mod_h264_streaming",$modules);
	$info['mod_auth_token'] = in_array("mod_auth_token",$modules);
	
	
	$errors=array();
	
	$sickbeard_dir = $_POST['sickbeard_dir'];
	good_file($sickbeard_dir,"Sickbeard Directory",$errors);
	
	$sickbeard_db = $sickbeard_dir."sickbeard.db";
	good_file($sickbeard_db,"Sickbeard Database",$errors);
	
	$sickbeard_images = $sickbeard_dir."cache/images";	
	good_file($sickbeard_images,"Sickbeard's images cache",$errors);
    
    $movie_dir = $_POST['movie_dir'];
	good_file($movie_dir,"Movie Directory",$errors);
	
    $mysql_db = $_POST['mysql_db'];
    $mysql_user = $_POST['mysql_user'];
    $mysql_pass = $_POST['mysql_pass'];
	
	
	if(count($errors)==0){
		if(file_exists("show_images")){
			unlink("show_images");
			echo "deleted old show_images<br>";
		}
		exec("ln -s ".$sickbeard_images." show_images");
		echo "install completed";	
		?><br>
This section should be addeed to your apache virtual host settings<br>
(ex: /etc/apache2/sites-enabled/000-default)<br>
<pre style="background-color:#CCCCCC">	ScriptAlias <?=$_POST['AuthTokenPrefix']?> /

# Token settings
&lt;Location <?=$_POST['AuthTokenPrefix']?>&gt;     
	AuthTokenSecret       &quot;<?=$_POST['AuthTokenSecret']?>&quot;      
	AuthTokenPrefix       <?=$_POST['AuthTokenPrefix']?>  
	# 3 hours time limit on files
	AuthTokenTimeout      10800
&lt;/Location&gt;
</pre>
<br/>
then restart apache
<pre>sudo service apache2 restart</pre>

<br/>
        
        <?
		$config_data = <<<CONF
<?php
/* GENERAL SITE SETTINGS */

	\$config['site_title'] = "{$_POST['site_title']}";
	\$config['contact'] = "{$_POST['contact']}";
	
/* MOD_AUTH_TOKEN SETTINGS 
 * settings here corrospond to your apache settings for mod_auth_token exactly
 */
	\$config['AuthTokenSecret'] = "{$_POST['AuthTokenSecret']}";
	\$config['AuthTokenPrefix'] = "{$_POST['AuthTokenPrefix']}"; //WITH BEGINING AND ENDING SLASHES
	
/*	DEPLOYMENT ENVIRONMENT
 *	accepted values:
 *
 *	development 
 *	production
 */
	\$config['env'] = "production";


/* SICKBEARD PATHs 
 * full path required WITH TRAILING SLASH
 */
 	\$config['sickbeard_dir'] = "$sickbeard_dir";
	\$config['db_path'] = \$config['sickbeard_dir']."sickbeard.db";

/* Movie PATH 
 * full path required WITH TRAILING SLASH
 */
 \$config['movie_dir'] = "$movie_dir";
    
/* mysql settings 
 * mysql must have a database with a table "users" with columns "username"
 * and "password". The password colum should be a varchar(32) using md5 hashing
 */
\$config['mysql_db'] = "$mysql_db";
\$config['mysql_user'] = "$mysql_user";
\$config['mysql_pass'] = "$mysql_pass";
CONF;
?>
		CONFIG FILE<br>
		<pre style="background-color:#CCCCCC"><?=str_replace("<","&lt;",$config_data)?>
		</pre>
		<?
		
		if(($fp = fopen("config.php","w")) != FALSE){
			fwrite($fp,$config_data);
			fclose($fp);
		} else {
			echo "<br>error writing config file(does one already exist?)";
		}
		
		?>
		<div style="width:100%; padding:20px; background-color:red; text-align:center;">
        NOW DELETE THIS FILE FOR SECURITY REASONS (install.php)
        </div>        
        
        <?
	
	} else {
		print_r($errors);
	}
	
} else {
	/*?>
    <pre><? print_r($info);?></pre>
	<?*/
	//$sickbeard_dir
	//exec();
	?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    	<? if(file_exists("config.php")){?>
        <div style="width:100%; padding:20px; background-color:red; text-align:center;">
        YOU ALREADY HAVE A CONFIG FILE (config.php) <br>
		HAVE YOU ALREADY CONFIGURED CLOAKSTREAM?<br>
        IF SO, DELETE THIS FILE FOR SECURITY REASONS (install.php)
        </div> 
        <? } ?>
        <h2>Prerequisites:</h2>
        is <a href="http://code.google.com/p/mod-auth-token/">mod_auth_token</a> installed?: <?=($info['mod_auth_token'] ? '<span style="color:green">yes' : '<span style="color:red">no')?></span><br>
        is <a href="http://h264.code-shop.com/trac/wiki/Mod-H264-Streaming-Apache-Version2">mod_h264_streaming</a> installed?: <?=($info['mod_h264_streaming'] ? '<span style="color:green">yes' : '<span style="color:red">no')?></span><br>
        is install directory writable by webserver (writable by user <?=exec("whoami")?>)?: <?=($info['cwd_writable'] ? '<span style="color:green">yes' : '<span style="color:red">no')?></span><br>
        Full path to SickBeard folder (with trailing slash):<br>
        <input type="text" name="sickbeard_dir" style="width:400px"/><br><br>
        Full path to Movie folder (with trailing slash):<br>
        <input type="text" name="movie_dir" style="width:400px"/><br><br>
       
        <h2>mysql settings</h2>
        database:<br>
        <input type="text" name="mysql_db" /><br>
        user:<br>
        <input type="text" name="mysql_user" /><br>
        password:<br>
        <input type="password" name="mysql_pass" /><br>
       
        <h2>mod_auth_token settings</h2>
        AuthTokenSecret (secret string):<br>
        <input type="text" name="AuthTokenSecret" /><br>
        AuthTokenPrefix:<br>
        <input type="text" name="AuthTokenPrefix" value="/serve/"/><br>
        
        <h2>General Settings</h2>
        Site title:<br>
        <input type="text" name="site_title" value="CLOAKSTREAM"/><br>
        Admin email (for contact link on footer):<br>
        <input type="text" name="contact" value="example@example.com"/><br>
        <input type="submit" name="install" value="Install" />
    </form>
    <?
}


?>
