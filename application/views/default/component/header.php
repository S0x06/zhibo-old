<div class="head">
	<div class="left">
		<img class="img01" src="<?php echo $tpl; ?>images/logo.png" width="240">
		<div class="nav">
			<a class="save" href="desktop/">保存到桌面</a>
			<img class="img02" src="<?php echo $tpl; ?>images/head_ge.png" width="1">
			<a class="collect" href="javascript:" onclick="AddFavorite(window.location,document.title)">收藏</a>
			<a href="javascript:" class="nav_kechengbiao dialog" data-target="kechengbiao" data-width="900" data-height="600">
				<img src="<?php echo $tpl; ?>images/head01.png" width="38">
				<span>课程表</span>
			</a>
			<a href="javascript:;"  class="nav_product dialog" data-target="product" data-oncomplete="nav_switch()" data-width="940" data-height="620">
				<img src="<?php echo $tpl; ?>images/head02.png" width="38">
				<span>产品介绍</span>
			</a>
			<a href="javascript:;" class="company dialog" data-target="company" data-width="940" data-height="600">
				<img src="<?php echo $tpl; ?>images/head03.png" width="38">
				<span>公司简介</span>
			</a>
			<a href="javascript:;" class="experts dialog" data-target="experts" data-width="930" data-height="600">
				<img src="<?php echo $tpl; ?>images/head04.png" width="38">
				<span>专家团队</span>
			</a>
			<a href="javascript:;" class="staff  dialog" data-target="staff" data-width="840" data-height="590">
				<img src="<?php echo $tpl; ?>images/head05.png" width="38">
				<span>名师榜</span>
			</a>
			<a href="javascript:;" class="notes dialog " data-url="http://www.jin10.com/jin10.com.html" data-width="960" data-height="600">
				<img src="<?php echo $tpl; ?>images/head06.png" width="38">
				<span>财经日历</span>
			</a>
			<a href="http://www.gdyy99.com/download/soft/7" class="soft_load">
				<img src="<?php echo $tpl; ?>images/soft_download.png" width="38">
				<span>软件下载</span>
			</a>
			<a href="javascript:;" class="nav_value_book dialog" data-target="value_book" data-width="820" data-height="480">
				<img src="<?php echo $tpl; ?>images/nav_value_book/value_book.png" width="38">
				<span>名师秘籍</span>
			</a>
		</div>
	</div>
	<div class="right">
		<div class="hi">
			
			<span class="hi_w">HI，<?php echo $this->session->userdata('name'); ?></span>
			<?php if($this->session->userdata('is_login')): ?>
			<a href="user/info" class="logi">个人中心</a>
			<a href="user/logout" class="Register">退出</a>
			<?php else: ?>
			<a href="javascript:;" class="logi dialog show_login" data-target="login_form" data-width="330" data-height="380">登录</a>
			<a href="javascript:;" class="Register dialog" data-target="register_form" data-width="330" data-height="500">注册</a>
			<?php endif; ?>
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
</script>
