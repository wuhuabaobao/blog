<?php

namespace app\admin\validate;
use think\Validate;

// extends Validate大写
class Admin extends Validate
{
	protected $rule=[
		'admin_username'=>'require',
		'admin_password'=>'require',
		'code'=>'require|captcha'
	];

	// 不添加protected $message 就是默认的提示消息，下面添加自定义的提示消息

	protected $message = [
		'admin_username.require'=>'请输入用户名！',
		'admin_password.require'=>'请输入密码！',
		'code.require'=>'请输入验证码！',
		'code.captcha'=>'验证码不正确',
	];

}





?>