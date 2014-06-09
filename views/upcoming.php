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
               Upcoming episodes:
			</div>
            <!-- SEARCH BAR END -->
            <!-- RESULTS START -->

            <div id="results_container"><br>
                <? /*foreach($episodes as $j=>$date){*/?>
                <!--<div class="date_row">
                        <?//echo $core->ordinal_to_datetime($j)->format('l, M jS')?>
                </div>-->
                <? foreach($episodes as $i=>$row){?>
                <div class="<? if(($i%2)==0) echo "epEven"; else echo "epOdd";?>">
                    <? if(file_exists('show_images/'.$row['tvdb_id'].'.banner.jpg')) { ?>
                    <div class="showimage siright">
                        <a href="index.php?t=<?=$row['tvdb_id']?>"><img height="75" src='show_images/<?=$row['tvdb_id']?>.banner.jpg' title="<?=$row['show_name']?>" />
                        <div class="imageover"></div></a>
                    </div>
                    <? } ?>
                    <p class="epDate" title="<?=$core->ordinal_to_datetime($row['airdate'])->format('l, M jS')?>">
                        <?=$core->ordinal_to_datetime($row['airdate'])->format('l')?>
                    </p>
                    <p class="epTitle">
                        <a href="javascript:void(0);"><?=$row['show_name']?>: <?=$row['season']?>x<?=$row['episode']?> - <?=$row['name']?></a>
                    </p>
                </div>
                <?/* }*/?>
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

