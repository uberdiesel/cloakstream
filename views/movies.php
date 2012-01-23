<? include('header.php') ?>
	<!-- HEADER END -->
	<div class="clear"></div>
	
    <!-- CONTENT START -->
    <div id="content">
        <div class="lumpy">
            <style type="text/css">
            li {
            list-style: none outside;
            float: left;
            }
            
            div.moviegrid {
            display: block;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            margin-top: 10px;
            }
            
            div.moviecontainer {
            margin:15px;
            width:190px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            padding:5px;
            border-radius: 10px;
            border: 1px solid #897e7e;
            box-shadow: 0 0 10px #897e7e;
            background:skyblue;
            overflow:hidden;
            display:block;
            cursor:pointer;
            cursor:hand;
            }
            
            div.year {
            text-align:center;
            margin-bottom:5px;
            font-size:13px;
            font-weight: bold;
            }
            
            div.poster {
            width:200px;
            height:300px;
            background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            display:block;
            margin-left:-5px;
            margin-bottom:-5px;
            overflow:hidden;
            }
            
            div.moviename {
            font-family: Helvetica;
            overflow:hidden;
            color:#eee;
            margin-top:244px;
            border-top:1px solid #000;
            background-color:rgba(51,51,51,0.7);
            height:50px;
            width:194px;
            padding:5px;
            font-size:100%;
            }
            
            div.moviegrid a{
            color: inherit;
            text-decoration: none;
            }
            
            </style>
            <div class="moviegrid">
                <ul>
                	<? foreach($movies as $i=>$movie){ ?>
                    <a href="<?=watch_url?>">
                        <li>
                            <div class="moviecontainer" onmouseover="document.getElementById('m<?=$i?>').style.backgroundColor='rgba(51,51,51,1)';" onmouseout="document.getElementById('m0').style.backgroundColor='rgba(51,51,51,0.7)';">
                                <div class="year"><?=year?></div>
                                <div class="poster" style="background-image: url(<?=poster?>);">
                                    <div class="moviename" id="m<?=$i?>"><?=title?></div>
                                </div>
                            </div>
                        </li>
                    </a>
                    <? } ?>
                </ul>
            </div>	
        </div>
	</div>
	<!-- CONTENT END -->
	<div class="clear"></div>
	<!-- FOOTER START -->
<? include('footer.php') ?>