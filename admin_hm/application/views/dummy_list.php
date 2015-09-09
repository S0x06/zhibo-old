<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">假人列表</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				选择房间
				<select class="form-control" name="room_id" onchange="select_room(this)" style="display:inline;width:200px;">
					<?php foreach($room_list as $v): ?>
					<option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $room_id): ?>selected<?php endif; ?>><?php echo $v['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form id="dummy_form" class="form-horizontal col-lg-6" role="form">
					<div class="form-group">
						<label class="col-sm-2 control-label">用户名</label>
						<div class="col-sm-10">
							<input class="form-control form_name" name="name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">等级</label>
						<div class="col-sm-10">
							<select class="form-control form_gid" name="gid">
								<?php foreach($group_list as $v): ?>
								<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="button" class="btn btn-primary" onclick="save_dummy()">保存</button>
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

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th><input class="selectall" type="checkbox" onchange="selectall();"></th>
								<th>用户名</th>
								<th>等级</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($dummy_list as $v): ?>
							<tr>
								<td><input type="checkbox" name="online[]" value="<?php echo $v['id']; ?>" data-gid="<?php echo $v['gid']; ?>"></td>
								<td class="name">
									<?php echo $v['name']; ?>
									<?php if($v['is_online']): ?>
									<span style="color:red;">(已上线)</span>
									<?php else: ?>
									<span style="color:gray;">(已下线)</span>
									<?php endif; ?>
								</td>
								<td class="gname"><?php echo $v['gname']; ?></td>
								<td>
									<button type="button" class="btn btn-danger" onclick="del_dummy(<?php echo $v['id']; ?>,<?php echo $v['gid']; ?>)">删除</button>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<button type="button" class="btn btn-primary" onclick="select_toggle()">全选</button>
					<button type="button" class="btn btn-primary" onclick="dummy_online()">批量上线</button>
					<button type="button" class="btn btn-primary" onclick="dummy_offline()">批量下线</button>
				</div>
				<!-- /.table-responsive -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<script>

function select_room(obj){
	var room_id = $(obj).find('option:selected').val();
	location.href = admin.url+'dummy/dummy_list/'+room_id;
}

function save_dummy(){
	if( $('.form_name').val() == '' ){
		alert('请输入用户名');
	}else{
		$.post(admin.url+'dummy/save_dummy',
		$('#dummy_form').serialize(),
		function (data){
			data = $.parseJSON(data);
			if(data.status){
				alert('假人保存成功');
				location.reload();
			}else{
				alert(data.msg);
			}
		})
	}
}

function dummy_online(){
	var online = $('input[name^=online]:checked');
	var ids = new Array();;
	var gids = new Array();;
	var len = online.length;
	for(var i = 0; i < len; i++){
		ids.push($(online[i]).val());
		gids.push($(online[i]).data('gid'));
	}
	$.post(admin.url+'dummy/dummy_online',
	{ids:ids, gids:gids, rid:'<?php echo $room_id; ?>'},
	function (){location.reload();})
}

function dummy_offline(){
	var online = $('input[name^=online]:checked');
	var ids = new Array();;
	var gids = new Array();;
	var len = online.length;
	for(var i = 0; i < len; i++){
		ids.push($(online[i]).val());
		gids.push($(online[i]).data('gid'));
	}
	$.post(admin.url+'dummy/dummy_offline',
	{ids:ids, gids:gids, rid:'<?php echo $room_id; ?>'},
	function (){location.reload();})
}

function del_dummy(id,gid){
	if(confirm('确认删除该假人？该操作不可恢复，请谨慎操作！')){
		$.post(admin.url+'dummy/del_dummy',
		{'id': id,'gid':gid},
		function (){
			location.reload();
		})
	}
}

function selectall(){
	$('input[name^=online]').attr('checked', $('.selectall').is(':checked'));
}

function select_toggle(){
	var status = $('.selectall').is(':checked');
	if(status) status = false;
	else status = true;
	$('input[name^=online], .selectall').attr('checked', status);
}

</script>