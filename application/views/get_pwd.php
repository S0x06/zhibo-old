<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<script>
	var pwd = prompt('进入该房间需要密码，请输入密码!!');
	if(pwd){
		location.href = "<?php echo base_url(); ?>room/<?php echo $rid; ?>?pwd="+pwd;
	}
</script>

</body>
</html>