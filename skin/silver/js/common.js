function resize(){
	//left高度
	var logo_height = $('.logo').height();//固定高度
	var contain_bg_height = $('.contain_bg').height();// 固定高度
	var news_head_height = $('.news_head').height();// 固定高度
	var screenHeight = document.body.offsetHeight;// 固定高度
	var screenWidth = document.body.offsetWidth;// 固定高度
	var outer_news_ul_height;
	outer_news_ul_height = screenHeight-logo_height-10-contain_bg_height-15-2-46-5-5;
	$('.outer_news_ul').height(outer_news_ul_height);
	//middle高度
	var chat_tool_height = $('.chat_tool').height();//固定高度
	var chat_room_head_height = $('.chat_room_head').height();//固定高度
	var chat_room_log_height;
	chat_room_log_height = screenHeight-chat_tool_height-1-10-chat_room_head_height-13-32;
	$('.chat_room_log').height(chat_room_log_height)
	//input：width设定
	var send_width = $('.send').width();
	var send_img_width = $('.send img').width();
	var send_input_width;
	send_input_width = send_width-send_img_width-25;
	$('.send_input').width(send_input_width);

	//video_online高度设定
	var video_height = $('.video').height();
	var video_head_height = $('.video_head').height();
	var video_active_height = $('.video_active').height();
	var video_online_height;
	video_online_height = video_height-video_head_height-video_active_height-10-10-32;
	$('.video_online').height(video_online_height)

	//.chat_room_log_word高度
	var chat_room_log_contain_width = $('.chat_room_log_contain').width();
    var outer_chatroom_width;
    outer_chatroom_width = chat_room_log_contain_width -20-80;
	$('.outer_chatroom').width(outer_chatroom_width);

    // foot宽度
    var inner_chatroom_width = $('.inner_chatroom').width();
    var foot_width = 690+10+inner_chatroom_width;
    $('.foot').width(foot_width);
}

 //最新消息滚动效果；
function news_scroll(){
	var li_last = $('.news_ul li').last();
	li_last.remove();
	$('.news_ul').prepend(li_last);
	li_last.hide().stop().fadeTo(4000,1);
	setTimeout(news_scroll, 5000);
}


//滚动条设定在最底部；
function srcolldown(){
	if(SCROLL){
		var chat_room_log = $('.chat_room_log');
		var chat_room_log_ul = $('.chat_room_log ul');
		chat_room_log.animate({scrollTop:chat_room_log_ul.outerHeight(true)}, 1000);
	}
}

//聊天记录清屏
function clear_screen(){
	$('.chat_room_log_contain').html('');
}

// 显示表情和彩条
$(document).bind('click', function (e){
	e = e || window.event;
	srcObj = e.srcElement ? e.srcElement : e.target;// 获取触发事件的源对象
	if($(srcObj).hasClass('face') || $(srcObj).hasClass('clap')){
		$('.face01_imgs').css('display','block');
	}else{
		$('.face01_imgs').css('display','none');
	}
	if($(srcObj).hasClass('color_bar') || $(srcObj).hasClass('clap1')){
		$('.face02_imgs').css('display','block');
	}else{
		$('.face02_imgs').css('display','none');
	}
})

//滚动点击效果
$('.scroll').click(function(){
	$(this).toggleClass('scroll_toggle');
	if(SCROLL == 1) SCROLL = 0;
	else SCROLL = 1;
})

//活动栏滚动效果
$('.video_active_btns li').mouseover(function(){
	var index = $(this).index();
	$(this).addClass('btns_current').siblings().removeClass('btns_current');
	$('.video_active_imgs li:eq('+index+')').addClass('li_acactive').siblings().removeClass('li_acactive');
})

//活动栏滚动效果 定时器

var timer_active_banner_num=-1;
var tiner_this=null;
function timer_active_banner(){
	
	var active_imgs_length =$('.video_active_imgs li').length;
	timer_active_banner_num++;
	if(timer_active_banner_num>active_imgs_length-1){timer_active_banner_num=0}
	$('.video_active_imgs li:eq('+timer_active_banner_num+')').addClass('li_acactive').siblings().removeClass('li_acactive');
	$('.video_active_btns li:eq('+timer_active_banner_num+')').addClass('btns_current').siblings().removeClass('btns_current');	
	tiner_this = setTimeout(timer_active_banner,3000)

}
$('.video_active').mouseover(function(){
	clearInterval(tiner_this);
});
$('.video_active').mouseout(function(){
	tiner_this = setTimeout(timer_active_banner,3000)
});

	/*$('.send_img').hover(function(){
		$(this).attr('src',base.tpl+'images/send.png');
	},function(){
		$(this).attr('src',base.tpl+'images/send_hover.png');
	});*/

