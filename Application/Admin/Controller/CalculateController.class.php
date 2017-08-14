<?php

/*
	2017-5-5
	结算控制器
*/


namespace Admin\Controller;

class CalculateController extends CommonController{
	public function calculate(){
		$time_m = date('m',time());
		$model2 = M('bonus');
		$data2 = $model2 -> where("month(bonus_time) = $time_m") -> select();
		$this ->assign('data2',$data2);
		$this -> display();
	}
	public function time_bonus(){
		$m = date('m',time());
		$d = date('d',time());
		switch ($m) {
			case '01':
			case '03':
			case '05':
			case '07':
			case '08':
			case '10':
			case '12':
				if ($d==31) {
					$this -> bonus();
				}else{
					?><script>
						alert('未到结算日期');window.location.href="/index.php/Admin/Calculate/calculate";
					</script><?php
				}
				break;
			case '02':
				if ($d==28) {
					$this -> bonus();
				}else{
					?><script>
						alert('未到结算日期');window.location.href="/index.php/Admin/Calculate/calculate";
					</script><?php
				}
				break;
			default:
				if ($d==30) {
					$this -> bonus();
				}else{
					?><script>
						alert('未到结算日期');window.location.href="/index.php/Admin/Calculate/calculate";
					</script><?php
				}
				break;
		}
	}
	public function bonus(){
		//连接数据表
		//连接交易记录表
		$model = M('trade_record');
		//连接用户信息表
		$model_user = M('user');
		//连接奖金表
		$model_bonus = M('bonus');
		//连接注册金额表
		$model_money = M('register_money');
		//连接数据表end

		//查询注册金额
		$data_money = $model_money -> field('rmoney') -> find();
		$money = $data_money['rmoney'];
		//获取当前月份
		$t = date('m',time());
		//查询用户信息表里的所有用户的编号、推荐人编号、注册时间
		$data_user_id = $model_user -> field('uid,upid,sid,tid,uregister_time') -> select();
		//查询当前的用户总数
		$count_user = $model_user -> field('count(*) as count') -> select();
		//查询交易记录中未结算的记录编号、结算状态
		$data_record = $model -> field('trid,upid,trade_money,tr_finish') -> where("tr_finish = '0'") -> select();
		//查询未结算的交易记录数
		$count = $model -> field('count(*) as count') -> where("tr_finish = '0'") -> select();
		//如果存在未结算记录进行结算，不存在未结算记录则提示本月已结算
		if($data_record[0]!=""){
			//结算所有人的奖金
			for ($i=1; $i < $count_user[0]['count']; $i++) { 
				//用户id
				$user_id = $data_user_id[$i]['uid'];

				/*
					结算注册奖金
				*/
				//查询当前用户本月的新注册会员数
				$count_pid = $model_user -> field('count(*) as count') -> where("sid != 1 and sid != 6 and upid = $user_id and month(uregister_time) = $t") -> select();
				$pid = $count_pid[0]['count'];		//注册会员数
				//如果存在新注册则结算奖金，不存在则不结算
				if($pid!=0){
					/*echo $user_id;		//用户编号
					echo '<br>';
					echo $pid.'个新注册会员';	*/	
					//给注册奖金赋值
					$data_bonus_register['uid'] = $user_id;			//用户id
					$data_bonus_register['bonus_time'] = date('Y-m-d H:i:s',time());		//结算时间
					$data_bonus_register['bonus_money'] = ($money * $pid * 0.05);		//注册奖金
					$data_bonus_register['bonus_type'] = 1;				//类型1为注册奖金
					//添加注册奖金记录
					$model_bonus -> add($data_bonus_register);
					//dump($data_bonus_register);
				}
				/*
					结算注册奖金end
				*/

				/*
					结算返单奖金
				*/
				//查询当前用户的所有下属会员当月通过审核的返单记录数据的返单金额
				$data_record_fd = $model -> field('trade_money') -> where("upid = $user_id and trade_type = 2 and trade_state = 1 and month(trade_time) = $t") -> select();
				//dump($data_record_fd);
				//如果存在记录，则计算奖金
				if($data_record_fd[0] != ""){
					//当月通过审核的返单记录数
					$count_fd = $model -> field('count(*) as count') -> where("upid = $user_id and trade_type = 2 and trade_state = 1 and month(trade_time) = $t") -> select();
					//计算总金额	money_fd为总金额
					for ($j=0; $j < ($count_fd[0]['count']); $j++) { 
						$money_fd += $data_record_fd[$j]['trade_money'];		
					}
					//dump($money_fd);
					//给返单奖金赋值
					$data_bonus_fd['uid'] = $user_id;
					$data_bonus_fd['bonus_time'] = date('Y-m-d H:i:s',time());		//结算时间
					$data_bonus_fd['bonus_money'] = $money_fd * 0.05;
					$data_bonus_fd['bonus_type'] = 2;
					//添加返单奖金记录
					$model_bonus -> add($data_bonus_fd);
					$money_fd = 0;
					//dump($data_bonus_fd);
				}
				/*
					结算返单奖金end
				*/

				/*
					股东奖金结算
				*/
				//当前用户的身份状态信息
				$sid = $data_user_id[$i]['sid'];
				//团队编号
				$tid = $data_user_id[$i]['tid'];
				//判断当前用户是否为3股东
				if($sid == 3){
					//本团队当月新增人数
					$user_num = $model_user -> field('count(*) as count') -> where("month(uregister_time) = $t and tid = $tid and sid != 1 and sid != 6") -> select();
					$user_num_s = $user_num[0]['count'];
					//本团队当月的返单总金额
					$record = $model -> field('trade_money') -> where("month(trade_time) = $t and tid = $tid and trade_type = 2 and trade_state = 1") -> select();
					//本团队当月返单数量
					$count_record = $model -> field('trade_money,count(*) as count') -> where("month(trade_time) = $t and tid = $tid and trade_type = 2 and trade_state = 1") -> select();
					$count_record_fd = $count_record[0]['count'];
					//求本团队返单金额总和
					for ($k=0; $k < $count_record_fd; $k++) { 
						$record_money += $record[$k]['trade_money'];
					}
					//本团队的股东数
					$num_gd = $model_user -> field('count(*) as count') -> where("sid = 3 and tid = $tid") -> select();
					//本团队的执行董事的数量
					$num_ds = $model_user -> field('count(*) as count') -> where("sid = 4 and tid = $tid") -> select();
					//本团队的股东和执行董事总数量
					$num_gd_s = $num_gd[0]['count'] + $num_ds[0]['count'];
					//股东奖金结算
					$data_bonus_gd['uid'] = $user_id;
					$data_bonus_gd['bonus_time'] = date('Y-m-d H:i:s',time());
					$data_bonus_gd['bonus_money'] = ((($user_num_s * $money + $record_money) * 0.1) / $num_gd_s);
					$data_bonus_gd['bonus_type'] = 3;
					//添加股东奖金记录
					$model_bonus -> add($data_bonus_gd);
					//dump($data_bonus_gd);
					$record_money = 0;
				}
				/*
					股东奖金结算end
				*/

				/*
					执行董事奖金结算
				*/
				if($sid == 4){
					//本团队当月新增人数
					$user_num_4 = $model_user -> field('count(*) as count') -> where("month(uregister_time) = $t and tid = $tid and sid != 1 and sid != 6") -> select();
					$user_num_s_4 = $user_num_4[0]['count'];
					//本团队当月的返单总金额
					$record_4 = $model -> field('trade_money') -> where("month(trade_time) = $t and tid = $tid and trade_type = 2 and trade_state = 1") -> select();
					//本团队当月返单数量
					$count_record_4 = $model -> field('trade_money,count(*) as count') -> where("month(trade_time) = $t and tid = $tid and trade_type = 2 and trade_state = 1") -> select();
					$count_record_fd_4 = $count_record_4[0]['count'];
					//求本团队返单金额总和
					for ($k=0; $k < $count_record_fd_4; $k++) { 
						$record_money_4 += $record_4[$k]['trade_money'];
					}
					//本团队的股东数
					$num_gd_4 = $model_user -> field('count(*) as count') -> where("sid = 3 and tid = $tid") -> select();
					//本团队的执行董事的数量
					$num_ds_4 = $model_user -> field('count(*) as count') -> where("sid = 4 and tid = $tid") -> select();
					//本团队的股东和执行董事总数量
					$num_gd_s_4 = $num_gd_4[0]['count'] + $num_ds_4[0]['count'];
					//执行董事的团队分红
					$money_4 = ((($user_num_s_4 * $money + $record_money_4) * 0.1) / $num_gd_s_4);

					//公司本月新增人数
					$num_new = $model_user -> field('count(*) as count') -> where("month(uregister_time) = $t and sid != 1 and sid != 6 and sid != 5") -> select();
					$num_new_s = $num_new[0]['count'];
					//公司当月的返单总金额
					$record_all = $model -> field('trade_money') -> where("month(trade_time) = $t and trade_type = 2 and trade_state = 1") -> select();
					//公司当月返单数量
					$count_record_all = $model -> field('trade_money,count(*) as count') -> where("month(trade_time) = $t and trade_type = 2 and trade_state = 1") -> select();
					//公司团队返单金额总和
					for ($l=0; $l < $count_record_all[0]['count']; $l++) { 
						$record_money_all += $record_all[$l]['trade_money'];
					}
					//公司的执行董事数
					$num_ds_c = $model_user -> field('count(*) as count') -> where("sid = 4") -> select();
					$num_ds_s_c = $num_ds_c[0]['count'];
					$money_4_d  = ((($num_new_s * $money + $record_money_all) * 0.05) / $num_ds_s_c);
					//执行董事奖金结算
					$data_bonus_ds['uid'] = $user_id;
					$data_bonus_ds['bonus_time'] = date('Y-m-d H:i:s',time());
					$data_bonus_ds['bonus_money'] = ($money_4 + $money_4_d);
					$data_bonus_ds['bonus_type'] = 4;
					//添加执行董事奖金记录
					$model_bonus -> add($data_bonus_ds);
					//dump($data_bonus_ds);
					$record_money_4 = 0;
					$record_money_all = 0;
				}
				/*
					执行董事奖金结算end
				*/

				//修改钱包
				//连接钱包表
				$model_purse = M('purse');
				$t1 = ('0'.($t-1));
				//dump($t1);
				$data_purse = $model_purse -> field('uid,pbalance') -> where("month(purse_time) = $t1 and uid = $user_id") -> find();
				$data_bonus_all = $model_bonus -> field('bonus_money') -> where("month(bonus_time) = $t and uid = $user_id") ->select();
				for ($m=0; $m < 3; $m++) { 
					$money_bonus += $data_bonus_all[$m]['bonus_money'];
				}
				$data_purse_sr['uid'] = $user_id;
				$data_purse_sr['purse_time'] = date('Y-m-d H:i:s',time());
				$data_purse_sr['purse_money'] = $money_bonus;
				$data_purse_sr['purse_type'] = 1;		//	1、收入
				$data_purse_sr['pbalance'] = ($data_purse['pbalance'] + $money_bonus);
				$model_purse -> add($data_purse_sr);
				$money_bonus = 0;
				//修改钱包end

				
			}
			//修改结算状态
			for($i=0; $i < $count[0]['count'];  $i++){
				$data_record[$i]['tr_finish']=Y;
				$result = $model -> save($data_record[$i]);
			}

			//公司本月总支出结算
			$model_company = M('company');
			//注册收入
			$data_zc = $model -> field('trade_money') -> where("month(trade_time) = $t and trade_type = 1 and trade_state = 1") -> select();
			$count_zc = $model -> field('count(*) as count') -> where("month(trade_time) = $t and trade_type = 1 and trade_state = 1") -> select();
			for ($n=0; $n < $count_zc[0]['count']; $n++) { 
				# code...
				$data_company_1['cmoney'] += $data_zc[$n]['trade_money']; 
			}
			$data_company_1['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_1['ctype'] = 1;
			$model_company -> add($data_company_1);
			//返单收入
			$data_fd = $model -> field('trade_money') -> where("month(trade_time) = $t and trade_type = 2 and trade_state = 1") -> select();
			$count_fdall = $model -> field('count(*) as count') -> where("month(trade_time) = $t and trade_type = 2 and trade_state = 1") -> select();
			for ($n=0; $n < $count_zc[0]['count']; $n++) {
				$data_company_2['cmoney'] += $data_fd[$n]['trade_money']; 
			}
			$data_company_2['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_2['ctype'] = 2;
			$model_company -> add($data_company_2);
			//注册支出
			$data_zc_out = $model_bonus -> field('bonus_money') -> where("month(bonus_time) = $t and bonus_type = 1") -> select();
			$count_zc_out = $model_bonus -> field('count(*) as count') -> where("month(bonus_time) = $t and bonus_type = 1") -> select();
			for ($n=0; $n < $count_zc_out[0]['count']; $n++) {
				$data_company_3['cmoney'] += $data_zc_out[$n]['bonus_money']; 
			}
			$data_company_3['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_3['ctype'] = 3;
			$model_company -> add($data_company_3);
			//返单支出
			$data_fd_out = $model_bonus -> field('bonus_money') -> where("month(bonus_time) = $t and bonus_type = 2") -> select();
			$count_fd_out = $model_bonus -> field('count(*) as count') -> where("month(bonus_time) = $t and bonus_type = 2") -> select();
			for ($n=0; $n < $count_fd_out[0]['count']; $n++) {
				$data_company_4['cmoney'] += $data_fd_out[$n]['bonus_money']; 
			}
			$data_company_4['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_4['ctype'] = 4;
			$model_company -> add($data_company_4);
			//股东分红支出
			$data_gd_out = $model_bonus -> field('bonus_money') -> where("month(bonus_time) = $t and bonus_type = 3") -> select();
			$count_gd_out = $model_bonus -> field('count(*) as count') -> where("month(bonus_time) = $t and bonus_type = 3") -> select();
			for ($n=0; $n < $count_gd_out[0]['count']; $n++) {
				$data_company_5['cmoney'] += $data_gd_out[$n]['bonus_money']; 
			}
			$data_company_5['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_5['ctype'] = 5;
			$model_company -> add($data_company_5);
			//执行董事分红支出
			$data_ds_out = $model_bonus -> field('bonus_money') -> where("month(bonus_time) = $t and bonus_type = 4") -> select();
			$count_ds_out = $model_bonus -> field('count(*) as count') -> where("month(bonus_time) = $t and bonus_type = 4") -> select();
			for ($n=0; $n < $count_ds_out[0]['count']; $n++) {
				$data_company_6['cmoney'] += $data_ds_out[$n]['bonus_money']; 
			}
			$data_company_6['ctime'] = date('Y-m-d H:i:s',time());
			$data_company_6['ctype'] = 6;
			$model_company -> add($data_company_6);
			//公司总账end

			?><script>
				alert('结算完成');window.location.href="/index.php/Admin/Calculate/calculate";
			</script><?php
		}else{		//不存在未结算记录则提示本月已结算
			//echo "已结算过！";
			?><script>
				alert('以结算过');window.location.href="/index.php/Admin/Calculate/calculate";
			</script><?php
		}
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}