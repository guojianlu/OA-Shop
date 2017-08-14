<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/login1.css">
</head>
<body>
<div id="content">

    <div class="list">
        <form action="<?php echo U('checkLogin');?>" method="post">
        <div class="item">
            <span>账&emsp;户</span>
            <input name="uid" type="text" placeholder="请输入编号">
            <div class="line"></div>
        </div>

        <div class="item">
            <span>密&emsp;码</span>
            <input name="uone_pwd" type="password" placeholder="请输入密码">
            <div class="line"></div>
        </div>

        <div class="item">
            <span>验证码</span>
            <input class="captcha" name="captcha" type="text" placeholder="">
            <div class="verify"><img class="verifyimg" src="/index.php/Home/Index/captcha" onclick="this.src='/index.php/Home/Index/captcha/t/'+Math.random()"></div>
        </div>

        <div class="login">登&emsp;录</div>
        <!--<div class="wangji">忘记密码</div>-->
        </form>
    </div>

</div>

</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    //jquery代码
    $(function () {
        //给登录按钮绑定点击按钮
        $('.login').on('click',function () {
            //事件处理程序
            $('form').submit();
        })
    })
</script>
</html>