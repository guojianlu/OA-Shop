<?php

/*
	2017-5-2
*/
namespace Admin\Controller;

class GiveController extends CommonController{
	public function givemoney(){
		//echo "发放奖金";
		$model = M();
		//展示数据
		$data = $model -> field('t1.*,t2.uid as uid,t2.ucard as ucard')
					   -> table('js_ti_cash as t1,js_user as t2')
					   -> where('t1.uid=t2.uid and cash_state=2') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> display();
	}

	public function pass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('ti_cash');
		//查询信息
		$data = $model -> field('tcid,cash_state') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['cash_state']=3;
			//dump($data[$i]);
			$result = $model -> save($data[$i]);
		}
		if($result){
			?><script>
				alert('已发放');window.parent.frames[0].location.href="/index.php/Admin/Give/givemoney";
			</script><?php
				//$this -> success('已通过审核',U('connoisseur'),1);
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/Give/givemoney";
			</script><?php
		}
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}