//微信看看浮标
var weixin_timer =null;
function weixin_junp_pren(){
	$('.weixin_look').stop().animate({'width':95,'height':95},2000).delay(3000).animate({'width':75,'height':75},1000);
	$('.weixin_hovering>img').stop().animate({'width':94},2000).delay(3000).animate({'width':70},1000);
	$('.weixin_bg').stop().animate({'width':95,'height':95},2000).delay(3000).animate({'width':70,'height':70},1000);
	weixin_timer = setTimeout(weixin_junp_pren,6000);	
}	
$('.weixin_hovering').mouseover(function(){
	clearInterval(weixin_timer);
	$('.weixin_screen').stop().animate({'width':689,'height':268},1000)		
})
$('.weixin_hovering').mouseout(function(){
	$('.weixin_screen').stop().animate({'width':65,'height':65},1000)
	weixin_timer = setTimeout(weixin_junp_pren,6000)		
})
//课程表
function kechengbiao_time(){
	var d = new Date()
	var weekday = d.getDay();
	var hours = d.getHours();
	var kechengbiao_week_li_index = weekday-1;
	var time_array = [hours >8 && hours <10,hours >9 && hours <12,hours >11 && hours <14,hours >13 && hours <16,hours >15 && hours <18,hours >17 && hours <20,hours >19 && hours <22,hours >21 && hours <24,hours >2 && hours < 9];
	var index_length = ['0','1','2','3','4','5','6','7','9'];
	for(var i=0;i<index_length.length;i++){
		if(time_array[i]){
			if(weekday >= 1 && weekday <=5 ){
				$('.dialog-content .hours_time').removeClass('hours_time_current');
				$('.dialog-content .hours_contain').removeClass('hours_contain_current');
				$('.dialog-content .kechengbiao_week>li').removeClass('kechengbiao_week_li_current');
				$('.dialog-content .kechengbiao_week_bar').removeClass('kechengbiao_week_button');		
				$('.dialog-content .kechengbiao_hours>li:eq('+index_length[i]+')').children('.hours_time').addClass('hours_time_current');
				$('.dialog-content .kechengbiao_hours>li:eq('+index_length[i]+')').children('.hours_contain').addClass('hours_contain_current');
				$('.dialog-content .kechengbiao_week>li:eq('+kechengbiao_week_li_index+')').addClass('kechengbiao_week_li_current');
				$('.dialog-content .kechengbiao_week>li:eq('+kechengbiao_week_li_index+')').children('.kechengbiao_week_bar').addClass('kechengbiao_week_button');
			}else{return}
		}
	}
	if(hours >0 && hours <2){
		var kechengbiao_week_li_index = weekday-2;
		if(kechengbiao_week_li_index == -1 || kechengbiao_week_li_index == -2){
			$('.dialog-content .hours_time').removeClass('hours_time_current');
			$('.dialog-content .hours_contain').removeClass('hours_contain_current');
			$('.dialog-content .kechengbiao_week>li').removeClass('kechengbiao_week_li_current');
			$('.dialog-content .kechengbiao_week_bar').removeClass('kechengbiao_week_button');			
		}else{
			$('.dialog-content .hours_time').removeClass('hours_time_current');
			$('.dialog-content .hours_contain').removeClass('hours_contain_current');
			$('.dialog-content .kechengbiao_week>li').removeClass('kechengbiao_week_li_current');
			$('.dialog-content .kechengbiao_week_bar').removeClass('kechengbiao_week_button');					
			$('.dialog-content .kechengbiao_hours>li:eq(8)').children('.hours_time').addClass('hours_time_current');
			$('.dialog-content .kechengbiao_hours>li:eq(8)').children('.hours_contain').addClass('hours_contain_current');
			$('.dialog-content .kechengbiao_week>li:eq('+kechengbiao_week_li_index+')').addClass('kechengbiao_week_li_current');
			$('.dialog-content .kechengbiao_week>li:eq('+kechengbiao_week_li_index+')').children('.kechengbiao_week_bar').addClass('kechengbiao_week_button');
		}
	}

    setTimeout(kechengbiao_time,1000)
}	

$(function(){
	resize();
	news_scroll();
	setTimeout(srcolldown, 500);
	
	//emotion表情跟彩条点击
	$('.face01_imgs img, .face02_imgs img').click(function(){
		var html = '<img src="'+base.url+$(this).attr('src')+'" >'
		$('.send_input').append(html);
	})

	timer_active_banner();

	//微信看看浮标
	weixin_junp_pren();

})

