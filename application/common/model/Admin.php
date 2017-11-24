<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use houdunwang\crypt\Crypt;
use think\Validate;

class Admin extends Model
{
    //

	protected $pk = 'admin_id'; //主键
	protected $table = 'blog_admin';  //模型里面的这里 一定要设置完整的数据表名称   不要以为设置了表前缀这里就可以省略 注意了！！！



	// 接收controller控制器传过来的参数$data
	public function login($data)
	{


		// halt($data);
		// dump($data);   //效果和halt($data);一样  都是打印数据

		// 1、执行验证  通过加载 admin/validate/Admin.php
		$validate = Loader::validate('Admin');
		// 如果验证不通过
		if(!$validate->check($data)){
			return ['valid'=>0,'msg'=>$validate->getError()];

		// dump($validate->getError());
		}

		// 2、比对用户名密码是否正确
			$userInfo=$this->where('admin_username',$data['admin_username'])->where('admin_password',Crypt::encrypt($data['admin_password']))->find();
			// dump($userInfo);
		if(!$userInfo)
		{
			//说明在数据库未匹配到相关数据
			return ['valid'=>'0','msg'=>'用户名或密码不正确'];
		}

		// 3、将用户信息存入到session当中
			session('admin.admin_id',$userInfo['admin_id']);
			session('admin.admin_username',$userInfo['admin_username']);
			return ['valid'=>1,'msg'=>'登录成功'];

	}




// 修改密码函数
	public function modipass($data)
	{



		// 1、验证不为空和两个修改密码相同
		$validate = new Validate([
			'admin_password' => 'require',
			'new_password' => 'require',
			'confirm_password' => 'require|confirm:new_password'
			],[
			'admin_password.require' => '请输入原始密码',
			'new_password.require' => '请输入新密码',
			'confirm_password.require' => '请输入确认密码',
			'confirm_password.confirm' => '确认密码跟新密码不一致'
			]

		);
		// $data = [
		// 'name' => 'thinkphp',
		// 'email' => 'thinkphp@qq.com'
		// ];
		if (!$validate->check($data)) {

			return ['valid'=>0,'msg'=>$validate->getError()];

		// dump($validate->getError());
		}



		// 2、验证原始密码是否正确

		$userInfo=$this->where('admin_id',session('admin.admin_id'))->where('admin_password',Crypt::encrypt($data['admin_password']))->find();

		if(!$userInfo)
		{
			return ['valid'=>0,'msg'=>'原始密码不正确'];
		}

		// 3、更新密码


		$res=$this->save([
		'admin_password' => Crypt::encrypt($data['new_password'])
		],[$this ->pk=> session('admin.admin_id')]);

		if($res)
		{
			return ['valid'=>1,'msg'=>'修改密码成功'];
		}else{
			return  ['valid'=>0,'msg'=>'修改密码失败'];
		}


	}
}
