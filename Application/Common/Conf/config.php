<?php
return array(
	//'配置项'=>'配置值'

	//常量
	'TMPL_PARSE_STRING' => array(
			'__ADMIN__' => __ROOT__.'/Public/Admin',
			'__HOME__'=>__ROOT__.'/Public/Home'
		),
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_js',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'js_',    // 数据库表前缀

    //显示跟踪信息
    'SHOW_PAGE_TRACE'     => false,      //默认为false

    //动态加载文件
    'LOAD_EXT_FILE'       =>'info',//包含文件名的字符串，多个文件名之间用逗号隔开


);