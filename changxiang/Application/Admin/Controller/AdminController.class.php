<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
	public function login(){
		$this->display();
	}
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
        $manager=$managerModel->order('jointime desc')->page($nowPage.',4')->select();
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
		$managerid=$_GET['managerId'];
		$manager=$managerModel->find($managerid);
		$this->assign("manager",$manager);
		//修改
		if(IS_POST){
			$model=D("admin");
			$model->create();
			// dump($model->create());
			if($model->save()){
				$this->success("修改成功",U("Admin/manager"));
			}else{
				// $this->error("修改失败",U("Admin/editmanager"));
				$this->error($model->getError());
			}
		}

		$this->display();
	}
	//删除管理员
	public function delete(){
		//全部删除
        $id = $_GET['managerId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Admin")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Admin")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }

	

}
