<?php

namespace Admin\Controller;
use Think\Controller;
class LoginotherController extends Controller{
	public function loginother(){
		$this -> display();
	}
	public function checkLoginother(){
		$post = I('post.');
		if($post['uid'] != ""){
			$model = M('User');
	        $data = $model -> where("uid = ".$post['uid'])->find();
	        if($data){
				session('uid', $post['uid']);
				?><script type="text/javascript" charset="utf8">
					alert('登录成功');window.parent.location.href="/index.php/Home/User/index";
				</script><?php
			}else{
				?><script type="text/javascript" charset="utf8">
					alert('无此账号');window.location.href="/index.php/Admin/Loginother/loginother";
				</script><?php
			}
		}else{
			?><script type="text/javascript" charset="utf8">
				alert('请输入账号');window.location.href="/index.php/Admin/Loginother/loginother";
			</script><?php
		}
		
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }

}