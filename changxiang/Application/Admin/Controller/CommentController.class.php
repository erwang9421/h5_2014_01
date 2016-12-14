<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    //评论列表
    public function lists(){
        //实例化comments模型对象
        $commentsModel = M('comments');
        //导入分页类
        import('Org.Util.Page');
        //查询满足要求的总记录数
        $count = $commentsModel->count();
        //实例化分页类，传入总记录数和每一页显示的记录数5
        $page = new \Think\Page($count,5);
        //进行分页数据查询 Page方法的参数的前面部分是当前的页数，使用$_GET['p']获取
        $nowPage = isset($_GET['p'])?intval($_GET['p']):1;
        $page -> setConfig('first','第一页');
        $page -> setConfig('prev','前一页<<');
        $page -> setConfig('next','后一页>>');
        //实例化users模型对象
        $usersModel = M('users');
        //将用户表和评论表进行关联
        $this -> assign("result",$result);
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        $list2 = $commentsModel->join('bookreview ON comments.bookreviewid = bookreview.bookreviewid')->join( 'author ON comments.commentname = author.username' )->select();
        $list3 = $commentsModel->join('bookreview ON comments.bookreviewid = bookreview.bookreviewid')->join( 'users ON comments.commentname = users.username' )->select();
        $list4 =array_merge($list2,$list3);
        $show = $page -> show();//分页显示输出
        $this -> assign('page',$show);//赋值分页输出
        $this -> assign('list',$list4);//赋值数据集
        $this -> display();//输出模板
    }
    //添加评论
    public function add(){
        $this -> display();
    }
    //添加评论页面点击提交调用doAdd方法
    public function doAdd(){
        if (!IS_POST) {
            exit("没有接收到post请求");
        }
        else{
            $commentsModel=D("comments");
            $data = $commentsModel->create();
            if(!$data){
                $this->error($commentsModel -> getError());
            }
            else{
              /*  $data['commenttime'] = time();*/
                if($commentsModel -> add($data)){
                    $this->success("添加成功",U("lists"));
                }
                else{
                    $this -> error("添加失败");
                }
            }
        }
    }
    //编辑评论
    public function edit(){
        $id=$_GET['id'];
        if ($id == '') {
            exit("bad param!");
        }

        $data = M("comments")->where("commentid=$id")->find();
        $this->assign("data", $data);
        $this->display();
    }


    //删除评论
        public function delete() {
            //全部删除
            $commentModel = M("comments");
            $id = $_GET['id'];
            if(is_array($id)){
                foreach($id as $value){
                    M("comments")->delete($value);
                }
                $this->success("评论删除成功",U("lists"));
            }
            //单个删除
            else{
                if($commentModel->where("commentid=$id")->delete())
                    {
                        $this->success("评论删除成功",U("lists"));
                    }
                else
                    {
                        $this->error($commentModel->geterror());
                    }
            }
        }

}