<div class="talk">
	<div class="chat">
		<div class="chat_bg"></div>
		<div class="talk_head"><p class="talk_head_p">24小时免费客服热线：021-51301950</p></div>
		<div class="chat_room">
			<ul id="msg_list">
				<?php foreach($chat_list as $v): ?>
				<li>
					<p class="li_p1"><span class="li_img"><img src="images/level/level<?php echo $v['gid']; ?>.png"></span><span><?php echo $v['name']; ?></span><span>&nbsp[<?php echo $v['time']; ?>]</span></p>
					<div class="li_p2 chat_data_<?php echo $v['gid']; ?>"><?php echo $v['content']; ?></div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="note">
		<p class="word">各位听众，如在提问过程中，老师不能及时回答，请及时与下方老师助理QQ取得联系！</p>
		<div class="qq">
			<img src="<?php echo $tpl; ?>images/q01.jpg" height="22" class="qq01">
			<a href=""><img src="<?php echo $tpl; ?>images/q02.jpg" width="77"></a>
			<a href=""><img src="<?php echo $tpl; ?>images/q02.jpg" width="77"></a>
			<a href=""><img src="<?php echo $tpl; ?>images/q02.jpg" width="77"></a>

		</div>
		<div class="note_row">
			<div class="face">
				<a href="javascript:;" class="face01" id="div1">表情</a>
				<a href="javascript:;" class="face02" id="div2">彩条</a>
				<a href="javascript:;" class="face03"><input type="file" class="face03_input upload_img">图片</a>
				<a href="javascript:;" class="face04" onclick="clear_screen()">清屏</a>
				<a href="javascript:;" class="face05 face05_toggle">滚动</a>
				<table border="0" cellspacing="0" cellpadding="0" class="face01_imgs" id="div3">
					<tr>
						<td><img title="鼓掌" class="clap" src="<?php echo $tpl; ?>images/face/1.1.gif" width="28" ><i>鼓掌</i></td>	
						<td><img title="跳" class="clap" src="<?php echo $tpl; ?>images/face/1.2.gif" width="28" ><i>跳</i></td>
						<td><img title="kiss" class="clap" src="<?php echo $tpl; ?>images/face/1.3.gif" width="28" ><i>kiss</i></td>
						<td><img title="跳" class="clap" src="<?php echo $tpl; ?>images/face/1.4.gif" width="28" ><i>跳</i></td>
						<td><img title="贱笑" class="clap" src="<?php echo $tpl; ?>images/face/1.5.gif" width="28"><i>贱笑</i></td>
						<td><img title="陶醉" class="clap" src="<?php echo $tpl; ?>images/face/1.6.gif" width="28"><i>陶醉</i></td>
						<td><img title="兴奋" class="clap" src="<?php echo $tpl; ?>images/face/1.7.gif" width="28" ><i>兴奋</i></td>
						<td><img title="鄙视" class="clap" src="<?php echo $tpl; ?>images/face/1.8.gif" width="24"><i>鄙视</i></td>
						<td><img title="得意" class="clap" src="<?php echo $tpl; ?>images/face/1.9.gif" width="28"><i>得意</i></td>
					</tr>
					<tr>
						<td><img title="偷笑" class="clap" src="<?php echo $tpl; ?>images/face/2.1.gif" width="28" ><i>偷笑</i></td>
						<td><img title="挖鼻孔" class="clap" src="<?php echo $tpl; ?>images/face/2.2.gif" width="28" ><i>挖鼻孔</i></td>
						<td><img title="衰" class="clap" src="<?php echo $tpl; ?>images/face/2.3.gif" width="28" ><i>衰</i></td>
						<td><img title="流汗" class="clap" src="<?php echo $tpl; ?>images/face/2.4.gif" width="28" ><i>流汗</i></td>
						<td><img title="伤心" class="clap" src="<?php echo $tpl; ?>images/face/2.5.gif" width="28" ><i>伤心</i></td>
						<td><img title="鬼脸" class="clap" src="<?php echo $tpl; ?>images/face/2.6.gif" width="28" ><i>鬼脸</i></td>
						<td><img title="狂笑" class="clap" src="<?php echo $tpl; ?>images/face/2.7.gif" width="28" ><i>狂笑</i></td>
						<td><img title="发呆" class="clap" src="<?php echo $tpl; ?>images/face/2.8.gif" width="24" ><i>发呆</i></td>
						<td><img title="害羞" class="clap" src="<?php echo $tpl; ?>images/face/2.9.gif" width="25" ><i>害羞</i></td>
					</tr>
					<tr>
						<td><img title="可怜" class="clap" src="<?php echo $tpl; ?>images/face/3.1.gif" width="28" ><i>可怜</i></td>
						<td><img title="气愤" class="clap" src="<?php echo $tpl; ?>images/face/3.2.gif" width="28" ><i>气愤</i></td>
						<td><img title="惊吓" class="clap" src="<?php echo $tpl; ?>images/face/3.3.gif" width="28" ><i>惊吓</i></td>
						<td><img title="困了" class="clap" src="<?php echo $tpl; ?>images/face/3.4.gif" width="28" ><i>困了</i></td>
						<td><img title="再见" class="clap" src="<?php echo $tpl; ?>images/face/3.5.gif" width="28" ><i>再见</i></td>
						<td><img title="感动" class="clap" src="<?php echo $tpl; ?>images/face/3.6.gif" width="28" ><i>感动</i></td>
						<td><img title="晕" class="clap" src="<?php echo $tpl; ?>images/face/3.7.gif" width="28" ><i>晕</i></td>
						<td><img title="可爱" class="clap" src="<?php echo $tpl; ?>images/face/3.8.gif" width="28" ><i>可爱</i></td>
						<td><img title="潜水" class="clap" src="<?php echo $tpl; ?>images/face/3.9.gif" width="28" ><i>潜水</i></td>
					</tr>
					<tr>
						<td><img title="强" class="clap" src="<?php echo $tpl; ?>images/face/4.1.gif" width="28" ><i>强</i></td>
						<td><img title="囧" class="clap" src="<?php echo $tpl; ?>images/face/4.2.gif" width="28" ><i>囧</i></td>
						<td><img title="窃笑" class="clap" src="<?php echo $tpl; ?>images/face/4.3.gif" width="28" ><i>窃笑</i></td>
						<td><img title="疑问" class="clap" src="<?php echo $tpl; ?>images/face/4.4.gif" width="28" ><i>疑问</i></td>
						<td><img title="装逼" class="clap" src="<?php echo $tpl; ?>images/face/4.5.gif" width="28" ><i>装逼</i></td>
						<td><img title="抱歉" class="clap" src="<?php echo $tpl; ?>images/face/4.6.gif" width="28" ><i>抱歉</i></td>
						<td><img title="鼻血" class="clap" src="<?php echo $tpl; ?>images/face/4.7.gif" width="28" ><i>鼻血</i></td>
						<td><img title="睡觉" class="clap" src="<?php echo $tpl; ?>images/face/4.8.gif" width="28" ><i>睡觉</i></td>
						<td><img title="委屈" class="clap" src="<?php echo $tpl; ?>images/face/4.9.gif" width="24" ><i>委屈</i></td>
					</tr>
					<tr>
						<td><img title="笑哈哈" class="clap" src="<?php echo $tpl; ?>images/face/5.1.gif" width="22" ><i>笑哈哈</i></td>
						<td><img title="贱贱地笑" class="clap" src="<?php echo $tpl; ?>images/face/5.2.gif" width="22" ><i>贱贱地笑</i></td>
						<td><img title="被电" class="clap" src="<?php echo $tpl; ?>images/face/5.3.gif" width="22" ><i>被电</i></td>
						<td><img title="转发" class="clap" src="<?php echo $tpl; ?>images/face/5.4.gif" width="22" ><i>转发</i></td>
						<td><img title="求关注" class="clap" src="<?php echo $tpl; ?>images/face/5.5.gif" width="22" ><i>求关注</i></td>
						<td><img title="路过这儿" class="clap" src="<?php echo $tpl; ?>images/face/5.6.gif" width="22" ><i>路过这儿</i></td>
						<td><img title="好激动" class="clap" src="<?php echo $tpl; ?>images/face/5.7.gif" width="22" ><i>好激动动</i></td>
						<td><img title="招财" class="clap" src="<?php echo $tpl; ?>images/face/5.8.gif" width="22" ><i>招财</i></td>
						<td><img title="加油啦" class="clap" src="<?php echo $tpl; ?>images/face/5.9.gif" width="22" ><i>加油啦</i></td>
					</tr>
					<tr>
						<td><img title="转转" class="clap" src="<?php echo $tpl; ?>images/face/6.1.gif" width="22" ><i>转转</i></td>
						<td><img title="围观" class="clap" src="<?php echo $tpl; ?>images/face/6.2.gif" width="22" ><i>围观</i></td>
						<td><img title="推撞" class="clap" src="<?php echo $tpl; ?>images/face/6.3.gif" width="22" ><i>推撞</i></td>
						<td><img title="来嘛" class="clap" src="<?php echo $tpl; ?>images/face/6.4.gif" width="22" ><i>来嘛</i></td>
						<td><img title="啦啦啦" class="clap" src="<?php echo $tpl; ?>images/face/6.5.gif" width="22" ><i>啦啦啦</i></td>
						<td><img title="切克闹" class="clap" src="<?php echo $tpl; ?>images/face/6.6.gif" width="22" ><i>切克闹</i></td>
						<td><img title="给力" class="clap" src="<?php echo $tpl; ?>images/face/6.7.gif" width="22" ><i>给力</i></td>
						<td><img title="威武" class="clap" src="<?php echo $tpl; ?>images/face/6.8.gif" width="22" ><i>威武</i></td>
						<td><img title="流血" class="clap" src="<?php echo $tpl; ?>images/face/6.9.gif" width="22" ><i>流血</i></td>
					</tr>
				</table>
				<table class="face02_imgs" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="<?php echo $tpl; ?>images/zan/1.1.gif" width="180" title="顶一个" class="clap1"><i>顶一个</i></td>
					</tr>
					<tr>
						<td><img src="<?php echo $tpl; ?>images/zan/1.2.gif" width="180" title="赞一个" class="clap1"><i>赞一个</i></td>
					</tr>
					<tr>
						<td><img src="<?php echo $tpl; ?>images/zan/1.3.gif" width="180" title="掌声" class="clap1"><i>掌声</i></td>
					</tr>
					<tr>
						<td><img src="<?php echo $tpl; ?>images/zan/1.4.gif" width="180" title="鲜花" class="clap1"><i>鲜花</i></td>
					</tr>
				</table>
			</div>
			<a class="note_img dialog" href="javascript:;" data-target="power_access01" data-width="410" data-height="280" >
				<img src="<?php echo $tpl; ?>images/nav_value_book/book_button.jpg" width="159">
			</a> 
		</div>
		<div class="outer_textarea">
			<div class="text01" contentEditable="true" id="msg_content"></div>
			<a href="javascript:;" class="power_access_password" onclick="send_msg()"><img src="<?php echo $tpl; ?>images/sede.jpg" width="159" class="send01"></a>
		</div>
	</div>
