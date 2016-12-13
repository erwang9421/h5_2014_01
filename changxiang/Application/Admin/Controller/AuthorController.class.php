<?php
namespace Admin\Controller;
use Think\Controller;
class AuthorController extends Controller {
    public function __construct(){
            parent::__construct();
              if (!isLogin()) {
                  $this->error("请先登录",U("Admin/login"));
              }
    }

 	public function add(){
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
            $upload->savePath  ='../Public/uploads/authorimage/'; // 设置附件上传（子）目录
            // 上传文件 
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
        		//实例化模型类 格式 [资源://][模块/]模型
        		$authorModel = D("author");
                $userModel = M("users");
                $data = $authorModel->create();
        		if (!$data) {  //创建对象
        			$this->error($authorModel->getError());
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
                //设置thumb字段属性(目录+名字)  
                $data['idcard']=$info['idcard']['savepath'].$info['idcard']['savename']; 
                $data['authorimage']=$info['authorimage']['savepath'].$info['authorimage']['savename'];   

        		if ($authorModel->add($data)) { //写入数据库
        			$this->success("添加成功！", U("lists"));
        		}
        		else {
        			$this->error("添加失败！");
        		}
            }
    	}

	    public function lists() {
            //分页
            $authorModel=M('author');
            import('Org.Util.Page');
            $count=$authorModel->count();
            $page=new \Think\Page($count,3);
            $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
            $page->setConfig('first','第一页');
            $page->setConfig('prev','前一页');
            $page->setConfig('next','后一页');
            //进行分页数据查询，注意limit方法的参数要使用Page类的属性
            $author=$authorModel->order('authorid desc')->page($nowPage.',9')->select();
            $show=$page->show();
            $this->assign('page',$show);
            $this->assign('author', $author);  //传值到模板
            $this->display();
        }

    	public function edit() {
            if (isset($_POST['submit'])) {
                $authorModel = D("author");
                if($authorModel->create()) //创建对象
                {
                    if($authorModel->save()){ //修改操作
                        $this->success("修改成功", U("lists"));
                    }
                    else
                    {
                        $this->error("修改失败");
                    }
                }
                else
                {
                    $this->error($authorModel->getError());
                }
            }
            else {
                $id=$_GET['id'];
                // dump($id);
                if ($id == '') {
                    exit("bad param!");
                }

                $data = M("author")->where("authorid=$id")->find();
                $this->assign("data", $data);
                $this->display();
            }
        }


        //删除图书
        public function delete() {
            //全部删除
            $authorModel = M("author");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("author")->delete($value);
                }
                $this->success("批量删除成功",U("lists"));
            }
            //单个删除
            else{
                if($authorModel->where("authorid=$id")->delete())
                    {
                        $this->success("用户删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($authorModel->geterror());
                    }
            }
        }

}