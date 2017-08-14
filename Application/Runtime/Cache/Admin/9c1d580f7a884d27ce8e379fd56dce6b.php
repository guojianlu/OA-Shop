<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-5-3
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/Public/Admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">会员管理</a>&nbsp;-</span>&nbsp;会员注册
			</div>
		</div>
		<div class="page ">
			<!-- 修改密码页面样式 -->
			<form action="<?php echo U('useregister');?>" method="post">
			<div class="bacen" >
				<!--<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;用户编号ID：&nbsp;&nbsp;&nbsp;&nbsp;123</div>
				<div class="bbD">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员昵称：&nbsp;&nbsp;&nbsp;&nbsp;123456789</div>-->
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员编号
					
					<input name="uid" type="text" class="input3" id="pwd1" value="<?php echo ($id); ?>" readonly />
					<a href="javascript:;" onclick="fl()"><img width="20" height="20" src="/Public/Admin/img/sx.png"></a>
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员昵称
					<input name="umember_name" type="text" class="input3" id="pwd1" placeholder="请输入会员昵称" /> 
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;真实姓名
					<input name="uname" type="text" class="input3" id="pwd1" placeholder="请输入会员姓名" /> 
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员电话
					<input name="utel" type="text" class="input3" id="pwd1" placeholder="请输入会员电话" /> 
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行账号
					<input name="ucard" type="text" class="input3" id="pwd1" placeholder="请输入中国建设银行账号" /> 
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注册金额
					<input name="rid" type="text" class="input3" id="pwd2" value="<?php echo ($data["rmoney"]); ?>" readonly /> 
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;团队名称
					<input name="tid" type="text" class="input3" id="pwd3" placeholder="请输入团队名称" /> 
					<img class="imga" src="/Public/Admin/img/ok.png" />
					<img class="imgb" src="/Public/Admin/img/no.png" />
				</div>
				<input type="hidden" name="" value="<?php echo (date( 'Y-m-d H:i:s',$time)); ?>">
				<div class="bbD">
					<p class="bbDP">
						<input name="" type="submit" value="提交" class="btn_ok btn_yes">
						<input name="" type="reset" value="重置" class="btn_ok btn_no"> 
					</p>
				</div>
			</div>
			</form>
			<!-- 修改密码页面样式end -->
		</div>
	</div>
</body>
<script type="text/javascript">
	function checkpwd1(){
	var user = document.getElementById('pwd1').value.trim();
	 if (user.length >= 6 && user.length <= 12) {
	  $("#pwd1").parent().find(".imga").show();
	  $("#pwd1").parent().find(".imgb").hide();
	 }else{
	  $("#pwd1").parent().find(".imgb").show();
	  $("#pwd1").parent().find(".imga").hide();
	 };
	}
	function checkpwd2(){
	var user = document.getElementById('pwd2').value.trim();
	 if (user.length >= 6 && user.length <= 12) {
	  $("#pwd2").parent().find(".imga").show();
	  $("#pwd2").parent().find(".imgb").hide();
	 }else{
	  $("#pwd2").parent().find(".imgb").show();
	  $("#pwd2").parent().find(".imga").hide();
	 };
	}
	function checkpwd3(){
	var user = document.getElementById('pwd3').value.trim();
	var pwd = document.getElementById('pwd2').value.trim();
	 if (user.length >= 6 && user.length <= 12 && user == pwd) {
	  $("#pwd3").parent().find(".imga").show();
	  $("#pwd3").parent().find(".imgb").hide();
	 }else{
	   $("#pwd3").parent().find(".imgb").show();
	  $("#pwd3").parent().find(".imga").hide();
	 };
	}

	function fl(){
		window.parent.frames[0].location.href="<?php echo U('User/useregister');?>";
	}
</script>
</html>