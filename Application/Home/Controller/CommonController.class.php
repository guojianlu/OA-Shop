<?php

/*
	2017-5-1
*/

namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function _initialize(){
		$uid = session('uid');
		if (empty($uid)) {
			?><script>
				alert('请先登录...');window.location.href="/index.php/Home/Index/index";
			</script><?php
		}
	}
}