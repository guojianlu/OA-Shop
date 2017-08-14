<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>二级密码验证</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/erji_mima_yanzhen.css">
</head>
<body>
<div id="content">

    <form action="<?php echo U('erji_mima_yanzhen');?>" method="post">

        <div class="nav">
            <div class="back" onclick="back()">&nbsp; 返回</div>
        </div>

        <!--把回退的次数隐藏传递给控制器-->
        <input id="count" name="count" type="hidden">

        <div class="list">
            <span>二级密码</span> <input name="utwo_pwd" type="password">
        </div>
        <div class="queding">确&emsp;定</div>

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
        //判断验证是否成功
        var flag = parseInt($('.flag').html());
        if(flag == 2){
            window.parent.location.href = "/index.php/Home/User/ti_cash";
        }else if(flag == 1){
            window.alert("密码错误,请重新输入");
        }else{

        }


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