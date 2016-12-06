<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    //评论列表
    public function comment(){
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
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        $list = $commentsModel -> order('commenttime desc') -> page($nowPage.',5') -> select();
        $show = $page -> show();//分页显示输出
        $this -> assign('page',$show);//赋值分页输出
        $this -> assign('list',$list);//赋值数据集
        $this -> display();//输出模板
    }
    //添加评论
    public function addcomment(){

        $this -> display();
    }
    //添加评论页面点击提交调用doAdd方法
    public function doAdd(){
        if (!IS_POST) {
            exit("没有接收到post请求");
        }
        else{
            $commentsModel=D("comments");
            if(!$commentsModel->create()){
                $this->error($commentsModel -> getError());
            }
            else{
                if($commentsModel -> add()){
                    $this->success("添加成功",U("Comments/comment"));
                }
                else{
                    $this -> error("添加失败");
                }
            }
        }
    }
    //编辑评论
    public function editcomment(){
        $this -> display();
    }

}