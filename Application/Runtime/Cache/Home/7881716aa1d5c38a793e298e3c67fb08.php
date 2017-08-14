<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/geren.css">
</head>
<body>
<div id="content">
    <ul class="list">
        <li onclick="cash_sq()">提现申请 <span></span></li>
        <li onclick="cash_cx()">提现查询 <span></span></li>
        <li onclick="ward_cx()">个人业绩 <span></span></li>
        <li onclick="team_cx()">团队业绩 <span></span></li>
        <li class="xiugai" onclick="change()">个人资料修改 <span></span></li>
        <li class="logout" onclick="logout()">退&emsp;出</li>
    </ul>
</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    //提现查询
    function cash_cx() {
        var today = new Date();
        var day = today.getDate();
        if(day >5 && day < 25){
            window.parent.location.href = "/index.php/Home/User/cash_cx";
        }else{
            window.alert("现在不能查询");
        }
    }

    //个人业绩查询
    function ward_cx() {
        window.parent.location.href = "/index.php/Home/User/ward_cx";
    }

    //团队业绩查询
    function team_cx() {
        window.parent.location.href = "/index.php/Home/User/team_cx";
    }


    //修改个人资料
    function change() {
        window.parent.location.href = "/index.php/Home/User/change_personal_data";
    }
    //提现申请
    function cash_sq() {
        var today = new Date();
        var day = today.getDate();
        if(day > 5 && day <29){
            window.parent.location.href = "/index.php/Home/User/cash_sq";
        }else{
            window.alert("现在不能提现");
        }

    }
    //退出当前帐户
    function logout() {
        var r = window.confirm("您确定要退出当前账号吗?");
        if(r == true){
            window.location.href = "<?php echo U('User/logout');?>";
        }else{
            window.location.href = "<?php echo U('User/geren');?>";
        }

    }
    //    $(function () {
    //        $('.xiugai').on('click',function () {
    //            window.location.href = "/index.php/Home/User/change_personal_data";
    //        })
    //
//    })
</script>
</html>