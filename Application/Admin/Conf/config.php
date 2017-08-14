<?php
return array(
	//'配置项'=>'配置值'

		//数据库连接
    	'db_type' => 'mysql',
        'db_user' => 'root',
        'db_pwd' => 'root',
        'db_host' => 'localhost',
        'db_port' => '3306',
        'db_name' => 'db_js',
        'db_charset'=> 'utf8',
        'DB_PREFIX'  =>  'js_',    // 数据库表前缀
        'db_debug' => true, // 数据库调试模式 开启后可以记录SQL日志


        '__ADMIN__' => '/index.php/Admin/',
        );