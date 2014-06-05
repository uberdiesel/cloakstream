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
                        file: "<?=$url?>",
						"image": "<?=$thumb_url?>",
                        autostart: true,
						'provider': 'http',
						'http.startparam': 'start',
						'menu': false,
                        height: 562,
                        width: 1000,
                        modes: get_player_type(),
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

