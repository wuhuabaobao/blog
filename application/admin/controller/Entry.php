<?php

namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin;

// 此处要继承Common
class Entry extends Common
{
    //首页
	public function index(){

		// echo "测试";
		return view();

	}


// 修改密码
	public function modipass(){

		if(request()->isPost())
		{


			$res = (new Admin())->modipass(input('post.'));

			if($res['valid'])
			{
				session(null);
				$this->success($res['msg'],'admin/entry/index');exit;
				// 执行成功
			}else{
				$this->error($res['msg']);exit;
			}
		}



		return view();

	}
}
