<div class="video">
	<div class="video_head">
		<!-- <span class="video_head_left">视频直播</span> -->
		<div class="video_logi">
			<span >您好：<?php echo $this->session->userdata('name'); ?></span>
			<?php if($this->session->userdata('is_login')): ?>
			<span class="logi_middle_line"></span>
			<a href="user/info" class="person_center">个人中心</a>
			<span class="logi_middle_line"></span>
			<a href="user/logout" class="exit">退出</a>
			<?php else: ?>
			<span class="logi_middle_line"></span>
			<a href="javascript:" class="dialog logi" data-target="logi" data-width="325" data-height="450" data-mask="0" data-oncomplete="pop_bg()" >登陆</a>
			<span class="logi_middle_line"></span>
			<a href="qq.html?qq=<?php echo $room['qq']; ?>" target="_blank" class="sign" data-target="sign" data-width="325" data-height="510" data-mask="0" data-oncomplete="pop_bg()">注册</a>
			<?php endif; ?>
			<a href="desktop/" class="tape_l">保存到桌面</a>
			<a href="javascript:" onclick="AddFavorite(window.location,document.title)" class="tape_r">收藏链接</a>
		</div>
	</div>
	<div class="video_online">
		<?php echo str_replace('{name}', $this->session->userdata('name'), $room['video']); ?>
	</div>
	<div class="video_active">
		<ul class="video_active_imgs">
			<!-- <li class="li_acactive"><a href="http://www.gdyy99.com/spread/gold_plan/" target="_blank" class="active_a"><img src="<?php echo $tpl; ?>images/active/img01.jpg" width="690"></a></li> -->
			<li class="li_acactive"><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/201508261.png" width="690"></a></li>
			<li><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/201508262.jpg" width="690"></a></li>
			<li><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/img0723.jpg" width="690"></a></li>
			<li><a href="http://www.gdyy99.com/integral_prize"  target="_blank" class="active_a"><img src="<?php echo $tpl; ?>images/active/img0810.jpg" width="690"></a></li>
			<li><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/img1508041.jpg" width="690"></a></li>
			<li><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/img1508042.jpg" width="690"></a></li>
			<li><a href="javascript:" class="active_a"><img src="<?php echo $tpl; ?>images/active/img0731.png" width="690"></a></li>
			<!-- <li><a href="http://www.gdyy99.com/spread/gold_plan/" target="_blank" class="active_a"><img src="<?php echo $tpl; ?>images/active/img01.jpg" width="690"></a></li> -->
		</ul>
		<ol class="video_active_btns">
			<li class="btns_current"></li>
			<li class="btn_simle"></li>
			<li></li>
			<li class="btn_simle"></li>
			<li></li>
			<li class="btn_simle"></li>
			<li></li>
		</ol>
		<div class="weixin_hovering">
			<div class="weixin_screen"></div>
			<div class="weixin_look"></div>
			<img src="<?php echo $tpl; ?>images/weixin/weixin_bar.png" alt="" >
			<div class="weixin_bg"></div>
		</div>
	</div>
</div>
