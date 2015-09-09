<div class="chatroom">
	<div class="inner_chatroom">
		<div class="chat_room">
			<div class="chat_room_head">
				<p>24小时免费客服热线：<span>021-51301950</span></p> 
			</div>
			<div class="chat_room_log">
				<ul class="chat_room_log_contain" id="msg_list">
					<?php foreach($chat_list as $v): ?>
					<li>
						<p><img src="images/level/level<?php echo $v['gid']; ?>.png"></p>
						<div class="outer_chatroom">
							<span><?php echo $v['name']; ?>&nbsp[<?php echo $v['time']; ?>]</span>
							<div class="chat_room_log_word chat_data_<?php echo $v['gid']; ?>"><?php echo $v['content']; ?></div>
						</div>
					</li>
					<?php endforeach; ?>				
				</ul>
			</div>
		</div>
		<div class="chat_tool">
			<div class="inner_chat_tool">
				<p class="chat_tool_head"><span>点击咨询老师助理，</span><span class="chat_tool_head_free">免费</span><span>领取投资宝典</span><span class="chat_tool_head_button"><a href="qq.html?qq=<?php echo $room['qq']; ?>" target="_blank" class="chat_tool_head_button_inner">立即领取</a></span></p>
				<div class="chat_tool_qq">
					<ul>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
						<li><?php echo $room['qq_code']; ?></li>
					</ul>	
				</div>
				<div class="emotion">
					<div class="emotion_inner">
						<a href="javascript:;" class="face"><span class="face">表情</span></a>
						<a href="javascript:;" class="color_bar"><span class="color_bar">彩条</span></a>
						<a href="javascript:;" ><input type="file" class="face03_input upload_img"><span class="img">图片</span></a>
						<a href="javascript:;"  onclick="clear_screen()"><span class="clear">清屏</span></a>
						<!-- <a href="javascript:;" ><span class="scroll">滚动</span></a> -->
						<div class="change_skin">换肤
							<span class="skin_yellow change_color" onclick="change_color('yellow')" ></span>
							<span class="skin_blue change_color" onclick="change_color('blue')" ></span>
							<span class="skin_purple change_color" onclick="change_color('purple')" ></span>
							<span class="skin_gray change_color" onclick="change_color('gray')" ></span>
						</div>
					</div>
					<table border="0" cellspacing="0" cellpadding="0" class="face01_imgs" id="div3">
						<tr>
							<td><img title="鼓掌" class="clap" src="<?php echo $tpl; ?>images/face/1.1.gif" width="28" ></td>
							<td><img title="跳" class="clap" src="<?php echo $tpl; ?>images/face/1.2.gif" width="28" ></td>
							<td><img title="kiss" class="clap" src="<?php echo $tpl; ?>images/face/1.3.gif" width="28" ></td>
							<td><img title="跳" class="clap" src="<?php echo $tpl; ?>images/face/1.4.gif" width="28" ></td>
							<td><img title="贱笑" class="clap" src="<?php echo $tpl; ?>images/face/1.5.gif" width="28"></td>
							<td><img title="陶醉" class="clap" src="<?php echo $tpl; ?>images/face/1.6.gif" width="28"></td>
							<td><img title="兴奋" class="clap" src="<?php echo $tpl; ?>images/face/1.7.gif" width="28" ></td>
							<td><img title="鄙视" class="clap" src="<?php echo $tpl; ?>images/face/1.8.gif" width="24"></td>
							<td><img title="得意" class="clap" src="<?php echo $tpl; ?>images/face/1.9.gif" width="28"></td>
						</tr>
						<tr>
							<td><img title="偷笑" class="clap" src="<?php echo $tpl; ?>images/face/2.1.gif" width="28" ></td>
							<td><img title="挖鼻孔" class="clap" src="<?php echo $tpl; ?>images/face/2.2.gif" width="28" ></td>
							<td><img title="衰" class="clap" src="<?php echo $tpl; ?>images/face/2.3.gif" width="28" ></td>
							<td><img title="流汗" class="clap" src="<?php echo $tpl; ?>images/face/2.4.gif" width="28" ></td>
							<td><img title="伤心" class="clap" src="<?php echo $tpl; ?>images/face/2.5.gif" width="28" ></td>
							<td><img title="鬼脸" class="clap" src="<?php echo $tpl; ?>images/face/2.6.gif" width="28" ></td>
							<td><img title="狂笑" class="clap" src="<?php echo $tpl; ?>images/face/2.7.gif" width="28" ></td>
							<td><img title="发呆" class="clap" src="<?php echo $tpl; ?>images/face/2.8.gif" width="24" ></td>
							<td><img title="害羞" class="clap" src="<?php echo $tpl; ?>images/face/2.9.gif" width="25" ></td>
						</tr>
						<tr>
							<td><img title="可怜" class="clap" src="<?php echo $tpl; ?>images/face/3.1.gif" width="28" ></td>
							<td><img title="气愤" class="clap" src="<?php echo $tpl; ?>images/face/3.2.gif" width="28" ></td>
							<td><img title="惊吓" class="clap" src="<?php echo $tpl; ?>images/face/3.3.gif" width="28" ></td>
							<td><img title="困了" class="clap" src="<?php echo $tpl; ?>images/face/3.4.gif" width="28" ></td>
							<td><img title="再见" class="clap" src="<?php echo $tpl; ?>images/face/3.5.gif" width="28" ></td>
							<td><img title="感动" class="clap" src="<?php echo $tpl; ?>images/face/3.6.gif" width="28" ></td>
							<td><img title="晕" class="clap" src="<?php echo $tpl; ?>images/face/3.7.gif" width="28" ></td>
							<td><img title="可爱" class="clap" src="<?php echo $tpl; ?>images/face/3.8.gif" width="28" ></td>
							<td><img title="潜水" class="clap" src="<?php echo $tpl; ?>images/face/3.9.gif" width="28" ></td>
						</tr>
						<tr>
							<td><img title="强" class="clap" src="<?php echo $tpl; ?>images/face/4.1.gif" width="28" ></td>
							<td><img title="囧" class="clap" src="<?php echo $tpl; ?>images/face/4.2.gif" width="28" ></td>
							<td><img title="窃笑" class="clap" src="<?php echo $tpl; ?>images/face/4.3.gif" width="28" ></td>
							<td><img title="疑问" class="clap" src="<?php echo $tpl; ?>images/face/4.4.gif" width="28" ></td>
							<td><img title="装逼" class="clap" src="<?php echo $tpl; ?>images/face/4.5.gif" width="28" ></td>
							<td><img title="抱歉" class="clap" src="<?php echo $tpl; ?>images/face/4.6.gif" width="28" ></td>
							<td><img title="鼻血" class="clap" src="<?php echo $tpl; ?>images/face/4.7.gif" width="28" ></td>
							<td><img title="睡觉" class="clap" src="<?php echo $tpl; ?>images/face/4.8.gif" width="28" ></td>
							<td><img title="委屈" class="clap" src="<?php echo $tpl; ?>images/face/4.9.gif" width="24" ></td>
						</tr>
						<tr>
							<td><img title="笑哈哈" class="clap" src="<?php echo $tpl; ?>images/face/5.1.gif" width="22" ></td>
							<td><img title="贱贱地笑" class="clap" src="<?php echo $tpl; ?>images/face/5.2.gif" width="22" ></td>
							<td><img title="被电" class="clap" src="<?php echo $tpl; ?>images/face/5.3.gif" width="22" ></td>
							<td><img title="转发" class="clap" src="<?php echo $tpl; ?>images/face/5.4.gif" width="22" ></td>
							<td><img title="求关注" class="clap" src="<?php echo $tpl; ?>images/face/5.5.gif" width="22" ></td>
							<td><img title="路过这儿" class="clap" src="<?php echo $tpl; ?>images/face/5.6.gif" width="22" ></td>
							<td><img title="好激动" class="clap" src="<?php echo $tpl; ?>images/face/5.7.gif" width="22" ></td>
							<td><img title="招财" class="clap" src="<?php echo $tpl; ?>images/face/5.8.gif" width="22" ></td>
							<td><img title="加油啦" class="clap" src="<?php echo $tpl; ?>images/face/5.9.gif" width="22" ></td>
						</tr>
						<tr>
							<td><img title="转转" class="clap" src="<?php echo $tpl; ?>images/face/6.1.gif" width="22" ></td>
							<td><img title="围观" class="clap" src="<?php echo $tpl; ?>images/face/6.2.gif" width="22" ></td>
							<td><img title="推撞" class="clap" src="<?php echo $tpl; ?>images/face/6.3.gif" width="22" ></td>
							<td><img title="来嘛" class="clap" src="<?php echo $tpl; ?>images/face/6.4.gif" width="22" ></td>
							<td><img title="啦啦啦" class="clap" src="<?php echo $tpl; ?>images/face/6.5.gif" width="22" ></td>
							<td><img title="切克闹" class="clap" src="<?php echo $tpl; ?>images/face/6.6.gif" width="22" ></td>
							<td><img title="给力" class="clap" src="<?php echo $tpl; ?>images/face/6.7.gif" width="22" ></td>
							<td><img title="威武" class="clap" src="<?php echo $tpl; ?>images/face/6.8.gif" width="22" ></td>
							<td><img title="流血" class="clap" src="<?php echo $tpl; ?>images/face/6.9.gif" width="22" ></td>
						</tr>
					</table>
					<table class="face02_imgs" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td><img src="<?php echo $tpl; ?>images/zan/1.1.gif" width="180" title="顶一个" class="clap1"></td>
						</tr>
						<tr>
							<td><img src="<?php echo $tpl; ?>images/zan/1.2.gif" width="180" title="赞一个" class="clap1"></td>
						</tr>
						<tr>
							<td><img src="<?php echo $tpl; ?>images/zan/1.3.gif" width="180" title="掌声" class="clap1"></td>
						</tr>
						<tr>
							<td><img src="<?php echo $tpl; ?>images/zan/1.4.gif" width="180" title="鲜花" class="clap1"></td>
						</tr>
						<tr>
							<td><img src="<?php echo $tpl; ?>images/zan/1.5.gif" title="红包" class="clap1"></td>
						</tr>
					</table>
				</div>
				<div class="send">
					<div class="send_input" id="msg_content" contentEditable="true"></div>
					<img src="<?php echo $tpl; ?>images/send_hover.png" class="send_img" width="123" onclick="send_msg()"  >
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
$(function (){
	get_msg_data();
	change_color($.cookie('color') || COLOR);
})

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
		html += '<li><p><img src="images/level/level'+msg['gid']+'.png"></p><div class="outer_chatroom"><span>'+msg['name']+'&nbsp['+msg['time']+']</span><div class="chat_room_log_word chat_data_'+msg['gid']+'">'+msg['content']+'</div></div></li>';
	}
	$('#msg_list').append(html);
	var chat_room_log_contain_width = $('.chat_room_log_contain').width();
    var outer_chatroom_width;
    outer_chatroom_width = chat_room_log_contain_width -20-80;
    $('.outer_chatroom').width(outer_chatroom_width);
    
	srcolldown();
}

