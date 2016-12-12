<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	public function login(){
		if (IS_POST) {
			$adminModel=M('Admin');
			
			$condition=array(
				'adminname' => I("post.adminname"),
				'adminpass' => I("post.adminpass")
				);
			$result=$adminModel->where($condition)->count();
			// dump($result);
			if ($result>0) {
				session("adminname",I("post.adminname"));
				$this->success("登录成功",U("Index/index"));
			}
			else{
				$this->error("用户名或密码不正确");
			}
		}
		else{
			$this->display();
		}
	}
	
	public function manager(){
        $managerModel=M("Admin"); 
        $manager=$managerModel->select();
        $this->assign("manager",$manager);

		$this->display();
	}
	public function editmanager(){
		$managerModel=D("admin");
		$id=$_GET['managerId'];
		$manager=$managerModel->find($id);
		$this->assign("manager",$manager);

		$this->display();
	}
	//修改编辑
	public function update(){
		if (IS_POST) {
			$model=M("Admin");
			$model->create();
			
			if ($model->save()) {
				$this->success("修改成功",U("Admin/manager"));
			}
			else{
				$this->error($model->getError());
			}
		}	
	}

	

}