</div>

<script>
	
$(function (){
	get_msg_data();
})

function get_msg_data(){
	var score = arguments[0] ? arguments[0] : STARTTIME;
	$.ajax({
		url : base.url+'chat/get_msg_data',
		type : 'POST',
		dataType: "json",
		cache : false,
		timeout : 20000,
		data : {score : score},
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
	console.log(data_list);
	var html = '';
	for(var i in data_list){
		var msg = $.parseJSON(data_list[i]);
		html += '<li><p class="li_p1"><span class="li_img"><img src="images/level/level'+msg['gid']+'.png"></span><span>'+msg['name']+'</span><span>&nbsp['+msg['time']+']</span></p><div class="li_p2 chat_data_'+msg['gid']+'">'+msg['content']+'</div></li>';
	}
	$('#msg_list').append(html);
	srcolldown();
}

function send_msg(){
	var msg = $('#msg_content').html();
	if(msg == '') return;

	var date = new Date();
	var html = '<li><p class="li_p1"><span class="li_img"><img src="images/level/level'+GID+'.png"></span><span>'+USERNAME+'</span><span>&nbsp['+date.Format("yyyy-MM-dd hh:mm:ss")+']</span></p><div class="li_p2 chat_data_'+GID+'">'+msg+'</div></li>';
	$('#msg_list').append(html);
	srcolldown();

	$.post(base.url+'chat/send_msg',{content:msg},function (){})
	$('#msg_content').focus().html('');
}

document.onkeydown = function (){
	var e = e || window.event; 
	var keyCode = e.keyCode || e.which || e.charCode;
	if( e.ctrlKey && (e.keyCode == 13) ){
		var element = e.srcElement||e.target;
		if( $(element).attr('id') == 'msg_content'){
			send_msg();
		}
	}
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
					$('#msg_content').append('<img src="'+result.img+'">');
				}else{
					alert(result.msg);
				}
			}
		});
	});
})

</script>