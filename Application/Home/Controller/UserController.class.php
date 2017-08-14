<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class UserController extends Controller {

    //用户登录成功后的首页
    public function index(){
        $this->display();
    }
    //内嵌框架的首页
    public function shouye(){
        $model = M('User');
        $id = session('uid');
        //从用户表中取出用户基本信息
        $data = $model->find($id);
        //将用户基本系信息传递给模板
        $this->assign('data',$data);
        //分组查询，注册人数
        $uid = $data['uid'];
        $result=$model->field('uid,count(*) as count')->group('upid')->having("upid = $uid")->select();
        $count = $result[0]['count'];
        $this->assign('count',$count);
        //返单次数，金额
        $model4 = M('Trade_record');
        $result2 = $model4->field('uid,count(*) as count_sum,sum(trade_money) as count_money')->group('uid')->having("uid = $uid")->select();
        $count_sum = $result2[0]['count_sum'];
        $conut_money = $result2[0]['count_money'];
        $this->assign('count_sum',$count_sum);
        $this->assign('count_money',$conut_money);

        //级别
        $model2 = M('Status');
        $sid = $model2->find($data['sid']);
        $data_sid = $sid['status'];
        $this->assign('data_sid',$data_sid);
        //注册的总金额
        $model3 = M('Register_money');
        $data_money = $model3->find();
        //注册金额
        $money = $data_money['rmoney'];
        $sum_money = $money * $count;
        //将注册金额传递到模板
        $this->assign('sum_money',$sum_money);
        //模板展示
        $this->display();
    }
    //会员注册
    public function register(){
        //注册金额
        $model3 = M('Register_money');
        $data_money = $model3->find();
        $money = $data_money['rmoney'];
        //将注册金额传递到模板
        $this->assign('money',$money);
        $this->display();
    }

    //注册提交
    public function zc_tj(){
        $model = M('User');
        $data = I('post.');
            $data['uregister_time']  = date('Y-m-d H:i:s',time());
            $parant = $model->find($data['upid']);
            $data['tid'] = $parant['tid'];
            $data['ulayer'] = $parant['ulayer'] + 1;
            $result = $model->add($data);
            if($result){
                ?>
                <script type="text/javascript">
                    window.alert("注册成功");
                    window.location.href = "/index.php/Home/User/register";
                </script>
                <?php
               // $this->success("注册成功",U('register'),2);
            }else{
                ?>
                <script type="text/javascript">
                    window.alert("注册失败");
                    window.location.href = "/index.php/Home/User/register";
                </script>
                <?php
               // $this->error("注册失败",U('register'),2);
            }
    }

    //个人中心
    public function geren(){
        $this->display();
    }


    //返单
    public function fandan(){
        $this->display();
    }

    //返单提交
    public function fandan_tj(){
        $model = M('Trade_record');
        $data = I('post.');
        $uid = session('uid');
        $data['uid'] = $uid;
        $data['trade_time']  = date('Y-m-d H:i:s',time());
        $model2 = M('User');
        $data2 = $model2->find($uid);
        $data['tid'] = $data2['tid'];
        $data['upid'] = $data2['upid'];
            $result = $model->add($data);
            if ($result){
                ?>
                <script type="text/javascript">
                    window.alert("返单成功");
                    window.parent.location.href = "/index.php/Home/User/fandan";
                </script>
                <?php
            }else{
                ?>
                <script type="text/javascript">
                    window.alert("返单失败，请重试")
                    window.parent.location.href = "/index.php/Home/User/fandan";
                </script>
                <?php
            }
    }

    //退出登录
    public function logout(){
        session(null);
        ?>
        <script type="text/javascript">
           // var r = window.confirm("您确定要退出当前账号吗?");
          // if(r == true){
               window.parent.location.href = "/index.php/Home/Index/index";
          // }

        </script>

        <?php
    }

    //提现申请
    public function cash_sq(){
        $model = M('User');
        $uid = session('uid');
        $data = $model->find($uid);
        $utwo_pwd = $data['utwo_pwd'];
       if($utwo_pwd){//已经设置了二级密码
           ?>
           <script type="text/javascript">
               window.parent.location.href = "/index.php/Home/User/erji_mima_yanzhen";
           </script>
           <?php

       }else{//没有设置二级密码
           ?>
           <script type="text/javascript">
               window.alert("请您先设置二级密码");
               window.location.href = "/index.php/Home/User/change_personal_data";
           </script>
           <?php

       }
    }

    //二级密码验证
    public function erji_mima_yanzhen(){
        $data = I('post.');
        if($data){ //提交
            $count = $data['count'];
            $model = M('User');
            $uid = session('uid');
            $res = $model->find($uid);
            if($data['utwo_pwd'] == $res['utwo_pwd']){  //验证成功
              //返回一个标志位flag
                $flag = 2;
                $this->assign('flag',$flag);
                //将计数变量返回给模板
                $this->assign('count',$count);
                $this->display();
            }else{ //验证失败
                //返回一个标志位flag
                $flag = 1;
                $this->assign('flag',$flag);
                //将计数变量返回给模板
                $this->assign('count',$count);
                $this->display();

            }

        }else{ //未提交
            //返回一个标志位flag
            $flag = 0;
            $this->assign('flag',$flag);
            $this->display();
        }

    }


    //提现
    public function ti_cash(){
        $receive_data = I('post.');
        $count = $receive_data['count'];
        if($receive_data){ //提现提交
            $model2 = M('Ti_cash');
            $uid = session('uid');
            $receive_data['uid'] = $uid;
            $receive_data['cash_time']  = date('Y-m-d H:i:s',time());
            $res = $model2->add($receive_data);
            if($res){
                $model = M('Purse');
                $uid = session('uid');
                $data = $model->where("uid = $uid")->select();
                $pbalance = $data[0]['pbalance'];
                $this->assign('pbalance',$pbalance);
                //标志提交的状态值flag
                $flag = 2;
                $this->assign('flag',$flag);
                //计数值传回模板
                $this->assign('count',$count);
                $this->display();
            }else{
                $model = M('Purse');
                $uid = session('uid');
                $data = $model->where("uid = $uid")->select();
                $pbalance = $data[0]['pbalance'];
                $this->assign('pbalance',$pbalance);
                //标志提交的状态值flag
                $flag = 1;
                $this->assign('flag',$flag);
                //计数值传回模板
                $this->assign('count',$count);
                $this->display();
            }

        }else{ //未提交
            $model = M('Purse');
            $uid = session('uid');
            $data = $model->where("uid = $uid")->select();
            $pbalance = $data[0]['pbalance'];
            $this->assign('pbalance',$pbalance);
            //标志提交的状态值flag
            $flag = 0;
            $this->assign('flag',$flag);
            $this->display();
        }

    }


    //提现查询
    public function cash_cx(){
        $model = M('Purse');
        $uid = session('uid');
        $data = $model->where("uid = $uid")->select();
        $pbalance = $data[0]['pbalance'];
        $this->assign('pbalance',$pbalance);
        //提现状态
        $model2 = M('Ti_cash');
        $data2 = $model2->where("uid = $uid")->select();
        $cash_state = $data2[0]['cash_state'];
        if($cash_state == 1){
            $cash_state = "待审核";
        }elseif ($cash_state == 2){
            $cash_state = "审核通过，待发放";
        }else if ($cash_state == 3){
            $cash_state = "发放完成";
        }else{
            $cash_state = "未通过";
        }
        $this->assign('cash_state',$cash_state);
        $this->display();
    }

    //个人业绩查询
    public function ward_cx(){
        //限制查询年份
        $y = date('Y',time());
        for ($i = $y;$i >= 2016;$i--)
        {
            $year[$i]['Y'] = $i;
        }
        //将年份数组传递给模板
        $this->assign('year',$year);

        $data = I('post.');
        if($data){//点击确定，进行查询
            $count = $data['count'];
//           dump($count);
            $model = M('Bonus');
            $uid = session('uid');
            $year = $data['year'];
            $month = $data['month'];
            //查看本人的身份状态
            $personal_model = M('User');
            $personal = $personal_model->find($uid);
            $state = $personal['sid'];
            //查询注册，返单，奖金金额
            $result1 =$model->where("year(bonus_time) = '$year' and month(bonus_time) = '$month' and uid = $uid and bonus_type = 1")->select();
            $result2 =$model->where("year(bonus_time) = '$year' and month(bonus_time) = '$month' and uid = $uid and bonus_type = 2")->select();
            $result3 =$model->where("year(bonus_time) = '$year' and month(bonus_time) = '$month' and uid = $uid and bonus_type = $state")->select();
            $result_zhuce = $result1[0]['bonus_money'];
            $result_fandan = $result2[0]['bonus_money'];
            $result_ward = $result3[0]['bonus_money'];
            //将查到的金额数据传递给模板
            $this->assign('result_zhuce',$result_zhuce);
            $this->assign('result_fandan',$result_fandan);
            $this->assign('result_ward',$result_ward);
            //将计数变量传递给模板
            $this->assign('count',$count);
            $this->display();
        }else{
            $this->display();
        }
    }


    //团队业绩查询
    public function team_cx(){
        $model = M('User');
        $uid = session('uid');
        //当前年份
        $year = date('Y',time());
        //当前月份
        $month = date('m',time());
        $uid = $model->find($uid);
        //所属团队
        $tid = $uid['tid'];
        $result = $model->field('sum(rid) as sum')->where("year(uregister_time) = '$year' and month(uregister_time) = '$month' and tid = $tid")->select();
        //注册金额和
        $register_sum = $result[0]['sum'];
        $this->assign('register_sum',$register_sum);
        //返单金额和
        $model2 = M('Trade_record');
        $result2 = $model2->field('sum(trade_money) as trade_sum')->where("year(trade_time) = '$year' and month(trade_time) = '$month' and tid = $tid and trade_type = 2")->select();
        $fandan_sum = $result2[0]['trade_sum'];
        $this->assign('fandan_sum',$fandan_sum);
        $this->display();
    }


    //修改个人资料
    public function change_personal_data(){
        $model = M('User');
        $receive_data = I('post.');
        if($receive_data){
            //点击提交按钮
            $count = $receive_data['count'];
            //dump($count);
            $result = $model->save($receive_data);
            if ($result) {
                //修改成功
                $uid = session('uid');
                $data = $model->find($uid);
                $this->assign('data', $data);
                //标志提交的状态值flag
                $flag = 2;
                $this->assign('flag', $flag);
                //将计数变量传递给模板
                $this->assign('count',$count);
                $this->display();
            }else{
                //修改失败
                $uid = session('uid');
                $data = $model->find($uid);
                $this->assign('data',$data);
                //标志提交的状态值flag
                $flag = 1;
                $this->assign('flag',$flag);
                //将计数变量传递给模板
                $this->assign('count',$count);
                $this->display();

            }
        }else{
            //未点击提交按钮
            $uid = session('uid');
            $data = $model->find($uid);
            $this->assign('data',$data);
            //标志提交的状态值flag
            $flag = 0;
            $this->assign('flag',$flag);
            $this->display();
        }
    }

}