<?php

/*
	2017-4-28
*/
namespace Admin\Controller;
class BackController extends CommonController{
	public function back(){
		//模型实例化
		$model = M();
		//展示数据
		$data = $model -> field('t1.*,t2.uid as uid,t3.tname as tname')
					   -> table('js_trade_record as t1,js_user as t2,js_team as t3')
					   -> where('t1.uid=t2.uid and t1.tid=t3.tid and trade_type=2 and trade_state=0') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> display();
	}

	public function pass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('trade_record');
		//查询信息
		$data = $model -> field('trid,trade_state') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['trade_state']=1;
			//dump($data[$i]);
			$result = $model -> save($data[$i]);
		}
		if($result){
			?><script>
				alert('已通过审核');window.parent.frames[0].location.href="/index.php/Admin/Back/back";
			</script><?php
				//$this -> success('已通过审核',U('connoisseur'),1);
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/Back/back";
			</script><?php
		}
	}

	public function notpass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('trade_record');
		//查询信息
		$data = $model -> field('trid,trade_state') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['trade_state']=2;
			//dump($data[$i]);
			$result = $model -> save($data[$i]);
		}
		if($result){
			?><script>
				alert('未通过审核');window.parent.frames[0].location.href="/index.php/Admin/Back/back";
			</script><?php
				//$this -> success('已通过审核',U('connoisseur'),1);
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/Back/back";
			</script><?php
		}
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}