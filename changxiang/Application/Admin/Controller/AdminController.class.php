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
	// public function logout(){
	// 	session('[destroy]');
	// 	$this -> redirect('Admin/login');
	// }
	
	public function manager(){
		//分页  
        $managerModel=M("Admin"); 
        import('Org.Util.Page');
        $count=$managerModel->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');
        $manager=$managerModel->order('jointime asc')->page($nowPage.',4')->select();
        $show=$page->show();
        $this->assign('page',$show);
        $this->assign("manager",$manager);

		$this->display();
	}
	public function addmanager(){
		$this->display();
	}
	public function doAddmanager(){
		if(!IS_POST){
			exit ("bad request请求");
		}

		$managerModel=D("admin");

		if(!$managerModel->create()){
			$this->error($this->getError());
		}
		if($managerModel->add()){
			$this->success("添加成功",U("Admin/manager"));
		}else{
			$this->error("添加失败",U("Admin/addmanager"));
		}
		// $this->display();
	}
	public function editmanager(){
		$managerModel=D("admin");
		$id=$_GET['managerId'];
		$manager=$managerModel->find($id);
		$this->assign("manager",$manager);
		// dump($manager);

		$this->display();
	}
	//修改
	public function update(){
		if (IS_POST) {
			$model=M("Admin");
			$model->create();
			// dump($model->create());
			if ($model->save()) {
				$this->success("修改成功",U("Admin/manager"));
			}
			else{
				$this->error($model->getError());
			}
		}	
	}
	//删除管理员
	public function delete(){
		//全部删除
        $id = $_GET['managerId'];
        // dump($id);
        if(is_array($id)){
            foreach($id as $value){
                M("Admin")->delete($value);
            }  
            $this->success("批量删除成功！");
        } 
        //单个删除
        else{
            if(M("Admin")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }

	

}
