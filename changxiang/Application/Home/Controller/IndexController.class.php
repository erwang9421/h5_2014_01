<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function __construct(){
                parent::__construct();
                  if (!isLogins()) {
                     dump("并没有登录");
                  }
        }

        public function index(){
        			$v = getData();
        			$list = $v[0];
        	    	$fansModel = M('fans');
        	    	$condition->username = $list['username'];
        	    	//粉丝数量 粉丝表中的username和这个用户的usename相同的数量
        	    	$list['fan'] = $fansModel->where($condition)->count();
        	    	//关注数量
        	    	$condition2->fanname = $list['username'];
        	    	$list['attention'] = $fansModel->where($condition2)->count();
        	    	dump($list);
        	    	$this ->assign('list',$list);//赋值数据集
        			$this->display();
             }
}