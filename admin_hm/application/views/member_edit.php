<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">会员管理</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="member/member_list">会员列表</a> >> <?php echo ($member_info['id'] != 0) ? '编辑会员：'.$member_info['name'] : '添加会员'; ?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal col-lg-8 member_form" role="form">
					<div class="form-group">
						<label class="col-sm-2 control-label">会员名称</label>
						<div class="col-sm-10">
							<input class="form-control" name="name" value="<?php echo my_echo($member_info['name']); ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">密码</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">会员组</label>
						<div class="col-sm-10">
							<select class="form-control" name="gid">
								<?php
								$gid = my_echo($member_info['gid'], '');
								foreach($group_list as $gv):
								?>
								<option value="<?php echo $gv['id']; ?>" <?php if($gv['id'] == $gid): ?>selected<?php endif; ?>><?php echo $gv['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">所属老师组</label>
						<div class="col-sm-10">
							<select class="form-control" name="tid">
								<option value=""></option>
								<?php
								$tid = my_echo($member_info['tid'], '');
								foreach($teacher_list as $tv):
								?>
								<option value="<?php echo $tv['id']; ?>" <?php if($tv['id'] == $tid): ?>selected<?php endif; ?>><?php echo $tv['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">手机号</label>
						<div class="col-sm-10">
							<input class="form-control" name="phone" value="<?php echo my_echo($member_info['phone']); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="hidden" name="id" value="<?php echo $member_info['id']; ?>">
							<button type="button" class="btn btn-primary" onclick="member_update()">保存</button>
							<button type="reset" class="btn btn-danger">重置</button>
						</div>
					</div>
				</form>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<script type="text/javascript">

function member_update(){
	$.post(admin.url+'member/member_update',
	$('.member_form').serialize(),
	function (data){
		data = $.parseJSON(data);
		if(data.status){
			alert('会员保存成功');
			location.href = admin.url+'member/member_list';
		}else{
			alert(data.msg);
		}
	})
}

</script>