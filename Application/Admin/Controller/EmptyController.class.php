<?php

/*
	2017-5-23
*/

namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller{
	public function _empty(){
		$this -> display('Empty/empty');
	}
}