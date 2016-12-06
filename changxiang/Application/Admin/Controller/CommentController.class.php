<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    //评论列表
    public function comment(){
        //实例化comments模型对象
        $commentsModel = M('comments');

        $this -> display();
    }
    //添加评论
    public function addcomment(){
        $this -> display();
    }
    //编辑评论
    public function editcomment(){
        $this -> display();
    }

}