<?php

/*
	2017-5-1
*/

namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function _initialize(){
		$uid = session('uid');
		if (empty($uid)) {
			?><script>
				alert('请先登录...');window.location.href="/index.php/Admin/Login/log";
			</script><?php
		}
	}
}