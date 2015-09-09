/*此js记录页面上的效果，没有弹窗的*/

//滚动条设定在最底部；
function srcolldown(){
	if(SCROLL){
		var chat_room=$('.chat_room');
		var chat_room_ul=$('.chat_room ul');
		// chat_room.scrollTop( chat_room_ul.outerHeight(true) );
		chat_room.animate({scrollTop:chat_room_ul.outerHeight(true)}, 1000);
	}
}
//滚动效果
function addname(){
	var timer=null;
	add_fn();
	timer=setInterval(add_fn,4000);
	function add_fn(){
		var dom_last=$('.news_list li').last();
		dom_last.remove();
		$('.news_list').prepend(dom_last);
		dom_last.hide().stop().fadeTo(2000,1);

	}
	

}
// 任课老师 nva 切换效果

function change_nav01(){
	$('.policy_head a').click(function(){
		var index=$(this).index()+1;
		$(this).addClass('a_bg').siblings().removeClass('a_bg');
		$('.policy_detail>div').eq(index).show().siblings().hide();
		return false;
	})

}

// 清屏效果
function clear_screen(){
	$('.chat_room ul li').remove();
}

$(function (){
	// 表情输入效果
	$('.face01_imgs img').click(function(e){
		var roll=$(this).parents('tr').index()+1;
		var col=$(this).parent().index()+1;
		var word= $(this).siblings().html();
		var html='<img src="'+base.url+base.tpl+'images/face/'+roll+'.'+col+'.gif" >'
		$('.send_input').append(html);
	})
	$('.face02_imgs img').click(function(e){
		var col=$(this).parents('tr').index()+1;
		var roll=$(this).parent().index()+1;
		var word= $(this).siblings().html();
		var html='<img src="'+base.url+base.tpl+'images/zan/'+roll+'.'+col+'.gif" >'
		$('.send_input').append(html);
	})
})

// 显示表情和彩条
$(document).click(function (event){
	event = event || window.event;
	srcObj = event.srcElement ? event.srcElement : event.target;// 获取触发事件的源对象
	if(srcObj  ==  document.getElementById('div1') || $(srcObj).hasClass('clap')){
		$('.face_imgs').css('display','block');
	}else{
		$('.face_imgs').css('display','none');
	}
	if(srcObj  ==  document.getElementById('div2') || $(srcObj).hasClass('clap1')){
		$('.color_bar_imgs').css('display','block');
	}else{
		$('.color_bar_imgs').css('display','none');
	}
})
//滚动效果
$('.face05').click(function(){
	$(this).toggleClass('face05_toggle');
	if(SCROLL == 1) SCROLL = 0;
	else SCROLL = 1;
})



// 最新活动按钮滚动效果
function active_scroll(type){
	var dom = $('.it_roll li');
	var length = dom.length;
	var hits = 0;

	dom.each(function (){
		if($(this).css('display') == 'block'){
			hits = $(this).index();
			return;
		} 
	})

	if(type == 'prev') hits--;
	if(type == 'next') hits++;
	if(hits > length-1){hits=0;}
	if(hits < 0){hits=length-1;}
	$('.it_roll li:eq('+hits+')').css('display','block').siblings().css('display','none');
}