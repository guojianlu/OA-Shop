<?php

/*
	2017-4-29
*/
	
namespace Admin\Controller;

class TicashController extends CommonController{
	public function ticash(){
		//echo "提现审核";
		$model = M();
		//展示数据
		$data = $model -> field('t1.*,t2.uid as uid')
					   -> table('js_ti_cash as t1,js_user as t2')
					   -> where('t1.uid=t2.uid and cash_state=1') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> display();
	}

	public function pass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('ti_cash');
		$model2 = M('purse');
		$t = date('m',time());
		$t1 = ('0'.($t-1));
		//查询信息
		$data = $model -> field('tcid,uid,cash_money,cash_state') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		//dump($data);die;
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['cash_state']=2;
			//dump($data[$i]);
			$result = $model -> save($data[$i]);

			$user_id = $data[$i]['uid'];
			$data2 = $model2 -> field('pid,uid,pbalance') -> where("month(purse_time) = $t1 and uid = $user_id") -> find();
			$data2['pbalance'] = $data2['pbalance'] - $data[$i]['cash_money'];
			$model2 -> save($data2);
			$data3['uid'] = $user_id;
			$data3['purse_time'] = date('Y-m-d H:i:s',time());
			$data3['purse_money'] = $data[$i]['cash_money'];
			$data3['purse_type'] = 2;
			$data3['pbalance'] = $data2['pbalance'];
			$model2 -> add($data3);
		}
		if($result){
			?><script>
				alert('已通过审核');window.parent.frames[0].location.href="/index.php/Admin/Ticash/ticash";
			</script><?php
				//$this -> success('已通过审核',U('connoisseur'),1);
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/Ticash/ticash";
			</script><?php
		}
	}

	public function notpass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('ti_cash');
		//查询信息
		$data = $model -> field('tcid,cash_state') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['cash_state']=4;
			//dump($data[$i]);
			$result = $model -> save($data[$i]);
		}
		if($result){
			?><script>
				alert('未通过审核');window.parent.frames[0].location.href="/index.php/Admin/Ticash/ticash";
			</script><?php
				//$this -> success('已通过审核',U('connoisseur'),1);
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/Ticash/ticash";
			</script><?php
		}
	}

	public function update_purse(){

	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}