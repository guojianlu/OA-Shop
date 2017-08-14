<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/shouye.css">
</head>
<body>
<div id="content">
    <ul class="list">
        <li>编号 &emsp; <span><?php echo ($data['uid']); ?></span></li>
        <li>昵称 &emsp;<span><?php echo ($data['umember_name']); ?></span></li>
        <li>姓名 &emsp;<span><?php echo ($data['uname']); ?></span></li>
        <li>级别 &emsp;<span><?php echo ($data_sid); ?></span></li>
        <li>注册人数<span class="aaa"><?php echo ((isset($count ) && ($count !== ""))?($count ): 0); ?></span>金额<span class="aaa"><?php echo ((isset($sum_money ) && ($sum_money !== ""))?($sum_money ): 0); ?></span></li>
        <li>返单次数<span class="aaa"><?php echo ((isset($count_sum ) && ($count_sum !== ""))?($count_sum ): 0); ?></span>金额<span class="aaa"><?php echo ((isset($count_money ) && ($count_money !== ""))?($count_money ): 0); ?></span></li>
        <li class="fandan" onclick="fd()">我要返单</li>
    </ul>
</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    function fd() {
        window.parent.location.href = "/index.php/Home/User/fandan";
    }
//    $(function () {
//        $('.fandan').on('click',function () {
//            window.location.href="/index.php/Home/User/fandan";
//        })
//
//    })
</script>
</html>