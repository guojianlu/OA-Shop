<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录其他账号</title>
<meta name="keywords"  />
<meta name="description"  />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/loginother.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript">
/*
$(function(){
	$(".screenbg ul li").each(function(){
		$(this).css("opacity","0");
	});
	$(".screenbg ul li:first").css("opacity","1");
	var index = 0;
	var t;
	var li = $(".screenbg ul li");	
	var number = li.size();
	function change(index){
		li.css("visibility","visible");
		li.eq(index).siblings().animate({opacity:0},3000);
		li.eq(index).animate({opacity:1},3000);
	}
	function show(){
		index = index + 1;
		if(index<=number-1){
			change(index);
		}else{
			index = 0;
			change(index);
		}
	}
	t = setInterval(show,8000);
	//根据窗口宽度生成图片宽度
	var width = $(window).width();
	$(".screenbg ul img").css("width",width+"px");
});*/
$(function(){
	//通过审核按钮的点击事件
	$('.login').on('click',function(){
		$('form').submit();
	})
});
</script>

</head>

<body>

<div class="login-box">
	<h1>登录其他会员账号</h1>
	<form method="post" action="<?php echo U('checkLoginother');?>">
		<div class="name">
			<label>会员账号：</label>
			<input type="text" name="uid" id="" tabindex="1" autocomplete="off" />
		</div>
		<div class="login">
			<a href="javascript:;" class="login"><button>登录</button></a>
		</div>
	</form>
</div>

<div class="screenbg">
	<ul>
		<li><a href="javascript:;"><img src="/Public/Admin/images/0.jpg"></a></li>
		<li><a href="javascript:;"><img src="/Public/Admin/images/1.jpg"></a></li>
		<li><a href="javascript:;"><img src="/Public/Admin/images/2.jpg"></a></li>
	</ul>
</div>

</body>
</html>