function send_msg(){
	var msg = $('#msg_content').html();
	if(msg == '') return;
	var date = new Date();
	var html = '<li><p><img src="images/level/level'+GID+'.png"></p><div class="outer_chatroom"><span>'+USERNAME+'&nbsp['+date.Format("yyyy-MM-dd hh:mm:ss")+']</span><div class="chat_room_log_word chat_data_'+GID+'">'+msg+'</div></div></li>';
	$('#msg_list').append(html);
	srcolldown();

	$.post(base.url+'chat/send_msg',{content:msg, rid:RID},function (){})
	$('#msg_content').focus().html('');

	var chat_room_log_contain_width = $('.chat_room_log_contain').width();
    var outer_chatroom_width;
    outer_chatroom_width = chat_room_log_contain_width -20-80;
    $('.outer_chatroom').width(outer_chatroom_width);
}

document.onkeydown = function (){
	var e = e || window.event; 
	var keyCode = e.keyCode || e.which || e.charCode;
	if( (e.ctrlKey && (e.keyCode == 13)) ||  e.keyCode == 13 ){
		var element = e.srcElement||e.target;
		if( $(element).attr('id') == 'msg_content'){
			send_msg();
		}
	}
}

$(function (){
	$(".upload_img").change(function(){
		var data = new FormData();
		$.each($('.upload_img')[0].files, function(i, file) {
			data.append('upload_img', file);
		});
		$.ajax({
			url:base.url+'upload/img',
			type:'POST',
			data:data,
			cache: false,
			dataType: "json",
			contentType: false,    //不可缺
			processData: false,    //不可缺
			success:function(result){
				if(result.status){
					$('#msg_content').append('<img src="/'+result.img+'">');
				}else{
					alert(result.msg);
				}
			}
		});
	});
})

var change_color = function(color){
	$('.change_color').removeClass('skin_checked');
	$('.skin_'+color).addClass('skin_checked');
	if(color == COLOR) return;

	COLOR = color;
	$.cookie('color', color);

	var css_link = $('#color_style');
	css_link.remove();
	if(color != 'yellow') $('head').append('<link rel="stylesheet" href="<?php echo $tpl; ?>css/change_skin_'+color+'.css" id="color_style">');
}

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

</script>