<? include('header.php') ?>
	<!-- HEADER END -->
	<div class="clear"></div>
	
	<!-- CONTENT START -->
    <div id="content">
        <div class="lumpy"><br>
            <div id="episode" style="width:1000px; margin: 0 auto;">
            	<h2><?=$ep['show_name']?>: <?=$ep['season']?>x<?=$ep['episode']?> - <?=$ep['name']?></h2>
                <div id="mediaplayer">EPISODE SHOULD BE HERE</div>
                <nav>
                <? if(isset($prev)){?>
                	<a class="episode_nav prev" href="<?=$_SERVER['PHP_SELF']?>?v=<?=$prev?>">PREV</a>    
                <? } ?>     
                <? if(isset($next)){?>
				<a class="episode_nav next" href="<?=$_SERVER['PHP_SELF']?>?v=<?=$next?>">NEXT</a>
                <? } ?>      
                </nav>
                <p id="description" style="margin-top:30px;">
                <?=$ep['description']?>
                </p>                
                <script type="text/javascript">
                    jwplayer("mediaplayer").setup({
                        //file: "stream.php?c=<?=$code?>",
                        file: "<?=$url?>",
						/*'image': 'http://uberdiesel.org/uberdieselmedia/layer1copy.gif',*/
                        autostart: true,
                        //file: "http://uberdiesel.org/zoids.mp4",
                        //file: "http://weyland.be/files/mp4/rf-family.guy.s07e01.proper.avi.mp4",
                        //provider: "video",
						'provider': 'http',
						'http.startparam': 'start',
						'menu': false,
                        height: 562,
                        width: 1000,
                        modes: [
                            {type: 'flash', src: 'player.swf'},
                            {type: 'html5'}                        ],
						events: {
							onComplete: function() {
								<? if(isset($next)){?>
								window.location = "<?=$_SERVER['PHP_SELF']?>?v=<?=$next?>";
								<? } ?>   
						   	}
						}

                    });
                </script>
            </div>
   		</div>
	</div>
	<!-- CONTENT END -->
	<div class="clear"></div>
	<!-- FOOTER START -->
<? include('footer.php') ?>

