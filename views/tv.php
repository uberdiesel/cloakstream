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
			<!-- <div style="text-align:justify;padding:11px;padding-right:20px;font-size:18px;display:block;">
				<div style="width:153px;float:left;margin-top:3px;"><b>Search for show:</b></div>
				<div style="margin-left:153px;">
                    <input type="text" id="searchbox" style="background:inherit;
                        width:100%;
                        font-size:18px;
                        padding:3px;
                        border:0px;
                        border-bottom:1px solid black;
                        outline:none;" />
				</div>
			</div> -->
            <!-- SEARCH BAR END -->
            <script type="text/javascript">
                jQuery('#searchbox').focus();
                
                $('#searchbox').keyup(function() {
                    var search_string = encodeURIComponent($('#searchbox').val().replace("'", "&#039;"));
                    if (search_string == '') {
                        search_string = "geteverythingmofo";
                    }
                
                    $("#results_container").load("http://thanksforallthefi.sh//tv/index/" + search_string, function(response, status, xhr) {
                        if (status == "error") {
                            /* alert("AJAX Error - " + xhr.status + " " + xhr.statusText); */
                        }
                    });
                });
            </script>
            <!-- RESULTS START -->
            <div id="results_container">
                <? foreach($shows as $i=>$row){?>
                <div class="<? if(($i%2)==0) echo "epEven"; else echo "epOdd";?>">
                	<? if(file_exists('show_images/'.$row['tvdb_id'].'.banner.jpg')) { ?>
                    <div class="showimage siright">
                        <img height="75" src='show_images/<?=$row['tvdb_id']?>.banner.jpg' title="<?=$row['show_name']?>" />
                        <div class="imageover">&nbsp;</div>
                    </div>
                    <? } ?>
                    <p class="epTitle">
                        <a href="<?=$_SERVER['PHP_SELF']?>?t=<?=$row['tvdb_id']?>"><?=$row['show_name']?></a>
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

