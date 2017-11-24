<?php

namespace app\admin\controller;

use think\Controller;

class Category extends Controller
{

	protected $db;
	protected function _initialize()
	{
		parent::_initialize();

        // 存在一个db的属性里面
		$this->db=new \app\common\model\Category();
	}

    //首页
    public function index()
    {

        // 获取栏目数据
        $field=db('cate')->select();

        // dump($field);

        $this->assign('field',$field);

    	return view();
    }

    public function store()
    {

    	if(request()->isPost())
    	{
    		// dump(input('post.'));
    		 $res=$this->db->store(input('post.'));
             // 对比$res = (new Admin())->modipass(input('post.'));

             if($res['valid'])
             {

                    $this->success($res['msg'],'index','',1);exit;

             }else{

                $this->error($res['msg']);exit;

             }
    	}

    	return view();
    }

    public function addSon()
    {


        $cate_id=input('param.cate_id');
        $data=$this->db->where('cate_id',$cate_id)->find();

        // dump($data);
        $this->assign('data',$data);

        return view();
    }
}
