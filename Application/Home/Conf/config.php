<?php
return array(
	//'配置项'=>'配置值'

	// 返回文本配置
	'AJAX_RETURN_TEXT' => array(

		//保存
		'SAVE_SUCCESS' => "恭喜小任任保存成功~~~, 要经常来哦",
		'SAVE_FAIL' => "oops, 网站好像出现了一点问题, 快联系小舟解决吧 :)",

		//删除
		'DEL_SUCCESS' => "小任任删除成功~~~",

		//新增
		'ADD_SUCCESS' => "恭喜小任任新增足迹成功~~~",


		//文章保存
		'SAVE_DAILYBOARD_SUEECSS' => "小任任发布成功啦~~~",

		//不能为空的提示
		'NOT_EMTPY' => '小任任不能少提交信息哦, 不然小舟处理不了啦~~',

		//账号密码错误
		'ACCOUNT_ERROR' => "你一定不是小任任, 账号输入错啦~",
		'ACCOUNT_PASS' => "小任任你好呀~~~嘻嘻嘻, lei呀lei呀",


		//profile 保存
		'PROFILE_SAVE_SUCCESS' => "小任任更新神秘资料成功啦",
		'PROFILE_SAVE_FAIL'  => "咦, 小舟的服务器好像出了一点问题, 快联系小舟解决吧",


		//密码更改
		'PASSWORD_CHANGE_SUCCESS' => "小任任密码更改成功啦, 抱一个~",
		'PASSWORD_CHANGE_THE_SAME' => "小任任你的新密码和旧密码一样啦, 改屁屁~"
	) ,




	//图片上传的配置文件 , daily_board Editor 
	'UPLOAD_DAILY_BOARD' => array(

		'maxSize'   =>     3145728 ,// 设置附件上传大小 单位为字节
		'exts'      =>     array('jpg', 'gif', 'png', 'jpeg'),// 设置附件上传类型
		// $upload->rootPath  =     $_SERVER['DOCUMENT_ROOT'].'/ForYiXuan/Public/Uploads/'; // 设置附件上传根目录
		'rootPath'  =>     './Public/Uploads/', 
		'savePath'  =>     "", // 设置附件上传（子）目录

	),

	//图片上传的配置文件 , daily_board Editor 
	'UPLOAD_USER_FACE' => array(

		'maxSize'   =>     3145728 ,// 设置附件上传大小 单位为字节
		'exts'      =>     array('jpg', 'gif', 'png', 'jpeg'),// 设置附件上传类型
		// $upload->rootPath  =     $_SERVER['DOCUMENT_ROOT'].'/ForYiXuan/Public/Uploads/'; // 设置附件上传根目录
		'rootPath'  =>     './Public/Uploads/', 
		'savePath'  =>     "UserFace/", // 设置附件上传（子）目录
		'autoSub'   =>   false,


	)
	



);