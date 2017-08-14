<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-4-24
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台登录</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/public.js"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead">
		<img src="/Public/Admin/img/log.png" />
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<div class="logDiv">
		<img class="logBanner" src="/Public/Admin/img/logBanner.png" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录</p>
				<p class="p2">人员登录</p>
			</div>
			<!-- 输入框 -->
			<form action="<?php echo U('checkLogin');?>" method="post">
			<div class="lgD">
				<img class="img1" src="/Public/Admin/img/logName.png" />
				<input type="text" name="uid" placeholder="输入用户名" />
			</div>
			<div class="lgD">
				<img class="img1" src="/Public/Admin/img/logPwd.png" />
				<input type="password" name="uone_pwd" placeholder="输入用户密码" />
			</div>
			
			<div class="logC">
				<a href="javascript:;" class="login"><button>登 录</button></a>
			</div>
			</form>
		</div>
	</div>
	<!-- 登录body  end -->

	<!-- 登录页面底部 -->
	<div class="logFoot">
		<p class="p1">版权所有：电子信息科学与技术</p>
		<p class="p2">沈阳理工大学</p>
	</div>
	<!-- 登录页面底部end -->

<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript">

$(function(){
	//通过审核按钮的点击事件
	$('.login').on('click',function(){
		$('form').submit();
	})
});

</body>
</html>