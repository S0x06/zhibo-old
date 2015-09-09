$(window).resize(function(){win_resize()});

$(function(){

	win_resize();
	//poppop_login_inner_close 关闭弹窗
	$('.pop_login_inner_close').click(function(){
		$('.pop_login').hide();
	})
	
	$('.enter_btns_login').click(function(){
		$('.pop_login').show();
	})
	var chatroom_ul_height = $('.chatroom_ul').height();
	$('.chatroom').scrollTop(chatroom_ul_height);

	get_msg_data();
    setTimeout(srcolldown,500);
})

var win_resize = function (){
	// chatroom_height
	var screenHeight = document.documentElement.clientHeight;
	var video_height = screenHeight*0.5;
	$('.video').outerHeight(video_height);
	var enter_btns_height = $('.enter_btns').outerHeight();
	var input_tool_height =$('.input_tool').outerHeight();
	var chatroom_height = screenHeight - video_height - enter_btns_height -input_tool_height;
	$('.chatroom').css('min-height',95);
	$('.chatroom').outerHeight(chatroom_height);
}

function get_msg_data(){
	var score = arguments[0] ? arguments[0] : STARTTIME;
	$.ajax({
		url : base.url+'chat/get_msg_data?time='+Date.parse(new Date()),
		type : 'POST',
		dataType: "json",
		cache : false,
		timeout : 30000,
		data : {score : score, rid:RID},
		success : function (result){
			setTimeout(function (){get_msg_data(result.score)}, 1000)
			deal_data(result.data_list);
		},
		error : function (XMLHttpRequest, textStatus){
			if(textStatus == 'timeout') setTimeout(function (){get_msg_data(score)}, 1000);
			else setTimeout(function (){get_msg_data(score)}, 3000);
		}
	})
}

function deal_data(data_list){
	var html = '';
	for(var i in data_list){
		var msg = $.parseJSON(data_list[i]);
		html += '<li class="chatroom_li"><div class="chatroom_user"><span class="chatroom_user_icon"><img src="'+base.tpl+'images/level/level'+msg['gid']+'.png" class="chatroom_user_icon_img"></span><span class="chatroom_user_name">'+msg['name']+'</span><span class="chatroom_time">'+msg['time']+'</span></div><div class="chatroom_message"><p class="chatroom_message_words chat_data_'+msg['gid']+'">'+msg['content']+'</p></div></li>';
	}
	$('#msg_list').append(html);
    
	srcolldown();
}

function send_msg(){
	var msg = $('#msg_content').html();
	if(msg == '') return;
	var date = new Date();
	var html = '<li class="chatroom_li"><div class="chatroom_user"><span class="chatroom_user_icon"><img src="'+base.tpl+'images/level/level'+GID+'.png" class="chatroom_user_icon_img"></span><span class="chatroom_user_name">'+USERNAME+'</span><span class="chatroom_time">'+date.Format("yyyy-MM-dd hh:mm:ss")+'</span></div><div class="chatroom_message"><p class="chatroom_message_words chat_data_'+GID+'">'+msg+'</p></div></li>'
	$('#msg_list').append(html);
	srcolldown();

	$.post(base.url+'chat/send_msg',{content:msg, rid:RID},function (){})
	$('#msg_content').focus().html('');
}

//滚动条设定在最底部；
function srcolldown(){
	var chat_room_log = $('.chatroom');
	var chat_room_log_ul = $('.chatroom ul');
	chat_room_log.animate({scrollTop:chat_room_log_ul.outerHeight(true)}, 1000);
}

$('#login_form').submit(function (){
	$.post(base.url+'user/login',
	$(this).serialize(),
	function (result){
		result = $.parseJSON(result);
		if(result.status){
			location.reload();
		}else{
			alert(result.msg);
		}
	})
	return false;
})

Date.prototype.Format = function(formatStr){
	var str = formatStr;
	var Week = ['日','一','二','三','四','五','六'];

	str=str.replace(/yyyy|YYYY/,this.getFullYear());
	str=str.replace(/yy|YY/,(this.getYear() % 100)>9?(this.getYear() % 100).toString():'0' + (this.getYear() % 100));

	str=str.replace(/MM/,this.getMonth()+1>9?(this.getMonth()+1).toString():'0' + (this.getMonth()+1));
	str=str.replace(/M/g,this.getMonth()+1);

	str=str.replace(/w|W/g,Week[this.getDay()]);

	str=str.replace(/dd|DD/,this.getDate()>9?this.getDate().toString():'0' + this.getDate());
	str=str.replace(/d|D/g,this.getDate());

	str=str.replace(/hh|HH/,this.getHours()>9?this.getHours().toString():'0' + this.getHours());
	str=str.replace(/h|H/g,this.getHours());
	str=str.replace(/mm/,this.getMinutes()>9?this.getMinutes().toString():'0' + this.getMinutes());
	str=str.replace(/m/g,this.getMinutes());

	str=str.replace(/ss|SS/,this.getSeconds()>9?this.getSeconds().toString():'0' + this.getSeconds());
	str=str.replace(/s|S/g,this.getSeconds());

	return str;
}