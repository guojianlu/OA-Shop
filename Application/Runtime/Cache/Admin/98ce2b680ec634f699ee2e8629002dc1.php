<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-5-2
    修改密码界面
-->

<html>
<head>
<meta charset="utf-8">
<title>修改密码</title>
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
            href="#">系统管理</a>&nbsp;-</span>&nbsp;修改密码
        </div>
      </div>
      <div class="cfD">
        <form action="<?php echo U('updatepwd');?>" method="post">
        	<table width="400">
              <tr>
                <td>
                    <table width="400">
                        <tr>
                          <td align="right" width="150"><p class="f1">原始密码&nbsp;</p></td>
                          <td><input name="yuone_pwd" size="10" type="text" class="userinput"></td>
                          
                        </tr>
                        <tr>
                          <td align="right" width="150"><p class="f1">新密码&nbsp;</p></td>
                          <td><input name="uone_pwd" size="10" type="text" class="userinput"></td>
                        </tr>
                        <tr>
                          <td align="right" width="150"><p class="f1">验证密码&nbsp;</p></td>
                          <td><input name="yzpwd" size="10" type="text" class="userinput"></td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td align="center"><input name="" type="submit" value="修改" class="userbtn"></td>
              </tr>
          </table>
        </form>
      </div>
	</div>
</div>
</body>
</html>