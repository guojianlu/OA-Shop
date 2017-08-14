<?php

/*
	2017-5-9
	会员升级控制器
	MemberPromoteController
	2017-5-10
*/


namespace Admin\Controller;

class MemberPromoteController extends CommonController{
	public function promote(){
		//连接用户信息表
		$model_user = M('user');
		//查询用户信息表里的所有用户的编号、推荐人编号、注册时间
		$data_user_id = $model_user -> field('uid,upid,sid') -> select();
		//查询当前的用户总数
		$count_user = $model_user -> field('count(*) as count') -> select();
		for ($i=1; $i < $count_user[0]['count']; $i++) {
			//用户id
			$user_id = $data_user_id[$i]['uid'];
			//用户身份状态
			$user_sid = $data_user_id[$i]['sid'];

			/* 
				会员升级为股东开始
			*/
			//如果用户身份状态为2会员，则判断是否到达升级条件
			if($user_sid == 2){
				//判断用户注册的会员数
				$count_child = $model_user -> field('count(*) as count') -> where("upid = $user_id and sid != 1 and sid != 6") -> select();
				//会员数量
				$num = $count_child[0]['count'];
				//判断会员数量是否大于等于3，是则将其身份状态升级为3股东
				if($num>=3){
					$data_user_id[$i]['sid'] = 3;		//将身份状态更改为3股东
					$model_user -> save($data_user_id[$i]);		//更新用户表状态
				}
			}
			/*
				会员升级为股东end
			*/

			/*
				股东升级为执行董事开始
			*/
			else if($user_sid == 3){
				//查找该用户的子节点的编号、下极节点数数据
				$data_child = $model_user -> field('uid,unum') -> where("upid = $user_id and sid != 1 and sid != 6") -> select();
				//查询子节点数
				$count_c1 =  $model_user -> field('count(*) as count') -> where("upid = $user_id and sid != 1 and sid != 6") -> select();
				//判断变量
				$b = 0;
				$c = 0;
				$num = 0;
				//循环遍历每个节点判断其的子节点数
				for ($j=0; $j < $count_c1[0]['count']; $j++) { 
					//判断是否有两个分支的会员数满足大于等于10人
					if($b < 2){
						//是则判断单个分支是否大于等于10人
						if ($data_child[$j]['unum']>=10) {
							//是大于等于10人  计数加1
							$b += 1;
						}else{
							//不是则子节点数累加
							$num += $data_child[$j]['unum'];
						}
					}else{
						//满足有两个分支大于等于10人后，累加其余分支孩子数
						$c = 1;
						$num += $data_child[$j]['unum'];
					}
				}
				//判断是否有两个分支的子节点数大于等于10个，并且其他分支的子节点总数大于10个
				if($c == 1 && $num >= 10){
					//是则修改该会员的身份状态为4执行董事
					$data_user_id[$i]['sid'] = 4;
					$model_user -> save($data_user_id[$i]);			//更新用户信息表
				}
			}
			/*
				股东升级为执行董事end
			*/
		}
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}