<div class="d_section">
	<div class="ds_head">
		<i class="block"></i>
		<a href="/">首页 ></a>
		<a href="user/info" >个人中心 ></a>
		<a href="javascript:" class="a_current">我的信息</a>
	</div>
	<div class="ds_contain">
		<p class="dsc_head">基本信息</p>
		<div class="inenr_dsc">
			<p ><span class="span01">用&nbsp&nbsp&nbsp户&nbsp&nbsp&nbsp&nbsp名&nbsp:</span><span class="span_c1"><?php echo $info['name']; ?></span></p>
			<p ><span class="span01">用&nbsp户&nbsp等&nbsp级：</span><span class="span_c2"><?php echo $info['gname']; ?></span></p>
			<p ><span class="span01">所&nbsp属&nbsp老&nbsp师：</span><span class="span_c2"><?php echo $info['tname']; ?></span></p>
			<p ><span class="span01">注&nbsp册&nbsp时&nbsp间：</span><span class="span_c2"><?php echo $info['re_time']; ?></span></p>
			<p ><span class="span01">最&nbsp后&nbsp登&nbsp录：</span><span class="span_c2"><?php echo $info['login_time']; ?></span></p>
			<p ><span class="span01">当&nbsp&nbsp&nbsp&nbsp前&nbsp&nbsp&nbspIP：</span><span class="span_c2"><?php echo $info['ip']; ?></span></p>
		</div>
	</div>
</div>