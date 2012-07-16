	<div class="footer">
        <b>Time Taken:</b> <?=$core->end_timer();?> &nbsp; 
        <b>Server load:</b> <?=$core->server_load();?>
        <div style="float:right;">Problem with any material on <?=$config['site_title']?>? 
        	<div class="b_link" style="display:inline;margin-right:50px;">
                <a href="mailto:<?=$config['contact']?>"><u>Contact Us</u></a> 
                <!--(Don't send anything other than official requests, it will be ignored.)-->
            </div>
            <b><?=$config['site_title']?></b> 
            <!-- utilizes 
            <a href="https://github.com/midgetspy/Sick-Beard">sickbeard</a>,  -->
            powered by
            <a href="https://github.com/uberdiesel/cloakstream">cloakstream</a>, 
            written by 
            <a href="https://github.com/uberdiesel/">uberdiesel</a>
        </div>
	</div>
	<!-- FOOTER END -->
	<br />
    <!-- OLD QUEUE FUNCTIONALITY
	<div id="dimmed">
		<div id="q-bg">
			Your T4F Queue (<b><span id="queuecount-box">0</span></b>)<span id="queclose" style="float:right;">[ <u>Close</u> ]</span>
    		<div id="q-contents">
    
        	</div>
            <div id="options">
                <span id="selectallitems">Select All Items</span> |
                <span id="removeitems">Remove Selected Items From Queue</span>
            </div>
        </div>
    </div>
    -->
	<script>
	/*
	$('a#que').click(function () {
	$('#dimmed').fadeIn(400);
	return false;
	});
	$('#queclose').click(function () {
	$('#dimmed').fadeOut(400);
	});
	
	function queue_action() {
	if ($('#dimmed').css('display') == "none")
	$('#dimmed').fadeIn(400);
	else
	$('#dimmed').fadeOut(400);
	}
	
	function queue_press(e) {
	if ('q'== String.fromCharCode(e.charCode).toLowerCase()) queue_action();
	}
	
	document.addEventListener('keypress', queue_press, false);
	
	$('.queueitem').live('click', function () {
	$(location).attr('href', 'http://thanksforallthefi.sh/' + $(this).attr('name'));
	});
	$('.queueitem input').live('click', function (e) {
	var $checkbox = $(this).find(':checkbox');
	$checkbox.attr('checked', !$checkbox.attr('checked'));
	e.stopImmediatePropagation();
	});
	
	function update_q(action) {
	if (!action) var action = '/index';
	
	$.getJSON("http://thanksforallthefi.sh//queue" + action, function(data) {
	$(".queueitem").remove();
	$('#q-contents').text('');
	
	if (data.error != '') {
	$('#q-contents').text(data.error);
	return false;
	}
	if (data.items == 0) {
	$('#q-contents').text("You have no items in your queue.");
	$("#queuecount-box").text('0');
	$("#queuecount-bar").text('').hide();
	return false;
	}
	$("#queuecount-box").text(data.items);
	$("#queuecount-bar").text(' (' + data.items + ')').show();
	var mediatype;
	$.each(data.queue, function(i, datum){
	mediatype = datum.type;
	if (mediatype == 'movie') mediatype = 'movies';
	$('<div class="queueitem" name="' + mediatype + '/watch/' + datum.id + "\">\n" + '<div class="itemindex">' + (i+1) + "</div>\n" + '<input class="items" type="checkbox" name="items" value="' + i + "\" />\n" + '<div class="type">' + datum.type + "</div>\n" + '<b>' + datum.title + '</b><br /><span>' + datum.subtitle + "</span>\n</div>\n").appendTo("#q-contents");
	});
	
	if (data.message != '') {
	$('#queuenotice').text(data.message).fadeIn().css("display","inline").delay(1700).fadeOut(1000);
	}
	});
	}
	
	update_q();
	
	$("#removeitems").click(function () {
	var str="";
	$("input:checked").each(function () {
	str += $(this).attr("value") + ".";
	});
	str = str.slice(0, -1);
	if (str != '') {
	update_q('/remove/' + encodeURIComponent(str));
	}
	});
	
	$("#selectallitems").click(function () {
	$(".items").attr('checked', true);
	});
	
	$(".addtoqueue").bind('click', function(e) {
	var str = $(this).attr('id');
	if (str != '') {
	update_q('/add/' + encodeURIComponent(str));
	}
	$(this).fadeTo(200, 0.4);
	$(this).unbind(e);
	});
	
	$("#nextitem").click(function (e) {
	e.preventDefault();
	$(location).attr('href', $(this).attr('href'));
	});
	
	$("#nextqueueitem").click(function (e) {
	e.preventDefault();
	var firstQueueItem = $(".queueitem").first().attr('name').split('/')[2];
	if (firstQueueItem == '0')
	$(location).attr('href', 'http://example.com//queue/advance');
	else
	$(location).attr('href', $(this).attr('href'));
	});
	
	$("video").bind("ended", function() {
	$('.rightbutton').first().trigger('click');
	
	});
	*/
	
	</script>
</body>
</html>
