<style>.data_list{word-break: break-all;}</style>
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">聊天审核<!-- <span id="online_peo">(当前在线人数：<b id="peo">0</b>)</span> --></h3>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<form class="row member_notice">
					<div class="col-lg-6">
						<textarea class="form-control" name="content" id="content" rows="1"></textarea>
					</div>
					<div class="col-lg-2">
						<select name="send" id="send" class="form-control">
							<?php foreach($member_admin as $v): ?>
							<option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-lg-2">
						<select name="rid" id="rid" class="form-control">
							<?php foreach($rid_list as $v): ?>
							<option value="<?php echo $v; ?>"><?php echo $v; ?>房间</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-lg-2">
						<button type="button" class="btn btn-primary" onclick="send_member_notice()">发送</button>
					</div>
				</form>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th><input class="selectall" type="checkbox" onchange="selectall();"></th>
								<th style="width:65px;">房间ID</th>
								<th>内容</th>
								<th style="width:145px;">发布人</th>
								<th style="width:160px;">发布时间</th>
								<th style="width: 218px;">操作</th>
							</tr>
						</thead>
						<tbody class="data_list">
						<?php
						foreach($chat_list as $k => $v):
						$de_v = json_decode($v, true);
						?>
							<tr class="list_<?php echo $k; ?>">
								<td><input type="checkbox" name="examine[]" value="<?php echo $k; ?>" data-rid="<?php echo $de_v['rid']; ?>"></td>
								<td><?php echo $de_v['rid']; ?></td>
								<td><?php echo $de_v['content']; ?></td>
								<td><?php echo $de_v['name']; ?></td>
								<td><?php echo $de_v['time']; ?></td>
								<td>
									<button type="button" class="btn btn-primary" onclick="release(<?php echo $k; ?>,'<?php echo $de_v['rid']; ?>')">发布</button>
									<button type="button" class="btn btn-danger" onclick="ip_ban('<?php echo $de_v['name']; ?>')">屏蔽IP</button>
									<button type="button" class="btn btn-danger" onclick="del('<?php echo $k; ?>', '<?php echo $de_v['rid']; ?>')">删除</button>
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<button type="button" class="btn btn-primary" onclick="select_toggle()">全选</button>
					<button type="button" class="btn btn-primary" onclick="batch_release()">批量发布</button>
					<button type="button" class="btn btn-primary" onclick="bath_del()">批量删除</button>
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

$(function (){
	get_chat_data();
	// autoload_online();
})

function get_chat_data(){
    //如果函数没有参数，默认0
	var score = arguments[0] ? arguments[0] : 0;
	$.ajax({
		url : admin.url+'examine/get_chat_data',
		type : 'POST',
		dataType: "json",
		cache : false,
		timeout : 20000,
		data : {score : score},
		success : function (result){
			get_chat_data(result.score);
			deal_data(result.data_list);
		},
		error : function (XMLHttpRequest, textStatus){
            //没有获取到数据，如果超时就调用自身
			if(textStatus == 'timeout') get_chat_data(score);
			else setTimeout(get_chat_data(score), 3000);
		}
	})
}

function deal_data(data_list){
	var html = '';
	for(var i in data_list){
		var data = $.parseJSON(data_list[i]);
		html += '<tr class="list_'+i+'"><td><input type="checkbox" name="examine[]" value="'+i+'" data-rid="\''+data.rid+'\'"></td><td>'+data.rid+'</td><td>'+data.content+'</td><td>'+data.name+'</td><td>'+data.time+'</td><td><button type="button" class="btn btn-primary" onclick="release('+i+',\''+data.rid+'\')">发布</button><button type="button" class="btn btn-danger" onclick="ip_ban(\''+data.name+'\')">屏蔽IP</button><button type="button" class="btn btn-danger" onclick="del('+i+', \''+data.rid+'\')">删除</button></td></tr>';
	}
	$('.data_list').append(html);
}
	
function selectall(){
	$('input[name^=examine]').attr('checked', $('.selectall').is(':checked'));
}

function select_toggle(){
	var status = $('.selectall').is(':checked');
	if(status) status = false;
	else status = true;
	$('input[name^=examine], .selectall').attr('checked', status);
}

function del(id,rid){
	$.post(admin.url+'examine/del',
	{id:id,rid:rid},
	function (){
		$('.list_'+id).remove();
	})
}

function bath_del(){
	var examine = $('input[name^=examine]:checked');
	var ids = new Array();
	var rids = new Array();
	var len = examine.length;
	for(var i = 0; i < len; i++){
		ids.push($(examine[i]).val());
		rids.push($(examine[i]).data('rid'));
		$('.list_'+$(examine[i]).val()).remove();
	}
	$.post(admin.url+'examine/del',
	{id:ids, rid:rids},
	function (){})
}

/*
* 发布未审核记录
* */
function release(id,rid){
	$.post(admin.url+'examine/release',
	{id:id,rid:rid},
	function (){
		$('.list_'+id).remove();
	})
}

function batch_release(){
	var examine = $('input[name^=examine]:checked');
	var ids = new Array();
	var rids = new Array();
	var len = examine.length;
	for(var i = 0; i < len; i++){
		ids.push($(examine[i]).val());
		rids.push($(examine[i]).data('rid'));
		$('.list_'+$(examine[i]).val()).remove();
	}
	$.post(admin.url+'examine/release',
	{id:ids, rid:rids},
	function (){})
}

function ip_ban(name){
	if(confirm('确认屏蔽该用户IP?')){
		$.post(admin.url+'examine/ip_ban',
		{name:name},
		function (res){
			alert('屏蔽成功');
		})
	}
}

function autoload_online(){
	$.ajax({
		url : admin.url+'examine/get_online_peo',
		type : 'get',
		cache : false,
		success : function (data){
			$("#peo").html(data);
			setTimeout(autoload_online, 1000*30);
		},
		error : function (XMLHttpRequest, textStatus){
			setTimeout(autoload_online, 1000*30);
		}
	})
}

function send_member_notice(){
	var content = $.trim($('#content').val());
	var send = $('#send option:selected').val();
	if(content == ''){
		alert('请输入要发送的内容');
		return;
	}
	if(send == undefined){
		alert('请先添加巡管账号再发送');
		return;
	}

	$.post(admin.url+'examine/send_member_notice',
	$('.member_notice').serialize(),
	function (){
		// alert('发送成功');
		$('#content').val('');
	})
}

</script>