<?php

/*
	2017-5-5
	公司进出账目控制器
*/


namespace Admin\Controller;

class InoutController extends CommonController{
	public function inout(){
		$y = date('Y',time());
		for($i = $y; $i >= 2016; $i--){
			$year[$i]['Y'] = $i;
		}
		$this -> assign('year',$year);
		$time_y = I('get.y');
		$time_m = I('get.m');
		if ($time_m !="") {
			$model = M('company');
			$t2 = $time_y;
			$t = $time_m;
			$data_1 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 1") -> select();
			$data_2 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 2") -> select();
			$data_3 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 3") -> select();
			$data_4 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 4") -> select();
			$data_5 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 5") -> select();
			$data_6 = $model -> field('cmoney') -> where("year(ctime) = $t2 and month(ctime) = $t and ctype = 6") -> select();
			if($data_1[0]['cmoney'] !=""){
				//总收入
				$data_12 = $data_1[0]['cmoney'] + $data_2[0]['cmoney'];
				//总支出
				$data_zc = $data_3[0]['cmoney'] + $data_4[0]['cmoney'] + $data_5[0]['cmoney'] + $data_6[0]['cmoney'];
				//利润
				$data_lr = $data_12 - $data_zc;
				//利润所占比例
				$lirun = round(( ($data_12 - $data_zc) / $data_12 ),4) * 100;
				//支出所占比例
				$zhichu = round(($data_zc / $data_12),4) * 100;
				$this -> assign('data_12',$data_12);
				$this -> assign('data_zc',$data_zc);
				$this -> assign('data_lr',$data_lr);
				$this -> assign('data_1',$data_1[0]['cmoney']);
				$this -> assign('data_2',$data_2[0]['cmoney']);
				$this -> assign('data_3',$data_3[0]['cmoney']);
				$this -> assign('data_4',$data_4[0]['cmoney']);
				$this -> assign('data_5',$data_5[0]['cmoney']);
				$this -> assign('data_6',$data_6[0]['cmoney']);
				$str = "[{
		            name: '公司利润(元):$data_lr',
		            y:". $lirun.",
		            drilldown: '收入'
		        }, {
		            name: '本月支出(元):$data_zc',
		            y: ".$zhichu.",
		            drilldown: '支出'
		        }]";
		        $this -> assign('str',$str);

		        //每种收入所占比例
		        $zc_in = round(($data_1[0]['cmoney'] / $data_12),4) * 100;
		        $fd_in = round(($data_2[0]['cmoney'] / $data_12),4) * 100;
		        $str_sr = "[
		                ['注册收入',".$zc_in."],
		                ['返单收入',".$fd_in."]
		            ]";
		        $this -> assign('str_sr',$str_sr);

		        //每种支出所占比例 
		        $zc_out = round(($data_3[0]['cmoney'] / $data_zc),4) * 100;
		        $fd_out = round(($data_4[0]['cmoney'] / $data_zc),4) * 100;
		        $gd_out = round(($data_5[0]['cmoney'] / $data_zc),4) * 100;
		        $ds_out = round(($data_6[0]['cmoney'] / $data_zc),4) * 100;
		        $str_zc = "[
		                ['注册提成', ".$zc_out."],
		                ['返单提成', ".$fd_out."],
		                ['股东分红', ".$gd_out."],
		                ['执行董事分红', ".$ds_out."]
		            ]";
		        $this -> assign('str_zc',$str_zc);
		        $this -> assign('t2',$t2);
		        $this -> assign('t',$t);
		    }else{
		    	?><script>
					alert('无此月份数据');window.parent.frames[0].location.href="/index.php/Admin/Inout/inout";
				</script><?php
		    }
		}else{
			$this -> tu();
		}
        //展示模板
		$this -> display();

	}
	public function tu(){
		$model = M('company');
		$t2 = date('Y',time());
		$t = date('m',time());
		$data_1 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 1") -> select();
		$data_2 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 2") -> select();
		$data_3 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 3") -> select();
		$data_4 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 4") -> select();
		$data_5 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 5") -> select();
		$data_6 = $model -> field('cmoney') -> where("month(ctime) = $t and ctype = 6") -> select();
		//总收入
		$data_12 = $data_1[0]['cmoney'] + $data_2[0]['cmoney'];
		//总支出
		$data_zc = $data_3[0]['cmoney'] + $data_4[0]['cmoney'] + $data_5[0]['cmoney'] + $data_6[0]['cmoney'];
		//利润
		$data_lr = $data_12 - $data_zc;
		//利润所占比例
		$lirun = round(( ($data_12 - $data_zc) / $data_12 ),4) * 100;
		//支出所占比例
		$zhichu = round(($data_zc / $data_12),4) * 100;
		$this -> assign('data_12',$data_12);
		$this -> assign('data_zc',$data_zc);
		$this -> assign('data_lr',$data_lr);
		$this -> assign('data_1',$data_1[0]['cmoney']);
		$this -> assign('data_2',$data_2[0]['cmoney']);
		$this -> assign('data_3',$data_3[0]['cmoney']);
		$this -> assign('data_4',$data_4[0]['cmoney']);
		$this -> assign('data_5',$data_5[0]['cmoney']);
		$this -> assign('data_6',$data_6[0]['cmoney']);
		$str = "[{
            name: '公司利润',
            y:". $lirun.",
            drilldown: '收入'
        }, {
            name: '本月支出',
            y: ".$zhichu.",
            drilldown: '支出'
        }]";
        //dump($str);die;
        $this -> assign('str',$str);

        //每种收入所占比例
        $zc_in = round(($data_1[0]['cmoney'] / $data_12),4) * 100;
        $fd_in = round(($data_2[0]['cmoney'] / $data_12),4) * 100;
        $str_sr = "[
                ['注册收入',".$zc_in."],
                ['返单收入',".$fd_in."]
            ]";
        $this -> assign('str_sr',$str_sr);

        //每种支出所占比例
        $zc_out = round(($data_3[0]['cmoney'] / $data_zc),4) * 100;
        $fd_out = round(($data_4[0]['cmoney'] / $data_zc),4) * 100;
        $gd_out = round(($data_5[0]['cmoney'] / $data_zc),4) * 100;
        $ds_out = round(($data_6[0]['cmoney'] / $data_zc),4) * 100;
        $str_zc = "[
                ['注册提成', ".$zc_out."],
                ['返单提成', ".$fd_out."],
                ['股东分红', ".$gd_out."],
                ['执行董事分红', ".$ds_out."]
            ]";
        $this -> assign('str_zc',$str_zc);
        $this -> assign('t2',$t2);
		$this -> assign('t',$t);
	}
	public function _empty(){
    	$this -> display('Empty/empty');
    }
}