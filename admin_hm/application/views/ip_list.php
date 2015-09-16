<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">IP限制</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="height: 55px;">
				<form class="" method="POST" action="ip/ip_save">
					<div class="col-lg-4 col-md-8">
						<div class="input-group">
							<input type="text" name="ip" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="submit"><i class="fa fa-fw fa-ban"></i>屏蔽该IP</button>
							</span>
						</div>
					</div>
				</form>
                <form>
                    <div class="col-lg-4 col-md-8">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control">
							<span class="input-group-btn">
								<a class="btn btn-info" onclick="ip_search()"><i class="fa fa-fw fa-search"></i>查找IP</a>
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
								<th>IP/Name</th>
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

<script src="js/modal.js"></script>
<!-- Modal -->
<div class="mytan modal fade col-lg-4" id="myModal" tabindex="-1" role="dialog" style="overflow-y: auto;top: 40%;left: 30%;">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="success">
            <td>Name</td>
            <td>IP</td>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script type="text/javascript">

function ip_del(id){
	$.post(admin.url+'ip/ip_del/'+id,'',function (){
		location.reload();
	})
}
var jso;
function ip_search(){
    var name = $('input[name=name]').val();
    $.post(admin.url+'ip/ip_search',{name:name},function (res){
        console.log(res);
        if(res == '[]')
        {
            return;
        }
        var j = "(" + res + ")"; // 用括号将json字符串括起来
        jso = eval(j); // 返回json对象
        for(var i in jso)
        {
            if(jso[i].ip == null)
            {
                jso[i].ip = '';
            }
            $('.mytan tbody').html("<tr class='success'><td>"+name+"</td> <td>"+jso[i].ip+"</td> </tr>");
        }
        console.log(j[0].ip);
        $('.mytan').modal('show');
    })
}
</script>