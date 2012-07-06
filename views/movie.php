<? include('header.php') ?>
	<!-- HEADER END -->
	<div class="clear"></div>
	
	<!-- CONTENT START -->
    <div id="content">
        <div class="lumpy"><br>
            <div id="movie" style="width:1000px; margin: 0 auto;">
            	<h2><?=$id?> </h2>
                <div id="mediaplayer">EPISODE SHOULD BE HERE</div>
                
                <script type="text/javascript">
                    jwplayer("mediaplayer").setup({
                        file: "<?=$url?>",
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

