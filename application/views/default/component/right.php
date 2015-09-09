<div class="video">
	<div class="video_head">
		<span class="video_head_left">视频直播</span>
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
			<a href="javascript:" class="dialog sign" data-target="sign" data-width="325" data-height="510" data-mask="0" data-oncomplete="pop_bg()">注册</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="video_online">
		<?php echo $room['video']; ?>
	</div>
	<div class="video_active">
		<ul class="video_active_imgs">
			<li class="li_acactive"><a href="http://www.gdyy99.com/duanwu_slz/" target="_blank" class="active_a"><img src="<?php echo $tpl; ?>images/active/img01.jpg" width="690"></a></li>
			<!-- <li><a href="" class="active_a"><img src="<?php echo $tpl; ?>images/active/img02.jpg" width="690"></a></li>
			<li><a href="" class="active_a"><img src="<?php echo $tpl; ?>images/active/img03.jpg" width="690"></a></li> -->
		</ul>
<!-- 		<ol class="video_active_btns">
			<li class="btns_current"></li>
			<li class="btn_simle"></li>
			<li></li>
		</ol> -->
	</div>
</div>
