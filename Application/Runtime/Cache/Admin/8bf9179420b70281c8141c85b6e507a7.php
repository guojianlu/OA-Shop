<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-5-2
    重置密码界面
-->

<html>
<head>
<meta charset="utf-8">
<title>重置密码</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css">
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/pageGroup.css" />
</head>

<body>
<div>
	<div>
      <div class="pageTop">
        <div class="page">
          <img src="/Public/Admin/img/coin02.png" /><span><a >首页</a>&nbsp;-&nbsp;<a
            href="#">会员管理</a>&nbsp;-</span>&nbsp;重置密码
        </div>
      </div>
      <div class="cfD">
        <form action="<?php echo U('resetpwd');?>" method="post">
        	<table width="400">
              <tr>
                <td>
                    <table width="400">
                        <tr>
                          <td><input name="uid" size="10" type="text" class="userinput" placeholder="请输入重置用户编号"></td> 
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td align="center"><input name="" type="submit" value="重置" class="userbtn"></td>
              </tr>
          </table>
        </form>
      </div>
	</div>
</div>
</body>
</html>