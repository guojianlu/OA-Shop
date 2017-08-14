<?php if (!defined('THINK_PATH')) exit();?><!doctype html>

<!--
    2017-4-26
-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册审核</title>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/css.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css">
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/Public/Admin/img/coin02.png" /><span><a >首页</a>&nbsp;-&nbsp;<a
					href="#">会员管理</a>&nbsp;-</span>&nbsp;会员查询
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						<a href="javascript:;" class="look"><button class="button">查询所有</button></a>
						<label onclick="noreg()"><input type="radio"  name="styleshoice1" />&nbsp;未审核</label>
						<label onclick="overg()"><input type="radio"  name="styleshoice1" />&nbsp;已通过</label>
						<label onclick="nottg()"><input type="radio"  name="styleshoice1" />&nbsp;未通过</label>
					</div>
					<div class="cfD">
							<form action="<?php echo U('search');?>" method="post">
							<input name="id" class="addUser" type="text" placeholder="输入用户编号/ID" />
							<button class="button" >搜索</button>
							
							<a class="addA addA1" onclick="addhy()">添加会员+</a></form>
						</div>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
							<td width="80px" class="tdColor">用户号</td>
							<td width="80px" class="tdColor">推荐人</td>
							<td width="100px" class="tdColor">昵称</td>
							<td width="100px" class="tdColor">姓名</td>
							<td width="140px" class="tdColor">电话</td>
							<td width="90px" class="tdColor">注册金额</td>
							<td width="180px" class="tdColor">银行账号</td>
							<td width="150px" class="tdColor">所属团队</td>
							<td width="180px" class="tdColor">注册时间</td>
							<td width="100px" class="tdColor">身份状态</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($vol["uid"]); ?></td>
							<td><?php echo ($vol["upid"]); ?></td>
							<td><?php echo ($vol["umember_name"]); ?></td>
							<td><?php echo ($vol["uname"]); ?></td>
							<td><?php echo ($vol["utel"]); ?></td>
							<td><?php echo ($vol["rid"]); ?></td>
							<td><?php echo ($vol["ucard"]); ?></td>
							<td><?php echo ($vol["tname"]); ?></td>
							<td><?php echo ($vol["uregister_time"]); ?></td>
							<td><?php if($vol["sid"] === 1): ?>待审核
								<?php elseif($vol["sid"] === 2): ?>准股东
								<?php elseif($vol["sid"] === 3): ?>股东
								<?php elseif($vol["sid"] === 4): ?>执行董事
								<?php elseif($vol["sid"] === 5): ?>公司
								<?php else: ?>未通过<?php endif; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
						
					</table>
					<br>
					<div>总人数：<?php echo ($count); ?>&nbsp;&nbsp;未审核人数：<?php echo ($count_noreg); ?>&nbsp;&nbsp;已通过人数：<?php echo ($count_overg); ?>&nbsp;&nbsp;未通过人数：<?php echo ($count_nottg); ?></div>
					<div class="paging"><?php echo ($show); ?></div>

				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>
</body>

<script type="text/javascript">
	$(function(){
		//通过审核按钮的点击事件
		$('.look').on('click',function(){
			//事件处理程序
			window.location.href = '/index.php/Admin/User/look';
			
		})
	});
	function noreg(){
		//alert("未审核");
		window.location.href = '/index.php/Admin/User/noreg';
	}
	function overg(){
		//alert("已通过");
		window.location.href = '/index.php/Admin/User/overg';
	}
	function nottg(){
		//alert("未通过");
		window.location.href = '/index.php/Admin/User/nottg';
	}
	function addhy(){
		window.parent.frames[0].location.href="<?php echo U('User/useregister');?>";
	}
	function search(){
		window.location.href = '/index.php/Admin/User/search';
	}

	$(function(){
	//搜索按钮的点击事件
	$('.button').on('click',function(){
		$('form').submit();
	})
});
</script>
</html>