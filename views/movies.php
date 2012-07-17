<? include('header.php') ?>
	<!-- HEADER END -->
	<div class="clear"></div>
	
    <!-- CONTENT START -->
    <div id="content">
        <div class="lumpy">
            <script type="text/javascript">
                jQuery('#searchbox').focus();

                $('#searchbox').keyup(function() {
                    var search_string = encodeURIComponent($('#searchbox').val().replace("'"$
                    if (search_string == '') {
                        search_string = "geteverythingmofo";
                    }

                    $("#results_container").load("http://thanksforallthefi.sh//tv/index/" + $
                        if (status == "error") {
                            /* alert("AJAX Error - " + xhr.status + " " + xhr.statusText); */
                        }
                    });
                });
        	</script>
            <!-- RESULTS START -->
            <div id="results_container">
                <? foreach($movies as $i=>$movie){?>
                <div class="<? if(($i%2)==0) echo "epEven"; else echo "epOdd";?>">
                    <p class="epTitle">
                    <a href= "<?=$_SERVER['PHP_SELF']?>?m=<?=$movie?>"><?=$movie?></a> 
                    </p>
                </div>

                <? } ?>
    		</div>
            <!-- RESULTS END -->
    		<div class="epBottom"></div>
   		</div>
	</div>
	<!-- CONTENT END -->
	<div class="clear"></div>
	<!-- FOOTER START -->
<? include('footer.php') ?>
