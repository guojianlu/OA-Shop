<?php
/*
    2017-4-25
*/


namespace Admin\Controller;

class IndexController extends CommonController {
    public function index(){	
        $this -> display();
        
    }
    public function _empty(){
    	$this -> display('Index/main');
    }
} 