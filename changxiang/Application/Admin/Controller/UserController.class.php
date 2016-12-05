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
    		$userModel = D("users");
    		if (!$userModel->create()) {  //创建对象
    			$this->error($userModel->getError());
    		}
             $email=$_POST['email'];
              $username=$_POST['username'];
            $map['username|email'] =array($username,$email,'_multi'=>true);
            $checkRepeat=$userModel->where($map)->select();
            if($checkRepeat)
            {
                $this->error('邮箱或者用户名已存在');
            }

    		if ($userModel->add()) { //写入数据库
    			$this->success("添加成功！", U("lists"));
    		}
    		else {
    			$this->error("添加失败！");
    		}
    	}

	    public function lists() {
            //分页
            $usermodel=M('users');
            import('Org.Util.Page');
            $count=$usermodel->count();
            $page=new \Think\Page($count,3);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
            $user=$usermodel->order('id desc')->page($nowPage.',9')->select();
            $show=$page->show();
            $this->assign('page',$show);
            $this->assign('user', $user);  //传值到模板
            $this->display();
        }

    	public function edituser() {
            if (isset($_POST['submit'])) {
                $usermodel = D("users");
                if($usermodel->create()) //创建对象
                {
                    if($usermodel->save()){ //修改操作
                        $this->success("修改成功", U("lists"));
                    }
                    else
                    {
                        $this->error("修改失败");
                    }
                }
                else
                {
                    $this->error($usermodel->getError());
                }
            }
            else {
                $id=$_GET['id'];
                // dump($id);
                if ($id == '') {
                    exit("bad param!");
                }

                 $data = D("Users")->where("id=$id")->find();
                $this->assign("data", $data);
                $this->display();
            }
        }


        //删除图书
        public function delete() {
            //全部删除
            $userModel = M("Users");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("Users")->delete($value);
                }
                $this->success("用户删除成功",U("lists"));
            }
            //单个删除
            else{
                if($userModel->where("id=$id")->delete())
                    {
                        $this->success("用户删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($userModel->geterror());
                    }
            }
        }


        public function deleteMore() {
            dump("????????");
            $getid=$_REQUEST['id'];//获取选择的复选框的值
            if (!$getid) $this->error('未选择记录') ;//没选择就提示信息
            $getids=implode(',',$getid); //选择一个以上，就用,把值连接起来(1,2,3)这样
            $id = is_array($getid)?$getids:$getid;//如果是数组，就把用,连接起来的值覆给$id,否则就覆获取到的没有,号连接起来的值
            //最后进行数据操作,例如你的是ArticleModel
            $Result=D("Users")->execute('DELETE FROM __TABLE__ where `id` IN ('.$id.')');
            if($Result===false){
                $this->error('操作失败');
            }
            else{
                $this->assign('jumpUrl',__URL__);
                $this->success("用户删除成功",U("lists"));
            }

        }


}