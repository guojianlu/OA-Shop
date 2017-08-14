<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-5-2
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发放奖金</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/Public/Admin/img/coin02.png" /><span><a>首页</a>&nbsp;-&nbsp;<a
					href="#">奖金管理</a>&nbsp;-</span>&nbsp;奖金发放
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						<a href="javascript:;" class="pass"><button class="button">发放</button></a>
					</div>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
							<td width="40px" class="tdColor tdC"> </td>
							<td width="80px" class="tdColor">序号</td>
							<td width="140px" class="tdColor">用户编号</td>
							<td width="120px" class="tdColor">奖金金额</td>
							<td width="180px" class="tdColor">用户账号</td>
							<td width="180px" class="tdColor">时间</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
							<td><input type="checkbox" class="tcid" value="<?php echo ($vol["tcid"]); ?>"></td>
							<td><?php echo ($vol["tcid"]); ?></td>
							<td><?php echo ($vol["uid"]); ?></td>
							<td><?php echo ($vol["cash_money"]); ?></td>
							<td><?php echo ($vol["ucard"]); ?></td>
							<td><?php echo ($vol["cash_time"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
					<div class="paging"><?php echo ($show); ?></div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="/Public/Admin/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
	// 广告弹出框
	$(".delban").click(function(){
	  $(".banDel").show();
	});
	$(".close").click(function(){
	  $(".banDel").hide();
	});
	$(".no").click(function(){
	  $(".banDel").hide();
	});
	// 广告弹出框 end

	$(function(){
		//通过审核按钮的点击事件
		$('.pass').on('click',function(){
			//事件处理程序
			var idobj = $(':checkbox:checked');			//获取全部已经选中的checkbox
			var id = '';		//接收处理后的部门id值，组成id1，id2，id3...
			//循环遍历idobj对象，获取其中的每一个值
			
			for (var i = 0; i < idobj.length; i++) {
				id += idobj[i].value + ',';
			}

			if(id==""){
				alert("暂无数据！");window.parent.frames[0].location.href="<?php echo U('Give/givemoney');?>";
			}else{
			//去掉最后逗号
			id = id.substring(0,id.length-1);
			//带着参数跳转到pass方法
			window.location.href = '/index.php/Admin/Give/pass/id/' +id;
			//console.log(id);
			}
		})
	});
</script>
</html>