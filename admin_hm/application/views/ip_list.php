<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">IP限制</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<form class="row" method="POST" action="ip/ip_save">
					<div class="col-lg-4 col-md-8">
						<div class="input-group">
							<input type="text" name="ip" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="submit"><i class="fa fa-fw fa-ban"></i>屏蔽该IP</button>
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
								<th>IP</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($ip_list as $v): ?>
							<tr>
								<td><?php echo $v['ip']; ?></td>
								<td>
									<button type="button" class="btn btn-danger" onclick="ip_del(<?php echo $v['id'];?>)">删除</button>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
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

function ip_del(id){
	$.post(admin.url+'ip/ip_del/'+id,'',function (){
		location.reload();
	})
}

</script>