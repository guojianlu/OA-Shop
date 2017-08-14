<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>团队业绩</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/team_cx.css">
</head>
<body>
<div id="content">
    <div class="nav">
        <div class="back" onclick="javascript:history.back();">&nbsp; 返回</div>
    </div>

    <ul class="list">
        <li>注册金额&emsp;<span><?php echo ($register_sum); ?></span></li>
        <li>返单金额&emsp;<span><?php echo ($fandan_sum); ?></span></li>
        <li> &nbsp;总&emsp;和&emsp;&nbsp; <span><?php echo ($register_sum + $fandan_sum); ?></span></li>
    </ul>
</div>
</body>
</html>