<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport"/>
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css">
</head>
<body>
<div id="content">
    <div class="tag"></div>
    <div class="nav">
        <ul>
            <li id="shouye" onclick="a()"><a href="javascript:return false" class="shouye"></a></li>
            <li id="zhuce" onclick="b()"><a href="javascript:return false" class="zhuce"></a></li>
            <li id="zhuzhi" onclick="c()"><a href="javascript:return false" class="zhuzhi"></a></li>
            <li id="geren" onclick="d()"><a href="javascript:return false" class="geren"></a></li>
        </ul>
    </div>
    <iframe id="iframe" name="content" src="/index.php/Home/User/shouye" scrolling="no" width="350" height="557" frameborder="0"></iframe>
</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    function a() {
        window.parent.frames[0].location.href = "<?php echo U('User/shouye');?>";
    }
    function b() {
        window.parent.frames[0].location.href = "<?php echo U('User/register');?>";
    }
    function c() {
        window.parent.frames[0].location.href = "<?php echo U('Map/map');?>";
    }
    function d() {
        window.parent.frames[0].location.href = "<?php echo U('User/geren');?>";
    }

    //jquery代码
    $(function () {
        $('li').mouseenter(function () {
            $(this).css('backgroundColor','#afc4fc')
        })

        $('li').mouseleave(function () {
            $(this).css('backgroundColor','#f1f6fc')
        })

//        $('#shouye').click(function (){
//            $('#iframe').attr("src","/index.php/Home/User/shouye");
//        })
//
//        $('#zhuce').click(function (){
//           $('#iframe').attr("src","/index.php/Home/User/register");
//        })
//
//        $('#geren').click(function (){
//            $('#iframe').attr("src","<?php echo U('User/geren');?>");
//        })


    })

</script>
</html>