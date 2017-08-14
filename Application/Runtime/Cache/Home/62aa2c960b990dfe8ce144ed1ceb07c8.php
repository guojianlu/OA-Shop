<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>提现查询</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/ti_cash.css">
</head>
<body>
<div id="content">
    <div class="nav">
    <div class="back" onclick="back()">&nbsp; 返回</div>
    </div>
        <ul class="list">
            <li>当前余额  &nbsp;<input id="input1" readonly name="pbalance" value="<?php echo ($pbalance); ?>" type="text"></li>
            <form action="<?php echo U('ti_cash');?>" method="post">
            <li>提现金额&nbsp;&nbsp;<input id="input2"  name="cash_money" type="text"></li>
            <li class="all">全部提现</li>
            <li class="queding">确&emsp;定</li>
                <!--把回退的次数隐藏传递给控制器-->
                <input id="count" name="count" type="hidden">

            </form>
        </ul>

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
        num = num + 1;
        var backnum = -num;
        if(num){
            history.go(backnum);
        }else{
            history.go(-2);
        }

    }

    // jquery代码
    $(function () {
        //判断提现是否提交成功
        var flag = parseInt($('.flag').html());
        if(flag == 2){
            window.alert("提交成功");
        }else if(flag == 1){
            window.alert("提交失败");
        }else{

        }

        //给登录按钮绑定点击按钮
        $('.queding').on('click',function () {
            var in_money = $('#input2').val();
           if(in_money == '' || in_money == 0 ){
               window.alert("提现金额不能为空");
           }else{
               if( $('#bbb').html()){
                   count += parseInt($('#bbb').html());
               }else{
                   count += count;
               }
               $('#count').val(count);
               $('form').submit();
           }

        })

        //全部提现
        $('.all').on('click',function () {
             var all = $('#input1').val();
            $('#input2').val(all);
        })

    })
</script>

</html>