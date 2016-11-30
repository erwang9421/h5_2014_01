<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function __construct(){
 		parent::__construct();
 		/*if(!isLogin())
 		{
 			$this->error("请先登录","Admin/login");
 		}*/
 		/*if(get_username())
 		{
 			$sessionName=get_username();
 		}*/
 	}

 	public function adduser(){
		$this->display();
	}

	public function doAdd() {
		if (!IS_POST) {
		exit("bad request!");
		}
		//实例化模型类 格式 [资源://][模块/]模型
		$userModel = M("users");
		if (!$userModel->create()) {  //创建对象
			$this->error($userModel->getError());
		}
		if ($userModel->add()) { //创建操作
			$this->success("添加成功！", U("lists"));
		}
		else {
			$this->error("添加失败！");
		}
	}

	public function lists() {  
		$userModel = M("users");
		$user = $userModel->select();  //读取操作
		$this->assign('user', $user);  //传值到模板
		$this->display();

	}
}