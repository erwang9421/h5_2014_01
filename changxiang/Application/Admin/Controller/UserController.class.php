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
    		//分页
    		$userModel=M('users');
            import('Org.Util.Page');
            $count=$userModel->count();
            $page=new \Think\Page($count,4);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
    		$user = $userModel->order('userid desc')->page($nowPage.',4')->select();  //读取操作
    		$show=$page->show();
            $this->assign('page',$show);
    		$this->assign('user', $user);  //传值到模板
    		$this->display();
    	}

    	public function edituser() {
            	if (isset($_POST['submit'])) {
            		$usermodel = M("Users");
            		if($usermodel->create()) //创建对象
            		{
            			if($usermodel->save()){ //修改操作
            				$this->success("修改成功", U("lists"));
            			}
            			else
            			{
            				$this->error("修改失败",U("lists"));
            			}
            		}
            		else
            		{
            			$this->error($usermodel->getError());
            		}
            	}
            	else {
            		$id=$_GET['userid'];
            		// dump($id);
            		if ($id == '') {
            			exit("bad param!");
            		}

            		 $data = M("Users")->where("userid=$id")->find();
            		$this->assign("data", $data);
            		$this->display();
            	}
            }


        	public function delete(){
        	$userModel = M("Users");
        	$id=$_GET['userid'];
        	if($userModel->where("userid=$id")->delete())
        		{
        			$this->success("用户删除成功",U("lists"));
        		}
        	else
        		{
        			$this->error($userModel->geterror());
        		}
        	}
}