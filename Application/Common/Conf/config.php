<?php
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_MODEL'             =>  1, 

	// 模版的访问路径规则
	'TMPL_PARSE_STRING'  =>array(	
		'__PUBLIC__' => '/Common', // 更改默认的/Public 替换规则
		'__JS__'     => '/Public/JS/', // 增加新的JS类库路径替换规则
		'__CSS__' 	 => '/Public/CSS',
		'__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
		'__PHOTO__'  =>  __ROOT__.'/Public/photo',
		'__PDF__'    =>  __ROOT__.'/Public/PDF',
		'__CARD__'   =>  __ROOT__.'/Public/photo/Card',
		'__ROOT__'   => __ROOT__,	
		'__PLUGIN__'	 =>  __ROOT__.'/Public/Plugin'
	),


	//数据库配置信息
	'DB_TYPE'   => 'mysqli', // 数据库类型
	'DB_HOST'   => 'www.ryxfzhome.top', // 服务器地址
	'DB_NAME'   => 'ryxfzhome', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'ECA7963ac5d7', // 密码
	'DB_PORT'   =>  3306, // 端口
	'DB_PARAMS' =>  array(), // 数据库连接参数
	'DB_PREFIX' => 'think_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志


);