
<div class="nav">
	<div class="logo">第一白银直播</div>
	<div class="nav_contain">
		<div class="contain_bg">
			<div class="nc_btns">
				<ul class="btns_section">
					<li><a href="javascript:" class="dialog" data-target="policy"  data-width="920" data-height="540"><span class="btns_img policy"></span><span class="btns_word">金牌策略</span></a></li>
					<li><a href="javascript:" class="dialog" data-url="http://www.jin10.com/jin10.com.html" data-width="960" data-height="600"><span class="btns_img data"></span><span class="btns_word">财经日历</span></a></li>
					<li><a href="javascript:" class="dialog" data-target="experts" data-width="920" data-height="600" data-oncomplete="expert_switch()"><span class="btns_img team"></span><span class="btns_word">名师团队</span></a></li>
					<li><a href="javascript:" class="dialog" data-target="kechengbiao" data-width="920" data-height="420" data-oncomplete="kechengbiao_time()"><span class="btns_img source"></span><span class="btns_word">课程安排</span></a></li>
					<li><a href="javascript:" class="dialog" data-target="record" data-width="920" data-height="600"><span class="btns_img record" ></span><span class="btns_word">战绩回顾</span></a></li>
					<li><a href="javascript:" class="dialog" data-target="product" data-oncomplete="product_switch()" data-width="940" data-height="620"><span class="btns_img produce"></span><span class="btns_word">产品介绍</span></a></li>
				</ul>
			</div>
			<div class="nc_soft">
				<a href="javascript:" class="dialog" data-target="teacher_cheats" data-width="920" data-height="350" ><p class="teacher_cheats">名师秘籍</p></a>
				<a href="javascript:" class="dialog" data-target="soft_down" data-width="920" data-height="710"><p class="soft_down">软件下载</p></a>
			</div>
		</div>
		<div class="news">
			<div class="news_head">
				<span class="news_head_left">最新会员消息</span>
				<span class="news_head_middle"><span class="news_head_middle_special"></span><span>人在线</span></span></span>
			</div>	
			<div class="outer_news_ul">
				<ul class="news_ul">
					<?php foreach($upgrade_list as $v): ?>
					<li>
						<span class="user_name"><?php echo $v['name']; ?></span>
						<span>成为</span>
						<span><img src="images/level/level<?php echo $v['gid']; ?>.png" width="48"></span>
					</li>
					<?php endforeach; ?>					
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
function AddFavorite(sURL, sTitle) {   
	try {   
		window.external.addFavorite(sURL, sTitle);   
	} catch (e) {   
		try {   
			window.sidebar.addPanel(sTitle, sURL, "");   
		} catch (e) {   
			alert("加入收藏失败，请使用Ctrl+D进行添加");   
		}   
	}   
}

function get_online_num(){
	var max = 3000;
	var min = 2000;
	var date = new Date();
	var hours = date.getHours();
	if(hours > 3 && hours < 12){
		max = 1000;
		min = 600;
	}
	if(hours >= 12 && hours < 18){
		max = 2000;
		min = 1500;
	}
	var num = parseInt(Math.random()*(max-min+1)+min,10);
	$('.news_head_middle_special').html(num+' ');
}
get_online_num();
setInterval(get_online_num, 60000);
</script>