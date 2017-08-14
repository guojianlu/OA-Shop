<?php

/*
	2017-4-26
	注册金额修改控制器
*/


namespace Admin\Controller;

class RegisterController extends CommonController{
	public function money(){
		$model = M('register_money');
		$data = $model -> find();
		$this -> assign('data',$data);
		$this -> display();
	}

	public function updateMoney(){
		if(IS_POST){
			$post = I('post.');
			$model = M('register_money');
			$result = $model -> save($post);
			if($result){
				//$this -> success('修改成功',U('money'),1);
				?><script>
				alert('修改成功');window.parent.frames[0].location.href="/index.php/Admin/Register/money";
				</script><?php
			}else{
				$this -> error('修改失败');
			}
		}
		

	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}