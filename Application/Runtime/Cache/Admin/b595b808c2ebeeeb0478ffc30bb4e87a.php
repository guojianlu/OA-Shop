<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-4-25
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>芙瑞施后台管理系统</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/public.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/public.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css">
</head>

<body>
<div align="center">
	<div class="w">
	<!--头部文件-->
		<div class="head">
			<div class="headL">
				<img class="headLogo" src="/Public/Admin/img/head.png" />
			</div>
			<div class="headR">
				<p class="p1">
					欢迎：<?php echo (session('umember_name')); ?> 
				</p>
				<p class="p2">
					<a href="javascript:;" onclick="updatepwd()" class="resetPWD">修改密码</a>&nbsp;&nbsp;
					<a href="javascript:;" onclick="openwin()" target="_blank" class="goOut">退出</a>
				</p>
			</div>
			<!-- onclick="{if(confirm(&quot;确定退出吗&quot;)){return true;}return false;}" -->
		</div>
	<!--中间部分-->
		<div>
			<!--left左侧部分-->
			<div class="index-left">
				<div class="container">
					<div class="leftsidebar_box">
						<a href="index" target="main">
						<div class="line">
								<img src="/Public/Admin/img/coin01.png" />&nbsp;&nbsp;首页
						</div>
						</a>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin03.png" />
								<img class="icon2" src="/Public/Admin/img/coin04.png" /> 注册管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a class="cks" href="javascript:;" target="main" onclick="money()">注册金额管理</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a class="cks" href="javascript:;" target="main" onclick="sh_user()">注册审核管理</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin05.png" />
								<img class="icon2" src="/Public/Admin/img/coin06.png" /> 审核管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a class="cks" href="javascript:;" target="main" onclick="sh_back()">返单审核</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a class="cks" href="javascript:;" target="main" onclick="ticash()">提现审核</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin17.png" />
								<img class="icon2" src="/Public/Admin/img/coin18.png" /> 奖金管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="cal()">结算当月</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="givemoney()">发放奖金</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin10.png" />
								<img class="icon2" src="/Public/Admin/img/coin09.png" /> 组织图管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="map()">组织图</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin11.png" />
								<img class="icon2" src="/Public/Admin/img/coin12.png" /> 登陆其它账号
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="loginother()">登陆其它账号</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin15.png" />
								<img class="icon2" src="/Public/Admin/img/coin16.png" /> 会员管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="look()">会员查询</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="useregister()">会员注册</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="resetpwd()">重置密码</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coin17.png" />
								<img class="icon2" src="/Public/Admin/img/coin18.png" /> 收支管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="inout()">收支管理</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
						<dl class="system_log">
							<dt>
								<img class="icon1" src="/Public/Admin/img/coinL1.png" />
								<img class="icon2" src="/Public/Admin/img/coinL2.png" /> 系统管理
								<img class="icon3" src="/Public/Admin/img/coin19.png" />
								<img class="icon4" src="/Public/Admin/img/coin20.png" />
							</dt>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" target="main" class="cks" onclick="updatepwd()">修改密码</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
							<dd>
								<img class="coin11" src="/Public/Admin/img/coin111.png" />
								<img class="coin22" src="/Public/Admin/img/coin222.png" />
								<a href="javascript:;" onclick="openwin()" class="cks">退出</a>
								<img class="icon5" src="/Public/Admin/img/coin21.png" />
							</dd>
						</dl>
					</div>
				</div>
			</div>
			<div class="index-content">
				<iframe src="/index.php/Admin/Index/main.html" width="100%" height="100%"></iframe>
			</div>
		</div>
		<div align="center">
	        <div class="logFoot">
				<p class="p1">版权所有：电子信息科学与技术</p>
				<p class="p2">沈阳理工大学</p>
			</div>
	    </div>
	</div>
</div>
	
<script type="text/javascript">
	function SetWinHeight(obj){ 
		var win=obj; 
		if (document.getElementById){ 
			if (win && !window.opera){ 
				if (win.contentDocument && win.contentDocument.body.offsetHeight) 
				win.height = win.contentDocument.body.offsetHeight+40; 
				else if(win.Document && win.Document.body.scrollHeight) 
				win.height = win.Document.body.scrollHeight+40; 
			} 
		} 
	}
    //退出登录
    function openwin(){
        //window.open("#","是否退出？",width=200,height=200);
        //alert('是否退出登录？');window.location.href = "/index.php/Admin/Login/logout";
        var r=confirm('是否退出登录？');
        if(r==true){
            window.location.href = "/index.php/Admin/Login/logout";
        }
    }
    function money(){
        window.parent.frames[0].location.href="<?php echo U('Register/money');?>";
    }
    function sh_user(){
        window.parent.frames[0].location.href="<?php echo U('User/user');?>";
    }
    function sh_back(){
        window.parent.frames[0].location.href="<?php echo U('Back/back');?>";
    }
    function ticash(){
        window.parent.frames[0].location.href="<?php echo U('Ticash/ticash');?>";
    }
    function givemoney(){
        window.parent.frames[0].location.href="<?php echo U('Give/givemoney');?>";
    }
    function map(){
        window.parent.frames[0].location.href="<?php echo U('Map/map');?>";
    }
    function loginother(){
        window.parent.frames[0].location.href="<?php echo U('Loginother/loginother');?>";
    }
    function updatepwd(){
    	window.parent.frames[0].location.href="<?php echo U('User/updatepwd');?>";
    }
    function resetpwd(){
    	window.parent.frames[0].location.href="<?php echo U('User/resetpwd');?>";
    }
    function useregister(){
    	window.parent.frames[0].location.href="<?php echo U('User/useregister');?>";
    }
    function cal(){
    	window.parent.frames[0].location.href="<?php echo U('Calculate/calculate');?>";
    }
    function inout(){
    	window.parent.frames[0].location.href="<?php echo U('Inout/inout');?>";
    }
    function look(){
    	window.parent.frames[0].location.href="<?php echo U('User/look');?>";
    }

</script>

</body>
</html>