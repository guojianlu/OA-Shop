<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>返单</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/fandan.css">
</head>
<body>
<div id="content">

<form action="<?php echo U('fandan_tj');?>" method="post">

    <div class="nav">
        <div class="back" onclick="back()">&nbsp; 返回</div>
    </div>
    <div class="list">
        <span>返单金额</span> <input class="fd_money" name="trade_money" type="text">
    </div>
    <input name="trade_time" type="hidden">
    <input name="uid" type="hidden">
    <input name="tid" type="hidden">
    <input name="upid" type="hidden">
    <input name="trade_type" value="2" type="hidden">
    <div class="queding">确&emsp;定</div>

</form>

</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    function back() {
        window.parent.location.href = "/index.php/Home/User/index";
    }

    $(function () {
        $('.queding').on('click',function () {
            var fd_money = $('.fd_money').val();
            if(fd_money == ''){
                window.alert("请先输入返单金额");
                window.parent.location.href = "/index.php/Home/User/fandan";
            }else if(fd_money == 0){
                window.alert("请输入正确的返单金额金额");
                window.parent.location.href = "/index.php/Home/User/fandan";
            }
            else{
                $('form').submit();
            }
        })
    })
</script>
</html>