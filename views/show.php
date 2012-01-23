<? include('header.php') ?>
	<!-- HEADER END -->
	<div class="clear"></div>
	
	<!-- CONTENT START -->
    <div id="content">
        <div class="lumpy">
            <!--
            <div style="text-align:right;padding:20px;">
            <b>Search for show:</b>&nbsp;&nbsp;<input type="text" id="searchbox" style="width:340px;font-size:13px;padding:3px;border:1px solid black;">
            </div>
            -->
            <!--
            <script type="text/javascript">
            $(document).ready(function() {
            $('input[type="text"]').addClass("idleField");
            $('input[type="text"]').focus(function() {
            $(this).removeClass("idleField").addClass("focusField");
            if (this.value == this.defaultValue){
            this.value = '';
            }
            if(this.value != this.defaultValue){
            this.select();
            }
            });
            $('input[type="text"]').blur(function() {
            $(this).removeClass("focusField").addClass("idleField");
            if ($.trim(this.value) == ''){
            this.value = (this.defaultValue ? this.defaultValue : '');
            }
            });
            });
            </script>
            <style type="text/css">
            .idleField{
            background:inherit;
            width:340px;
            font-size:21px;
            padding:3px;
            border:0px;
            border-bottom:1px solid black;
            outline:none;
            }
            .focusField{
            background:#00D9FF;
            width:340px;
            font-size:21px;
            padding:3px;
            border:0px;
            border-bottom:1px solid black;
            outline:none;
            
            }
            </style>
            -->
            <!-- SEARCH BAR START -->
			<div style="text-align:justify;padding:11px;padding-right:20px;font-size:18px;display:block;">
                <div id="show_banner" style="width:758px; margin:0 auto;">
                    <img src="show_images/<?=$show['tvdb_id']?>.banner.jpg" alt="<?=$show['show_name']?>" title="<?=$show['show_name']?>"  />
                </div>
			</div>
            <!-- SEARCH BAR END -->
            <!-- RESULTS START -->

            <div id="results_container"><br>
                <? foreach($episodes as $i=>$row){?>
                <div class="<? if(($i%2)==0) echo "epEven"; else echo "epOdd";?>">
                    <p class="epTitle">
                        <a href="<?=$_SERVER['PHP_SELF']?>?v=<?=$row['episode_id']?>"><?=$row['season']?>x<?=$row['episode']?> - <?=$row['name']?></a>
                    </p>
                </div>
                <? }?>
    		</div>
            <!-- RESULTS END -->
    		<div class="epBottom"></div>
   		</div>
	</div>
	<!-- CONTENT END -->
	<div class="clear"></div>
	<!-- FOOTER START -->
<? include('footer.php') ?>

