<?php

namespace app\common\model;

use think\Model;

use think\Validate;

class Category extends Model
{
    //
    protected $pk='cate_id';
    protected $table='blog_cate';

    public function store($data)
    {

    	// 只要定义了验证器  就可以用这种方向数据库添加数据，超级方便，实用
    	$result=$this->validate(true)->save($data);


    	if(false===$result)
    	{

    		return ['valid'=>0,'msg'=>$this->getError()];


    	}else{

    		return ['valid'=>1,'msg'=>'添加成功'];
    	}

    }
}
