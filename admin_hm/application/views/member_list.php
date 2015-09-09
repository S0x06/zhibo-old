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
				<form class="row search_form" method="get" action="member/member_list">
					<div class="col-lg-3 col-md-6">
						<div class="input-group">
							<input type="text" name="search" class="form-control" value="<?php echo $search; ?>">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-search"></i>搜索</button>
							</span>
						</div>
					</div>
				</form>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>名称</th>
								<th>会员组</th>
								<th>老师组</th>
								<th>注册时间</th>
								<th>最近登陆</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($member_list as $v): ?>
							<tr>
								<td><?php echo $v['name']; ?></td>
								<td><?php echo $v['gname']; ?></td>
								<td><?php echo $v['tname']; ?></td>
								<td><?php echo $v['re_time']; ?></td>
								<td><?php echo $v['login_time']; ?></td>
								<td>
									<a href="member/member_edit/<?php echo $v['id']; ?>" class="btn btn-primary">编辑</a>
									<button type="button" class="btn btn-danger" onclick="member_del(<?php echo $v['id'];?>)">删除</button>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<?php echo $pagin; ?>
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

<script type="text/javascript">

function member_del(id){
	if(confirm('确认删除该会员?')){
		$.post(admin.url+'member/member_del/'+id,'',function (){
			location.reload();
		})
	}
}

</script>