<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>返单</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/change_personal_data.css">
</head>
<body>
<div id="content">
    <div class="nav">
        <div class="back" onclick="back()">&nbsp; 返回</div>
    </div>
    <form action="<?php echo U('change_personal_data');?>" method="post">

        <!--把回退的次数隐藏传递给控制器-->
        <input id="count" name="count" type="hidden">

        <ul class="list">
            <li>昵&emsp;称 &nbsp;&emsp;<input value="<?php echo ($data['umember_name']); ?>" required name="umember_name" type="text"></li>
            <li>姓&emsp;名 &nbsp;&emsp;<input value="<?php echo ($data['uname']); ?>" required name="uname" type="text"></li>
            <li>电&emsp;话 &nbsp;&emsp;<input value="<?php echo ($data['utel']); ?>" required name="utel" type="tel"></span></li>
            <li>一级密码 &nbsp;<input value="<?php echo ($data['uone_pwd']); ?>" required name="uone_pwd" type="password"></span></li>
            <li>二级密码 &nbsp;<input value="<?php echo ($data['utwo_pwd']); ?>" name="utwo_pwd" type="password"></li>
            <input name="uid" value="<?php echo ($data['uid']); ?>" type="hidden">
            <li class="queding">确&emsp;定</li>
        </ul>
    </form>

    <!--修改的状态标志-->
    <div class="flag" style="display: none"><?php echo ($flag); ?></div>
    <!--从控制器中返回来的回退次数-->
    <div id="bbb" style="display: none"><?php echo ($count); ?></div>

</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">

    var count = 1;

    function back() {
        var num  = parseInt($('#bbb').html());
        var backnum = -num;
        if(num){
            history.go(backnum);
        }else{
            history.back();
        }

    }

    $(function () {
        //判断个人资料是否修改成功
        var flag = parseInt($('.flag').html());
        if(flag == 2){
            window.alert("修改成功");
        }else if(flag == 1){
            window.alert("修改失败");
        }else{

        }

        //表单提交
        $('.queding').on('click',function () {
            if( $('#bbb').html()){
                count += parseInt($('#bbb').html());
            }else{
                count += count;
            }
            $('#count').val(count);
            $('form').submit();
        })



    })
</script>
</html>