<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function __construct(){
        parent::__construct();
        if (!isLogin()) {
            $this->error("请先登录",U("Admin/login"));
        }
    }

 	public function adduser(){
		$this->display();
	}

	public function doAdd() {
    		if (!IS_POST) {
    		exit("bad request!");
    		}
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize=3145728 ;// 设置附件上传大小
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  = THINK_PATH; // 设置附件上传根目录
            $upload->savePath  ='../Public/uploads/userimage/'; // 设置附件上传（子）目录
            // 上传文件 
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            else{
                    //实例化模型类 格式 [资源://][模块/]模型
                $userModel = D("users");
                $authorModel = M("author");
                $data = $userModel -> create();
                if (!$data) {  //创建对象
                    $this->error($userModel->getError());
                }
                $email=$_POST['email'];
                $username=$_POST['username'];
                $map['username'] =$username;
                $checkRepeat=$userModel->where($map)->select();
                $checkRepeat2=$authorModel->where($map)->select();
                if($checkRepeat || $checkRepeat2)
                {
                    $this->error('用户名已存在');
                }
                $map2['email'] =$email;
                $checkRepeat3=$userModel->where($map2)->select();
                $checkRepeat4=$authorModel->where($map2)->select();
                if($checkRepeat4 || $checkRepeat3)
                {
                    $this->error('邮箱已被使用');
                }
                $data['userimage']=$info['userimage']['savepath'].$info['userimage']['savename'];                

                if ($userModel->add($data)) { //写入数据库
                    $this->success("添加成功！", U("lists"));            
                }
                else {
                    $this->error("添加失败！");
                }
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
            /*$user['attention]'=*/
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


        //删除用户
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


       

}