<?php

/*
	2017-4-26
	注册审核控制器
*/


namespace Admin\Controller;

class UserController extends CommonController{
		public function user_beifen(){
			//模型实例化
			$model = M('user');
			//查询需要显示的记录数
			$count = $model -> where('sid=1') -> count();
			//实例化分页类，传递参数
			$page = new \Think\Page($count,1);
			//定义提示文字
			$page -> setConfig('prev','上一页');
			$page -> setConfig('next','下一页');
			$page -> setConfig('last','末页');
			$page -> setConfig('first','首页');
			//使用show方法生成url
			$show = $page -> show();
			//dump($show);die;
			//展示数据
			$data = $model -> limit($page -> firstRow,$page -> listRows) -> where('sid=1') -> select();
			//传递给模板
			$this -> assign('data',$data);
			$this -> assign('show',$show);
			//展示
			$this -> display();
		}

	//注册审核界面
	public function user(){
		//模型实例化
		$model = M();
		//展示数据
		$data = $model -> field('t1.*,t3.tname as tname')
					   -> table('js_user as t1,js_team as t3')
					   -> where('t1.tid=t3.tid and sid=1') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> display();
	}

	//注册审核通过方法
	public function pass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('user');
		//查询信息
		$data = $model -> field('uid,sid,unum') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		$da = $model -> field('uid,tid,upid,rid as trade_money') -> select($id);
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['sid']=2;
			$user_id = $data[$i]['uid'];
			//遍历节点数
			while ($user_id != 10000) {
				$data_father = $model -> field('upid') -> find($user_id);
				$father = $data_father['upid'];
				$p = $model -> field('uid,unum') -> find($father);
				$p['unum'] += 1;
				$model -> save($p);
				$user_id = $father;
			}
			$result = $model -> save($data[$i]);
		}
		//dump($data);die;
		for($i=0; $i < $count[0]['count'];  $i++){
			$da[$i]['trade_time'] = date('Y-m-d H:s:m',time());
			$da[$i]['trade_type'] = 1;
			$da[$i]['trade_state'] = 1;
		}
		if($result){
			//增加交易记录
			$model2 = M('trade_record');
			//$model2 -> addAll($da);
			//调用升级方法
			$MemberPromote = A('MemberPromote');
			$MemberPromote -> promote();
			?><script>
				alert('已通过审核');window.parent.frames[0].location.href="/index.php/Admin/User/user";
			</script><?php
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/User/user";
			</script><?php
		}
	}

	//注册审核未通过方法
	public function notpass(){
		//接收参数
		$id = I('get.id');		
		//实例化模型
		$model = M('user');
		//查询信息
		$data = $model -> field('uid,sid') -> select($id);
		$count = $model -> field('count(*) as count') -> select($id);
		//dump($count[0]['count']);
		for($i=0; $i < $count[0]['count'];  $i++){
			$data[$i]['sid']=6;
			$result = $model -> save($data[$i]);
		}
		if($result){
			?><script>
				alert('未通过审核');window.parent.frames[0].location.href="/index.php/Admin/User/user";
			</script><?php
		}else{
			?><script>
				alert('提交失败');window.parent.frames[0].location.href="/index.php/Admin/User/user";
			</script><?php
		}
	}

	//修改管理员密码
	public function updatepwd(){
		//修改密码
		if(IS_POST){
			$post = I('post.');
			$model = M('user');
			$id = session('uid');
			$da = $model -> field('uone_pwd') -> where('uid='.$id) -> find();
			if($post['yuone_pwd']==$da['uone_pwd'])
			{
				if($post['uone_pwd']==$post['yzpwd']){
					unset($post['yuone_pwd']);
					unset($post['yzpwd']);
					$post['uid'] = $id;
					$result = $model -> save($post);
					if($result){
						?><script>
							alert('修改成功');window.parent.frames[0].location.href="/index.php/Admin/User/updatepwd";
						</script><?php
					}else{
						$this -> error('修改失败');
					}
				}else{
					?><script>
						alert('两次密码输入不一致...');window.parent.frames[0].location.href="/index.php/Admin/User/updatepwd";
					</script><?php
				}
			}else{
				?><script>
					alert('原始密码错误...');window.parent.frames[0].location.href="/index.php/Admin/User/updatepwd";
				</script><?php
			}
		}
		$this -> display();
	}

	//重置密码方法
	public function resetpwd(){
		//重置密码
		if(IS_POST){
			$post = I('post.');
			if($post['uid'] != ""){
				$model = M('user');
				$post['uone_pwd'] = '123456';
				$post['utwo_pwd'] = NULL;
				$result = $model -> save($post);
				if($result){
					?><script>
						alert('重置成功');window.parent.frames[0].location.href="/index.php/Admin/User/resetpwd";
					</script><?php
				}else{
					?><script>
						alert('无此账号或重置失败');window.parent.frames[0].location.href="/index.php/Admin/User/resetpwd";
					</script><?php
				}
			}else{
				?><script>
					alert('请输入用户账号');window.parent.frames[0].location.href="/index.php/Admin/User/resetpwd";
				</script><?php
			}
			
		}
		$this -> display();
	}

	//用户注册界面处理方法
	public function useregister(){
		//用户注册
		$model = M('register_money');
		$data = $model -> find();
		$this -> assign('data',$data);
		do{
			$model4 = M('user');
			$id = rand(10001,20000);
			$data2 = $model4 -> where('uid='.$id) -> find();
			if($data2!=""){
				$i = 1;
			}
		}while ($i==1) ;
		$this -> assign('id',$id);
		if(IS_POST){
			$post = I('post.');
			if($post['umember_name'] != "" and $post['uname'] != "" and $post['utel'] != "" and $post['ucard'] != "" and $post['tid'] != ""){

			$da['tname'] = $post['tid'];
			$model2 = M('team');
			$model3 = M('user');
			$team = $model2 -> add($da);
			$post['tid'] = $team;
			$post['upid'] = 10000;
			$post['ulayer'] = 1;
			$post['uregister_time'] = date('Y-m-d H:i:s',time());
			$result = $model3 -> add($post);
			if($result){
				?><script>
					alert('添加成功');window.parent.frames[0].location.href="/index.php/Admin/User/useregister";
				</script><?php
				//$this -> success('添加成功',U('useregister'),3);
			}else{
				?><script>
					alert('添加失败');window.parent.frames[0].location.href="/index.php/Admin/User/useregister";
				</script><?php
			}

			}else{
				?><script>
					alert('不能有空...');window.parent.frames[0].location.href="/index.php/Admin/User/useregister";
				</script><?php
			}
		}
		$this -> display();
	}

	//查看会员信息
	public function look(){
		//
		$model = M('user');
		$this -> num();
		//查询需要显示的记录数
			$count = $model  -> count();
			//实例化分页类，传递参数
			$page = new \Think\Page($count,15);
			//定义提示文字
			$page -> setConfig('prev','上一页');
			$page -> setConfig('next','下一页');
			$page -> setConfig('last','末页');
			$page -> setConfig('first','首页');
			//使用show方法生成url
			$show = $page -> show();
		//展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows)
					   -> field('t1.*,t3.tname as tname')
					   -> table('js_user as t1,js_team as t3')
					   -> where('t1.tid=t3.tid') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		$this -> display("User/look");
	}

	//为审核的信息
	public function noreg(){
		$model = M('user');
		//查询需要显示的记录数
			$count = $model ->where("sid = 1") -> count();
			$this -> num();
			//实例化分页类，传递参数
			//dump($count);die;
			$page = new \Think\Page($count,15);
			//定义提示文字
			$page -> setConfig('prev','上一页');
			$page -> setConfig('next','下一页');
			$page -> setConfig('last','末页');
			$page -> setConfig('first','首页');
			//使用show方法生成url
			$show = $page -> show();
		//展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows)
					   -> field('t1.*,t3.tname as tname')
					   -> table('js_user as t1,js_team as t3')
					   -> where('t1.tid=t3.tid and sid = 1') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		$this -> display("User/look");
	}

	//以通过的信息
	public function overg(){
		$model = M('user');
		//查询需要显示的记录数
			$count = $model ->where("sid != 1 and sid != 5 and sid !=6") -> count();
			$this -> num();
			//实例化分页类，传递参数
			//dump($count);die;
			$page = new \Think\Page($count,15);
			//定义提示文字
			$page -> setConfig('prev','上一页');
			$page -> setConfig('next','下一页');
			$page -> setConfig('last','末页');
			$page -> setConfig('first','首页');
			//使用show方法生成url
			$show = $page -> show();
		//展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows)
					   -> field('t1.*,t3.tname as tname')
					   -> table('js_user as t1,js_team as t3')
					   -> where('t1.tid=t3.tid and sid != 1 and sid != 5 and sid !=6') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		$this -> display("User/look");
	}

	//未通过的信息
	public function nottg(){
		$model = M('user');
		//查询需要显示的记录数
			$count = $model ->where("sid =6") -> count();
			$this -> num();
			//实例化分页类，传递参数
			//dump($count);die;
			$page = new \Think\Page($count,15);
			//定义提示文字
			$page -> setConfig('prev','上一页');
			$page -> setConfig('next','下一页');
			$page -> setConfig('last','末页');
			$page -> setConfig('first','首页');
			//使用show方法生成url
			$show = $page -> show();
		//展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows)
					   -> field('t1.*,t3.tname as tname')
					   -> table('js_user as t1,js_team as t3')
					   -> where('t1.tid=t3.tid and sid =6') -> select();
		//传递给模板
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		$this -> display("User/look");
	}

	public function num(){
		$model = M('user');
		//查询需要显示的记录数
			$count = $model  -> count();
			$this -> assign('count',$count);
			//未审核
			$count_noreg = $model ->where("sid = 1") -> count();
			$this -> assign('count_noreg',$count_noreg);
			//已通过
			$count_overg = $model ->where("sid != 1 and sid != 5 and sid !=6") -> count();
			$this -> assign('count_overg',$count_overg);
			//未通过
			$count_nottg = $model ->where("sid =6") -> count();
			$this -> assign('count_nottg',$count_nottg);
	}

	//搜索
	public function search(){
		$model = M('user');
		$this -> num();
		$post = I('post.');
		//dump($post);
		$id = $post['id'];
		if($id != ""){
			$data = $model -> field('t1.*,t3.tname as tname')
						   -> table('js_user as t1,js_team as t3')
						   -> where("t1.tid=t3.tid and uid = $id") -> select();
			if($data[0] != ""){
				$this -> assign('data',$data);
				$this -> display("User/look");
			}else{
				?><script type="text/javascript" charset="utf8">
					alert("无此会员");window.location.href="/index.php/Admin/User/look";
				</script><?php
			}
			
		}else{
			?><script type="text/javascript" charset="utf8">
				alert("请输入编号");window.location.href="/index.php/Admin/User/look";
			</script><?php
		}
		
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}