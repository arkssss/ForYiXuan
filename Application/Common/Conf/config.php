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

	
	),

	

);