<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>提现查询</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/cash_cx.css">
</head>
<body>
<div id="content">
    <div class="nav">
        <div class="back" onclick="javascript:history.back();">&nbsp; 返回</div>
    </div>
    <div class="list">
        <span>提现状态</span> <input id="input1" readonly value="<?php echo ($cash_state); ?>" type="text">
    </div>
    <div class="list">
        <span>当前余额</span> <input id="input2" readonly value="<?php echo ($pbalance); ?>" type="text">
    </div>
</div>

</body>
</html>