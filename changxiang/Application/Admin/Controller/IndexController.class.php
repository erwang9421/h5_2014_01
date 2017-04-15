<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    //判断是否登录
    public function __construct(){
    	parent::__construct();
    	if (!isLogin()) {
    		$this->error("请先登录",U("Admin/login"));
    	}
        if (isLogin()) {
            //登录次数
            $new=M("Admin");
            $output=$new->where(array('id'=>$id))->setInc('logintimes',1);
            $newscount=$new->find($id);
            $this->assign('admincount',$newscount);
        }
    }

}