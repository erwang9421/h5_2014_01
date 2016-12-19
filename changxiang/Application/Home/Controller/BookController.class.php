<?php

namespace Home\Controller;
use Think\Controller;

class BookController extends Controller {
    //index.html页面点击浏览全文，传入书评的id，显示书评详情页
    public function bookreviewcontent($bookreviewid){
        //书评浏览次数的实现
        $in = M("bookreview");
        $output = $in->where(array('bookreviewid' => $bookreviewid))->setInc('viewtimes',1);
        $info = $in -> find($bookreviewid);
        $this -> assign('info',$info);

        //显示书评标题以及书评内容
        $bookReviewModel = M('bookreview');
        $result = $bookReviewModel -> find($bookreviewid);
        $this -> assign("bookReview",$result);
        $this->display();
    }

     public function editarticle(){
        $bookscategoriesModel = M("bookscategories");
        $bookscategories=$bookscategoriesModel->select();

        $bookreviewModel = M('bookreview');
        $booksModel = M('books');

        $this -> assign('bookscategories',$bookscategories);//赋值数据集
        $this -> display();//输出模板
    }
    public function unlogindex(){
        $this->display();
    }


    public function publish(){
        if (!IS_POST) {
            exit("bad request请求");
        }
        $booksModel=D("bookreview");
        if (!$booksModel->create()) {
            $this->error($booksModel->getError());
        }
        if ($booksModel->add()) {
            $this->success("添加成功..",U("Index/index"));
        }else{
            $this->error("添加失败");
        } 
        
    }
    //添加书评
    public function addarticle(){
        $tags=M('Bookscategories');
        $taglist=$tags->join('books ON bookscategories.bcid = books.bcid')
        ->order('pid asc')->group('typebcname')->select();
        $this->assign('bookscategories',$taglist);

        $this->display();
    }
    //添加
    public function doAdd(){
        if (!IS_POST) {
            exit("bad request请求");
        }
        $booksModel=M('bookreview')->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid');
        $book=$booksModel->create();
        if($booksModel->add($data)){
            $this->success('添加成功');
        }else{
            $this->error('数据添加失败');
        }
    }





}