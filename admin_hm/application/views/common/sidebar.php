<?php
$permission = $this->session->userdata('permission');
$permission = explode(',', $permission);
?>
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<?php
			if(in_array('examine', $permission) ):
			?>
			<li>
				<a href="examine"><i class="fa fa-fw fa-eye"></i>留言审核</a>
			</li>
			<?php endif; ?>
			<?php
			if(in_array('speaker', $permission) ):
			?>
			<li>
				<a href="speaker"><i class="fa fa-fw fa-eye"></i>讲课老师</a>
			</li>
			<?php endif; ?>
			<?php
			if(in_array('base', $permission) ):
			?>
			<li>
				<a href="room"><i class="fa fa-fw fa-home"></i>房间管理</a>
			</li>
			<li>
				<a href="single/page_list"><i class="fa fa-fw fa-file-text"></i>单页面管理</a>
			</li>
			<li class="<?php if($current_function == 'course'): ?>active<?php endif; ?>">
				<a href="#"><i class="fa fa-fw fa-calendar"></i>课程管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="course/curriculum"><i class="fa fa-fw fa-calendar"></i>课程表</a></li>
					<li><a href="course/teacher"><i class="fa fa-fw fa-users"></i>老师管理</a></li>
				</ul>
			</li>
			<li class="<?php if($current_function == 'specialist'): ?>active<?php endif; ?>">
				<a href="#"><i class="fa fa-fw fa-graduation-cap"></i>专家管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="specialist/specialist_edit"><i class="fa fa-fw fa-graduation-cap"></i>添加专家</a></li>
					<li><a href="specialist/specialist_list"><i class="fa fa-fw fa-list"></i>专家列表</a></li>
				</ul>
			</li>
			<li>
				<a href="upgrade/"><i class="fa fa-fw fa-level-up"></i>升级通告</a>
			</li>
			<li>
				<a href="strategy/"><i class="fa fa-fw fa-book"></i>金牌策略</a>
			</li>
			<li>
				<a href="ip/ip_list"><i class="fa fa-fw fa-ban"></i>IP限制</a>
			</li>
			<?php endif; ?>
			<?php
			if(in_array('admin', $permission) ):
			?>
			<li>
				<a href="admin"><i class="fa fa-fw fa-user"></i>管理员</a>
			</li>
			<?php endif; ?>
			<?php
			if(in_array('member', $permission) ):
			?>
			<li class="<?php if($current_function == 'member'): ?>active<?php endif; ?>">
				<a href="#"><i class="fa fa-fw fa-users"></i>会员管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="member/member_edit"><i class="fa fa-fw fa-user-plus"></i>添加会员</a></li>
					<li><a href="member/member_list"><i class="fa fa-fw fa-list"></i>会员列表</a></li>
					<li><a href="member/group"><i class="fa fa-fw fa-group"></i>会员组</a></li>
				</ul>
			</li>
			<li>
				<a href="chat"><i class="fa fa-fw fa-list"></i>聊天记录</a>
			</li>
			<li>
				<a href="dummy/dummy_list"><i class="fa fa-fw fa-male"></i>假人管理</a>
			</li>
			<?php endif; ?>
		</ul>
	<!-- /#side-menu -->
	</div>
	<!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->