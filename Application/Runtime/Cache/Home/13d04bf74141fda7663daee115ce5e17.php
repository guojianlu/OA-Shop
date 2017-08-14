<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人业绩查询</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/ward_cx.css">
</head>
<body>
<div id="content">
    <div class="nav">
        <div class="back" onclick="back()">&nbsp; 返回</div>
    </div>
    <form action="<?php echo U('User/ward_cx');?>" method="post">
        <!--把回退的次数隐藏传递给控制器-->
        <input id="count" name="count" type="hidden">

        <div class="list">
            <span>选择年份</span>
            <select name="year" id="year" style="width: 140px;height: 30px;font-size: 22px;border-radius: 4px; border: solid 2px #6193da;margin-left:10px;padding-left:20px;color: #6193da">
                <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['Y']); ?>"><?php echo ($vo['Y']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>

    <div class="list">
        <span>选择月份</span>
        <select name="month" id="month" style="width: 140px;height: 30px;font-size: 22px;border-radius: 4px; border: solid 2px #6193da;margin-left:10px;padding-left:20px;color: #6193da">
        <option value="01">一月份</option>
        <option value="02">二月份</option>
        <option value="03">三月份</option>
            <option value="4">四月份</option>
            <option value="5">五月份</option>
            <option value="6">六月份</option>
            <option value="7">七月份</option>
            <option value="8">八月份</option>
            <option value="9">九月份</option>
            <option value="10">十月份</option>
            <option value="11">十一月</option>
            <option value="12">十二月</option>
    </select>
    </div>

    </form>
    <div class="list">
        <span>注册奖金</span> <input readonly value="<?php echo ($result_zhuce); ?>" type="text">
    </div>
    <div class="list">
        <span>返单奖金</span> <input  readonly value="<?php echo ($result_fandan); ?>" type="text">
    </div>
    <div class="list">
        <span>分红奖金</span> <input readonly value="<?php echo ($result_ward); ?>" type="text">
    </div>
    <div class="queding">
        确&emsp;定
    </div>
</div>
<!--从控制器中返回来的回退次数-->
<div id="bbb" style="display: none"><?php echo ($count); ?></div>

</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">

    var count = 1;

    function back() {
        var num  = parseInt($('#bbb').html());
        var backnum = -num;
//        window.alert(backnum);
       // var num = <?php echo ($count); ?>;
        //window.alert(num);
       // var backnum = -num;
//        window.alert(backnum);
        if(num){
            history.go(backnum);
        }else{
            history.back();
        }
   //   window.parent.location.href = "<?php echo U('User/geren');?>";
  //     window.location.href = "<?php echo U('User/geren');?>";
    }
    // jquery代码
    $(function () {
        //给登录按钮绑定点击按钮
        $('.queding').on('click',function () {
            if( $('#bbb').html()){
                count += parseInt($('#bbb').html());
            }else{
                count += count;
            }
//            window.alert(count);
            var year_select = $('#year').val();
            var today = new Date();
            var year_real = today.getFullYear();
            var month_select = $('#month').val();
            var month_real = today.getMonth() + 1;
            if(year_real < year_select){
                window.alert("现在还不能查询");
            }else{
                if(month_real < month_select){
                    window.alert("现在还不能查询");
                }else{
                   $('#count').val(count);
//                    window.alert($('#count').val());
                   $('form').submit();
                }
            }

        })

        })
</script>

</html>