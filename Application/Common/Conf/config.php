<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'MYSQL',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'blogs',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'blogs_',    // 数据库表前缀
    
    /* URL设置 */
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
    'SESSION_AUTO_START' => true, //是否开启session
    'SHOW_PAGE_TRACE'=>true,  //开启trace模式
    
    'TMPL_PARSE_STRING' => array(
        '__JS__'          => __ROOT__ . '/Public/js',
        '__KINDEDITOR__'  => __ROOT__.'/Public/kindeditor-4.1.10',
         '__ADMIN__'  => __ROOT__.'/Public/admin',
    ),
);