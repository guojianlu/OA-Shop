<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-4-24
-->

<html>
<head>
<meta charset="utf-8">
<title>后台登录</title>
<link rel="stylesheet" type="text/css" href="../../../../Public/css/login.css">

</head>

<body>
<div align="center">
    <br><br><br>
  <p class="z1">结算系统  后台登录</p>
</div>
<div align="center">
<div class="dl1">
    <div >
    	<div class="c1">
        	<br/>
       		<p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号登录</p><br/><br/>
        </div>
        
    </div>
    <div class="c2">
        <form action="<?php echo U('checkLogin');?>" method="post">
    	<div class="dl2">
            <div class="k1">
              <input type="text" name="uid" class="z2" placeholder="请输入管理员账号">
            </div>
            <div>
                <input type="password" name="uone_pwd" class="z2" placeholder="请输入管理员密码">
            </div>
            <div>
                <input class="an" type="submit" name="submit" value="   登   录   ">
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
</html>