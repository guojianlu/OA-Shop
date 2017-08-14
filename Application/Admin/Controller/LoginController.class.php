<?php

/*
    2017-4-25
*/

 namespace Admin\Controller;
 use Think\Controller;
 class LoginController extends Controller{
 	public function login(){
 		//显示
 		$this -> display();
 	}

 	public function log(){
 		$this -> display();
 	}
 	public function checkLogin(){
 		//接受数据
 		$post = I('post.');
 		//删除登录元素
 		unset($post['submit']);
 		//判断是否有数据
 		if($post['uid']==""){
 			$this -> error('请输入用户名...');
 		}else if($post['uone_pwd']==""){
 			$this -> error('请输入密码...');
 		}else{
 			$model = M('user');
 			//查询
 			$data = $model -> where($post) -> find();
 			//判断是否存在用户
 			if($data){
 				//用户存在，判断是否有权限
 				if($data['sid']==5){
 					//用户信息持久化保存在session中，跳转到后台首页
 					session('uid',$data['uid']);
 					session('umember_name',$data['umember_name']);
 					?><script>
					window.location.href="/index.php/Admin/Index/index";
					</script><?php
 					//$this -> success('登录成功:)',U('Index/index'),3);
 				}else{
 					//alert('登陆成功');
 					//$this -> error('您没有权限登录...');
 					?><script type="text/javascript" charset="utf8">
					alert('您没有登陆权限...');window.location.href="/index.php/Admin/Login/log";
					</script><?php
 				}
 				
 			}else{
 				$this -> error('用户名或密码错误...');
 			}
 		}

 	}

 	//退出方法
 	public function logout(){
 		//清楚session
 		session(null);
 		?><script type="text/javascript" charset="utf8">
			window.location.href="/index.php/Admin/Login/log";
		</script><?php
 		//跳转到登录页面
 		//$this -> success('退出成功',U('log'),3);
 	}

 	public function _empty(){
    	$this -> display('Empty/empty');
    }
 }