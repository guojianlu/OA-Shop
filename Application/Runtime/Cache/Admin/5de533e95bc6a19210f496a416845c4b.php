<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部</title>
<link rel="stylesheet" type="text/css" href="../../../../Public/css/public.css" />
<script type="text/javascript" src="../../../../Public/js/jquery.min.js"></script>
<script type="text/javascript" src="../../../../Public/js/public.js"></script>
</head>

<body>
	<!-- 头部 -->
	<div class="head">
		<div class="headL">
			<img class="headLogo" src="../../../../Public/img/head.png" />
		</div>
		<div class="headR">
			<p class="p1">
				欢迎：<?php echo (session('umember_name')); ?> 
			</p>
			<p class="p2">
				<a href="#" class="resetPWD">修改密码</a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="openwin()" target="_blank" class="goOut">退出</a>
			</p>
		</div>
		<!-- onclick="{if(confirm(&quot;确定退出吗&quot;)){return true;}return false;}" -->
	</div>

	<div class="closeOut">
		<div class="coDiv">
			<p class="p1">
				<span>X</span>
			</p>
			<p class="p2">确定退出当前用户？</p>
			<P class="p3">
				<a class="ok yes" href="#">确定</a><a class="ok no" href="#">取消</a>
			</p>
		</div>
	</div>


<script type="text/javascript">
    //退出登录
    function openwin(){
        //window.open("#","是否退出？",width=200,height=200);
        //alert('是否退出登录？');window.location.href = "/index.php/Admin/Login/logout";
        var r=confirm('是否退出登录？');
        if(r==true){
            window.parent.frames[0].location.href = "/index.php/Admin/Login/logout";
        }
    }
     
</script>


</body>
</html>
<!--
本代码由热心网友上传，js代码网收集并编辑整理;
请尊重他人劳动成果;
转载请保留js代码链接 - www.jsdaima.com
-->