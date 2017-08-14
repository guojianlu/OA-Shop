<?php

namespace Home\Controller;
use Think\Controller;

class MapController extends CommonController{
    public function map(){
        $model = M('user');
        $use = session('uid');
        $gen = $model -> field('uid,uname') -> where("uid = $use") -> find();
      //  unset($gen[0]);
        $this -> assign('gen',$gen);
        //$this -> getUserIdFromViewTree();
       // dump($data);die;
        $this -> display();
    }
    private function getStandardData($childrenId,$model){
        $children = array();
        foreach($childrenId as $userId){
            $data = array();

            if($userId) {
                $user = $model ->field('t1.*,t2.status as sid')
                       -> table('js_user as t1,js_status as t2')
                       -> where("t1.sid=t2.sid and uid = $userId") -> find();
                        //field('uid,uname,umember_name,sid') -> where("uid = $userId") -> find();
                $money_yeji = $this -> yeji($userId);

                $data["id"] =$userId;
                $data["name"] = $user["uid"]."  ".$user["umember_name"];
                $data["title"] = $user["sid"]." 业绩:".$money_yeji;
                if($user['unum'] == 0){
                    $data["relationship"] = "110";
                }else{
                    $data["relationship"] = "111";
                }

            }else{
                $data["name"] = "";
                $data["title"] = "";
            }

            $children[] = $data;    //添加children元素
        }

        $result = array();
        $result["children"] = $children;
        return $result;
    }
    public function abc(){
        $model = M('user');
        //echo "11";
        $u = $this -> getUserIdFromViewTree();
        //dump($u);
        $childrenId = array();
        //$data = $model -> field('uid as id,uname as name,umember_name as title') -> where("upid = 10000") -> select();
        $data = $model -> field('uid') -> where("upid = $u") -> select();
        $count = $model -> field('count(*) as count') -> where("upid = $u") -> select();
        for ($i=0; $i < $count[0]['count']; $i++) {
            $childrenId[] = $data[$i]['uid'];
        }
        //dump($childrenId);
        $result = $this -> getStandardData($childrenId,$model);
        //dump($result);
        $this->ajaxReturn($result);
    }
    private function getUserIdFromViewTree(){
        $url = $_SERVER["REQUEST_URI"];
        $urls = split("/",$url);
        $userId = $urls[count($urls)-2];
        //dump($userId);
        return $userId;
    }

     public function yeji($userId){
        //连接数据表
        //连接交易记录表
        $model = M('trade_record');
        //连接用户信息表
        $model_user = M('user');
        //连接注册金额表
        $model_money = M('register_money');
        //连接数据表end

        //查询注册金额
        $data_money = $model_money -> field('rmoney') -> find();
        $money = $data_money['rmoney'];
        //当前月份
        $t = date('m',time());
        $count_pid = $model_user -> field('count(*) as count') -> where("sid != 1 and sid != 6 and upid = $userId and month(uregister_time) = $t") -> select();
        $pid = $count_pid[0]['count'];      //注册会员数
        $money_1 = $pid * $money * 0.05 ;           //注册金额业绩


        //查询当前用户的所有下属会员当月通过审核的返单记录数据的返单金额
        $data_record_fd = $model -> field('trade_money') -> where("upid = $userId and trade_type = 2 and trade_state = 1 and month(trade_time) = $t") -> select();
        //如果存在记录，则计算奖金
        if($data_record_fd[0] != ""){
            //当月通过审核的返单记录数
            $count_fd = $model -> field('count(*) as count') -> where("upid = $userId and trade_type = 2 and trade_state = 1 and month(trade_time) = $t") -> select();
            //计算总金额 money_fd为总金额
            for ($j=0; $j < ($count_fd[0]['count']); $j++) { 
                $money_fd += $data_record_fd[$j]['trade_money'];        
            }
            $money_2 = $money_fd * 0.05;
            $money_fd = 0;
        }
        $money_yeji = $money_1 + $money_2;
        return $money_yeji;
    }
}