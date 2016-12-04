<?php

namespace Admin\Controller;
use Think\Controller;


class BookCommentController extends Controller
{
    //显示书评列表
    public function bookreview(){
        //实例化bookreview对象
        $bookReviewModel = M("bookreview");
        //实例化图书对象
        $bookModel = M("books");
        //导入分页类
        import('Org.Util.Page');
        //查询满足要求的总记录数
        $count = $bookReviewModel-> count();
        //实例化分页类，传入总记录数和每一页显示的记录数5
        $page = new \Think\Page($count,5);
        //进行分页数据查询 Page方法的参数的前面部分是当前的页数，使用$_GET['p']获取
        $nowPage = isset($_GET['p'])?intval($_GET['p']):1;
        $page -> setConfig('first','第一页');
        $page -> setConfig('prev','前一页<<');
        $page -> setConfig('next','后一页>>');
        //进行分页数据查询，注意limit方法的参数要使用Page类的属性
        //SQL语句:join连接两个表，inner join从两个表中查询数据
        $sql = "select books.bookname,books.bookauthor,bookreview.userid,bookreview.title,bookreview.content,bookreview.publishtime from bookreview inner join books on bookreview.bookid = books.bookid order by bookreview.publishtime desc";
        $list = $bookReviewModel -> page($nowPage.',5') -> query($sql);
//        dump($list);
//        exit;

        $show = $page -> show();//分页显示输出
        $this -> assign('page',$show);//赋值分页输出
        $this -> assign('list',$list);//赋值数据集
        $this -> display();//输出模板
    }

    //删除书评
    public function delbookreview(){
        $id = isset($_GET['bookreviewid']) ? intval($_GET['bookreviewid']) : '';
        if ($id === '') {
            echo $id;
            exit("未知的id");
        }
        if(M("bookreview")->delete($id)){
            $this->success("删除成功！");
        }
    }
    public function addbookreview(){
        $this -> display();

    }

    //添加书评
    public function doaddbookreview(){
        if(!IS_POST){
            exit("错误的请求");
        }
        else{
            $bookModel = D('books');
            if(!$bookModel -> create()){
                $this ->error($bookModel -> getError());
            }
            else{
                //查询数据库中是否存在这本书，如果存在，则查找图书id
                //将图书id插入书评表中
                //如果数据库中不存在这本书，则将这本书插入图书表，然后将图书id插入书评表

                if($bookModel -> add()){
                    //说明图书添加成功，接下来添加书评
                    //获取图书名
                    $bookName = I('bookname');
                    //获取图书名为$bookName的图书的bookid
                    $bookId = $bookModel->getFieldBybookname("{$bookName}","bookid");
//                   echo M()-> getLastSql();
//                   var_dump($bookId);

                    //将图书的id插入到书评表中
                    //实例化bookreview模型对象

                    $bookReviewModel = M('bookreview');
                    $data['bookid'] = $bookId;
                    $data['userid'] = I('userid');
                    $data['title'] = I('title');
                    $data['content'] = I('content');
                    //出版时间默认设置为当前时间
                    $data['publishtime'] = date('Y-m-d H:i:s',time());
                    //data方法直接生成要操作的数据对象，无需create方法或赋值方法生成数据对象
                    if($bookReviewModel -> data($data) -> add()){
                        $this -> success("添加成功",U("BookComment/bookreview"));
                    }
                }
                else{
                    $this -> error("添加失败");
                }
            }
        }
    }
    public function editbookreview(){
        $this -> display();
    }
}