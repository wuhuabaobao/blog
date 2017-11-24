<?php

// 检测sesssion里是否有值

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    //
	public function __construct (Request $request = null)
	{
		parent::__construct($request);

		// 这里的session('admin.admin_id') 是TP5提供给我们的函数
		// 相当于$_SESSION['admin']['admin_id'];
		if(!session('admin.admin_id'))
		{
			$this->redirect('admin/login/login');
		}

	}

}
