<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Conjtent-Type" content="text/html; charset=UTF-8" />
    <title><?=$config['site_title']?> :: <?=$title?></title>
    
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="height=device-height,width=device-width" />
    <link rel="stylesheet" href="css/core.css" type="text/css" />
    <script type="text/javascript" src="js/jwplayer.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/core.js"></script>
    <style>
		#episode {
			margin: 0 auto;
		}
		.episode_nav {width:475px; height:65px;  background:#0E5880; color:#4CB6ED; display:block; text-decoration:none; line-height: 65px;}
		.episode_nav.next{
			padding-right:25px;
			text-align:right;
			margin-top:-65px;
			margin-left:500px;
		}
		.episode_nav.prev{
			padding-left:25px;
		}
		
	</style>

</head>
<body id="mainbody">
	<!-- HEADER START -->
    <div id="header">
        <h1><a href="index.php"><?=$config['site_title']?></a></h1>
    	<!-- OLD PROFILE/LOGOUT BAR
        <div class="m_link">
            <div class="userButton">
                Welcome, <b>USERNAME</b><br />
                <div>
                    <a href="user/page/">Profile</a> | 
                    <a href="main/logout">Logout</a> 
                </div>
            </div>
        </div>
        -->
        <div class="header_links">
            <a href="index.php?view=tv">TV Shows</a>
            <a href="index.php?view=latest_episodes">Latest</a>
            <!-- MOVIES
            <a href="movies">Movies</a>	
            -->
            <!-- OLD QUEUE FUNCTIONALITY	 
            <a href="#" id="que">
                Queue<span id="queuecount-bar" style="display: none;"> (0)</span>
            </a> 
            <div class="ui-tooltip-left" style="display:inline;position:relative;bottom:3px;display:none;" id="queuenotice">
                Item(s) Added!
            </div>
            -->
        </div>
        <br>
    </div>
