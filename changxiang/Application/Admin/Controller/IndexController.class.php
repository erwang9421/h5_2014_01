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
    }
}