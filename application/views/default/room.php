<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="E=Edge,chrome=1" >
	<title><?php echo $room['title']; ?></title>
	<meta name="description" content="<?php echo $room['description']; ?>" />
	<meta name="keywords" content="<?php echo $room['keywords']; ?>" />
	<base target="_self" href="<?php echo base_url(); ?>">
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/reset.css">
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/index.css">
	<script src="<?php echo $tpl; ?>js/jquery-1.11.2.min.js"></script>
	<style>
	body{ filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo $tpl; ?><?php echo $tpl; ?>images/body_bg.jpg", sizingMethod=scale);width:100%;height:100%;  
}
	</style>

</head>
<script>
var base = {url:$('base').attr('href'), tpl:"<?php echo $tpl; ?>"}
var MID = <?php echo $this->session->userdata('mid'); ?>;
var LOGIN = <?php echo (int)$this->session->userdata('is_login'); ?>;
var GID = <?php echo $this->session->userdata('gid'); ?>;
var USERNAME = "<?php echo $this->session->userdata('name'); ?>";
var STARTTIME = <?php echo str_pad(str_replace('.', '', microtime(true)),14,0); ?>;
var SCROLL = 1;
</script>
<body onresize="resize()" >
	<?php include('component/header.php'); ?>
	<!--contain-->
	<div class="contain">
		<!--aside-->
		<?php include('component/left.php'); ?>
		<!--section-->
		<div class="section">
			<?php include('component/middle.php'); ?>
			<?php include('component/right.php'); ?>
		</div>
	</div>

<!-- 弹出框 -->
<?php include('component/wrap.php'); ?>
<script src="<?php echo $tpl; ?>js/main.js"></script>
<script src="<?php echo $tpl; ?>js/resize.js"></script>
<?php echo $room['statistics']; ?>
</body>
</html>