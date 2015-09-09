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
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/index.css" >
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/dialog.css">
	<link rel="stylesheet" href="<?php echo $tpl; ?>css/pop.css">
	<script src="<?php echo $tpl; ?>js/jquery-1.11.2.min.js"></script>
	<script src="<?php echo $tpl; ?>js/dialog.js"></script>
	<script src="<?php echo $tpl; ?>js/jquery.cookie.js"></script>
</head>

<body onresize="resize()">
<script>
var base = {url:$('base').attr('href'), tpl:"<?php echo $tpl; ?>"}
var MID = <?php echo $this->session->userdata('mid'); ?>;
var LOGIN = <?php echo (int)$this->session->userdata('is_login'); ?>;
var GID = <?php echo $this->session->userdata('gid'); ?>;
var USERNAME = "<?php echo $this->session->userdata('name'); ?>";
var STARTTIME = <?php echo str_pad(str_replace('.', '', microtime(true)),14,0); ?>;
var SCROLL = 1;
var RID = <?php echo '"'.$rid.'"'; ?>;
var COLOR = 'yellow';
</script>
<div class="all">
<?php include 'component/middle.php';?>
<?php include 'component/left.php';?>
<?php include 'component/right.php';?>
<?php include 'component/wrap.php';?>
<div class="foot">分析师所发表言论只代表个人观点，仅供参考，投资有风险，入市需谨慎。</div>	
</div>
<script src="<?php echo $tpl; ?>js/common.js"></script>
<div style="display:none;"><?php echo $room['statistics']; ?></div>
</body>
</html>