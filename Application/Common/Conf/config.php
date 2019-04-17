<?php
return array(
	//'配置项'=>'配置值'
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_MODEL'             =>  1, 

	// 开启session
	'SESSION_AUTO_START' => true, //是否开启session

	// 模版的访问路径规则
	'TMPL_PARSE_STRING'  =>array(	
		'__PUBLIC__' => '/Common', // 更改默认的/Public 替换规则
		'__JS__'     => '/Public/JS/', // 增加新的JS类库路径替换规则
		'__CSS__' 	 => '/Public/CSS',
		'__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
		'__PHOTO__'  =>  __ROOT__.'/Public/photo',
		'__Uploads__'  =>  __ROOT__.'/Public/Uploads',	//上传图片根目录
		'__UserFace__' =>  __ROOT__.'/Public/Uploads/UserFace',
		'__PDF__'    =>  __ROOT__.'/Public/PDF',
		'__CARD__'   =>  __ROOT__.'/Public/photo/Card',
		'__ROOT__'   => __ROOT__,	
		'__PLUGIN__'	 =>  __ROOT__.'/Public/Plugin'
	),

	'LOAD_EXT_CONFIG' => 'database',	// 隐藏数据库配置

);