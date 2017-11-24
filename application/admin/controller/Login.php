<?php

namespace app\admin\controller;

use app\common\model\Admin;
use houdunwang\crypt\Crypt;
use think\Controller;



class Login extends Controller
{
    //
	public function login(){

		// 测试数据库连接是否正常
		// $db= db('admin')->find(1);
		// dump($db);



		// 视图确认按钮之后  发送post请求
		if(request()->isPost())
		{

			// halt($_POST);

			// 加密
			// echo Crypt::encrypt('admin888');
			// 解密
			// echo Crypt::decrypt('h3vPU8JGuF3VS/uxIpjRSw==');




			// 交由mvc中的model数据模型处理数据   传递给login方法   input('post.')作为参数
			$res = (new Admin())->login(input('post.'));


			if($res['valid'])
			{
				// 设置1秒后跳转，默认是3秒
				$this->success($res['msg'],'admin/entry/index','',1);

				// 说明登录成功
			}else{
				//说明登录失败
				$this->error($res['msg']);exit;

			}
		}




		// 视图显示
		return view();

	}
}
