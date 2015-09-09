<div class="aside">
	<div class="inner_aside">
		<div class="tread" id="stock_vote">
			<span class="span01">
				<img src="<?php echo $tpl; ?>images/kan01.jpg">
				<b class="b01"><span>看涨<?php echo $stock_vote['rise']; ?>%</span></b>
			</span>
			<span class="span01">
				<img src="<?php echo $tpl; ?>images/kan02.jpg">
				<b class="b02"><span>看平<?php echo $stock_vote['tie']; ?>%</span></b>
			</span>
			<span class="span01">
				<img src="<?php echo $tpl; ?>images/kan03.jpg">
				<b class="b03"><span>看空<?php echo $stock_vote['fall']; ?>%</span></b>
			</span>
		</div>
		<div class="roll">
			<p class="roll_head">在线会员列表</p>
			<div class="roll_list">
				<?php foreach($group_list as $gv): ?>
				<ul class="member_group_<?php echo $gv['id']; ?>"></ul>
				<ul class="member_group_dummy_<?php echo $gv['id']; ?>">
					<?php
					if(isset($dummy_list[$gv['id']])):
						foreach($dummy_list[$gv['id']] as $dv):
					?>
					<li>
						<span><?php echo $dv['name']; ?></span>
						<i><img src="images/level/level<?php echo $dv['gid']; ?>.png"></i>
					</li>
						<?php endforeach; ?>
					<?php endif; ?>									
				</ul>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="news">
		<div class="news_head">
			<span class="last">最新消息</span>
			<img src="<?php echo $tpl; ?>images/news_remind.png" width="57" class="news_remind">
		</div>
		<div class="bg_white">
			<div class="outer_news_list">	
				<ul class="news_list">
					<?php foreach($upgrade_list as $v): ?>
					<li>
						<span class="name"><?php echo $v['name']; ?></span><span>成为</span><span class="img"><img src="images/level/level<?php echo $v['gid']; ?>.png"></span><span class="rank"><?php echo $v['gname']; ?></span>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>

$(function (){
	get_online_list();
	send_heart();
})

function get_online_list(){
	$.ajax({
		url : base.url+'chat/get_online_list',
		type : 'POST',
		dataType: "json",
		cache : false,
		success : function (result){
			setTimeout(get_online_list, 60000);
			deal_online_list(result);
		},
		error : function (XMLHttpRequest, textStatus){
			setTimeout(get_online_list, 60000);
		}
	})
}

function deal_online_list(data){
	var result = [];
	for(var i in data){
		/*i为组ID*/
		var html = '';
		if(result[i] == undefined) result[i] = [];
		for(j in data[i]){
			html += '<li><span>'+data[i][j].name+'</span><i><img src="images/level/level'+data[i][j].gid+'.png"></i></li>';
		}
		$('.member_group_'+i).html(html);
	}
}

function send_heart()
{
	$.post(base.url+'chat/send_heart','',function (){
		setTimeout(send_heart, 60000);
	})
}

/*来投票吧*/
$('#stock_vote .span01').click(function (){
	var dom = $(this);
	var vote = dom.index() + 1;
	$.post(base.url+'user/stock_vote',
	{vote:vote},
	function (data){
		data = $.parseJSON(data);
		if(data.status){
			alert('投票成功');
		}else{
			alert(data.msg);
		}
	})
})

</script>