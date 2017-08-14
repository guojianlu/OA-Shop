<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-5-5
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>奖金结算</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/Public/Admin/img/coin02.png" /><span><a>首页</a>&nbsp;-&nbsp;<a
					href="#">奖金管理</a>&nbsp;-</span>&nbsp;结算当月
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						<a href="javascript:;" class="pass_tx"><button class="button">结算奖金</button></a>
					</div>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
							<td width="80px" class="tdColor">序号</td>
							<td width="140px" class="tdColor">用户编号</td>
							<td width="120px" class="tdColor">奖金金额</td>
							<td width="180px" class="tdColor">结算时间</td>
							<td width="120px" class="tdColor">奖金类型</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($data2)): $i = 0; $__LIST__ = $data2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($vol["bid"]); ?></td>
							<td><?php echo ($vol["uid"]); ?></td>
							<td><?php echo ($vol["bonus_money"]); ?></td>
							<td><?php echo ($vol["bonus_time"]); ?></td>
							<td><?php if($vol["bonus_type"] === 1): ?>注册奖金
								<?php elseif($vol["bonus_type"] === 2): ?>返单奖金
								<?php elseif($vol["bonus_type"] === 3): ?>股东分红
								<?php else: ?>董事分红<?php endif; ?>
							</td>
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
		$('.pass_tx').on('click',function(){
			//
			
			//带着参数跳转到pass方法
			window.location.href = '/index.php/Admin/Calculate/time_bonus';
			//console.log(id);
			
		})
	});

	
</script>
</html>