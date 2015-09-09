<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<base target="_self" href="<?php echo base_url(); ?>">
	<title>会员中心-壹银财富直播室</title>
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/member.css">
</head>
<body>
<?php include('common/header.php'); ?>
<!-- down -->
<div class="down">
	<?php include('common/sidebar.php'); ?>
	<?php include $con_page.'.php';?>
</div>	
</body>
</html>