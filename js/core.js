function hideStuff(){
	document.getElementById('header').style.display='none';
	document.getElementById('nav').style.display='none';
	document.getElementById('content').style.marginLeft='-250px';
	document.getElementById('content').style.width='100%';
}

function get_player_type(){
	if($.cookie("player") == null)
		$.cookie("player","html5");
	var type = $.cookie("player");
	switch(type){
		case "html5":
			return [{type: 'html5'},
					{type: 'flash', src: 'player.swf'}];
		case "flash":
			return [{type: 'flash', src: 'player.swf'},
					{type: 'html5'}];
	}
	
}

function set_player_type(type,re_load){
	switch(type){
		case "html5":
			$.cookie("player","html5");
			break;
		case "flash":
			$.cookie("player","flash");
			break;
		default:
			$.cookie("player","html5");
			break;
	}
	if(re_load != 'undefined' && re_load==true)
		location.reload(true);
}

$(function(){
	var player = get_player_type();
	player = player[0].type;
	if(player =="html5"){}
		$("#html5_type").addClass("activePlayer");
	else if(player =="flash")
		$("#flash_type").addClass("activePlayer");
});

