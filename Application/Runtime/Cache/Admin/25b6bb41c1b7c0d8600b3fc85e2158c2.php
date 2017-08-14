<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册审核</title>
<link rel="stylesheet" type="text/css" href="../../../../Public/css/css.css" />
<link rel="stylesheet" type="text/css" href="../../../../Public/css/style.css">
<script type="text/javascript" src="../../../../Public/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="../../../../Public/img/coin02.png" /><span><a >首页</a>&nbsp;-&nbsp;<a
					href="#">注册管理</a>&nbsp;-</span>&nbsp;注册审核
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						<a href="javascript:;" class="pass"><button class="button">通过审核</button></a>
						<a href="javascript:;" class="notpass"><button class="button">未通过审核</button></a>
					</div>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
							<td width="40px" class="tdColor tdC"> </td>
							<td width="120px" class="tdColor">用户号</td>
							<td width="120px" class="tdColor">推荐人</td>
							<td width="100px" class="tdColor">昵称</td>
							<td width="100px" class="tdColor">姓名</td>
							<td width="160px" class="tdColor">电话</td>
							<td width="100px" class="tdColor">注册金额</td>
							<td width="150px" class="tdColor">所属团队</td>
							<td width="180px" class="tdColor">注册时间</td>
						</tr>
						</thead>
						<tbody>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
							<td><input type="checkbox" class="uid" value="<?php echo ($vol["uid"]); ?>"></td>
							<td><?php echo ($vol["uid"]); ?></td>
							<td><?php echo ($vol["upid"]); ?></td>
							<td><?php echo ($vol["umember_name"]); ?></td>
							<td><?php echo ($vol["uname"]); ?></td>
							<td><?php echo ($vol["utel"]); ?></td>
							<td><?php echo ($vol["rmoney"]); ?></td>
							<td><?php echo ($vol["tname"]); ?></td>
							<td><?php echo ($vol["uregister_time"]); ?></td>
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
				<a><img src="../../../../Public/img/shanchu.png" /></a>
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

	//通过审核按钮点击事件
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
				alert("暂无数据！");window.parent.frames[0].location.href="<?php echo U('User/connoisseur');?>";
			}else{
			//去掉最后逗号
			id = id.substring(0,id.length-1);
			//带着参数跳转到pass方法
			window.location.href = '/index.php/Admin/User/pass/id/' +id;
			//console.log(id);
			}
		})
	});
	//通过按钮事件  end

	//未通过审核按钮点击事件
	$(function(){
		//通过审核按钮的点击事件
		$('.notpass').on('click',function(){
			//事件处理程序
			var idobj = $(':checkbox:checked');			//获取全部已经选中的checkbox
			var id = '';		//接收处理后的部门id值，组成id1，id2，id3...
			//循环遍历idobj对象，获取其中的每一个值
			
			for (var i = 0; i < idobj.length; i++) {
				id += idobj[i].value + ',';
			}

			if(id==""){
				alert("暂无数据！");window.parent.frames[0].location.href="<?php echo U('User/connoisseur');?>";
			}else{
			//去掉最后逗号
			id = id.substring(0,id.length-1);
			//带着参数跳转到pass方法
			window.location.href = '/index.php/Admin/User/notpass/id/' +id;
			//console.log(id);
			}
		})
	});
	//未通过按钮事件  end
</script>
</html>