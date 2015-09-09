<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">专家管理</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="specialist/specialist_list/">专家列表</a> >> <?php echo $info['id'] != -1 ? $info['name'] : '添加专家'; ?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal col-lg-10 specialist_form" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">专家名</label>
						<div class="col-sm-10">
							<input class="form-control" name="name" id="name" value="<?php echo my_echo($info['name']) ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">所属房间</label>
						<div class="col-sm-10">
							<select class="form-control" name="rid">
								<?php foreach($room_list as $v): ?>
								<option value="<?php echo $v['id']; ?>" <?php if($v['id'] == my_echo($info['rid'])): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<?php echo $info['avatar']; ?>
					<div class="form-group">
						<label for="container" class="col-sm-2 control-label">简介</label>
						<div class="col-sm-10">
							<script id="container" name="content" type="text/plain">
								<?php echo my_echo($info['content']); ?>
							</script>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
							<button type="button" class="btn btn-primary" onclick="specialist_update()">保存</button>
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

<!-- 配置文件 -->
<script type="text/javascript" src="<?php echo $site_url; ?>plugins/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo $site_url; ?>plugins/ueditor/ueditor.all.js"></script>
<!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
<script type="text/javascript" src="<?php echo $site_url; ?>plugins/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript">
var editor = UE.getEditor('container', {'initialFrameHeight' : 600});

function specialist_update(){
	$.post(admin.url+'specialist/specialist_update',
	$('.specialist_form').serialize(),
	function (){
		location.href = admin.url+'specialist/specialist_list';
	})
}

</script>