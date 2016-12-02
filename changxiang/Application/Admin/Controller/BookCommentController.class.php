<?php

namespace Admin\Controller;
use Think\Controller;


class BookCommentController extends Controller
{

    public function bookreview(){
        //实例化bookreview对象
        $booksModel = M("bookreview");
        //导入分页类
        import('Org.Util.Page');
        //查询满足要求的总记录数
        $count = $booksModel->count();
        //实例化分页类，传入总记录数和每一页显示的记录数5
        $page = new \Think\Page($count,5);
        //进行分页数据查询 Page方法的参数的前面部分是当前的页数，使用$_GET['p']获取
        $nowPage = isset($_GET['p'])?intval($_GET['p']):1;
        $page -> setConfig('first','第一页');
        $page -> setConfig('prev','前一页<<');
        $page -> setConfig('next','后一页>>');
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        $list = $booksModel -> order('publishtime desc') -> page($nowPage.',5') -> select();
        $show = $page -> show();//分页显示输出
        $this -> assign('page',$show);//赋值分页输出
        $this -> assign('list',$list);//赋值数据集
        $this -> display();//输出模板
    }

    //删除书评
    public function delbookreview(){
        $id = isset($_GET['bookreviewid']) ? intval($_GET['bookreviewid']) : '';
        if ($id === '') {
            exit("未知的id");
        }
        if(M("bookreview")->delete($id)){
            $this->success("删除成功！");
        }
    }
    public function addbookreview(){
        $this->display();
    }
    public function editbookreview(){
        $this -> display();
    }
}