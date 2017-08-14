<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-4-26
    修改注册金额界面
-->

<html>
<head>
<meta charset="utf-8">
<title>注册金额</title>
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
            href="#">注册管理</a>&nbsp;-</span>&nbsp;注册审核
        </div>
      </div>
      <div class="cfD">
        <form action="<?php echo U('updateMoney');?>" method="post">
        	<table width="400">
              <tr>
                <td>
                    <table width="400">
                        <tr>
                          <td align="right" width="150"><p class="f1">注册金额&nbsp;</p></td>
                          <td><input name="" size="10" type="text" class="userinput" value="<?php echo ($data["rmoney"]); ?>" readonly></td>
                          <input type="hidden" name="rid" value="<?php echo ($data["rid"]); ?>">
                        </tr>
                        <tr>
                          <td align="right" width="150"><p class="f1">修改金额&nbsp;</p></td>
                          <td><input name="rmoney" size="10" type="text" class="userinput"></td>
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