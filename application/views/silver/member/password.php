<style>
.ds_contain01{padding:90px 0 135px 280px;box-shadow:0px 0px 2px #e5dfdf;border:1px solid #e5dfdf;margin-top:10px;}
.inenr_dsc01{font-size: 12px;color:#989898;}
.inenr_dsc01 p{overflow: hidden;margin-top:23px;}
.inenr_dsc01 input{border:1px solid #989898;display: inline-block;width:140px;height:26px;padding-left:10px;line-height: 26px;float: left;}
.span02{text-align: right;display: inline-block;width:66px;line-height: 26px;display: inline-block;height:26px;float: left;}
.btn{border:1px solid #d28808; background:#ffad1e;display: inline-block;width:204px;height:30px;font-size: 14px;color:#fff;margin-top:33px;margin-left:20px;}
</style>

<div class="d_section">
	<div class="ds_head">
		<i class="block"></i>
		<a href=".">首页 ></a>
		<a href="user/info" >个人中心 ></a>
		<a href="javascript:" class="a_current">修改密码</a>
	</div>
	<form class="ds_contain01 password_form">
		<div class="inenr_dsc01">
			<p ><span class="span02">原密码: &nbsp&nbsp</span><input type="password" name="old_password"></p>
			<p ><span class="span02">新密码: &nbsp&nbsp</span><input type="password" name="password" id="password"></p>
			<p ><span class="span02">确认密码: &nbsp&nbsp</span><input type="password" id="re_password"></p>
		</div>
		<button class="btn">提 交</button>
	</form>
</div>

<script src="<?php echo $tpl; ?>js/jquery-1.11.2.min.js"></script>
<script>
	
$('.password_form').submit(function (){
	var password = $('#password').val();
	var re_password = $('#re_password').val();
	if(password == ''){
		alert("请输入新密码");
	}else if(password != re_password){
		alert("两次密码输入不一致");
	}else{
		$.post($('base').attr('href')+'user/update_password',
		$(this).serialize(),
		function (result){
			result = $.parseJSON(result);
			if(result.status){
				alert("修改密码成功，下次请使用新密码登录");
				location.reload();
			}else{
				alert(result.msg);
			}
		})
	}
	return false;
})

</script>