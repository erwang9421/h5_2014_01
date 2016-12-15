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
            // $this->show("前台默认");
            $bookscategoriesModel = M("bookscategories");
            $bookscategories=$bookscategoriesModel->select();

            $bookreviewModel = M('bookreview');
            $booksModel = M('books');
            $list = $bookreviewModel->join('books ON books.bookid = bookreview.bookid')->select();

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
            $booksModel=D("books");
            if (!$booksModel->create()) {
                $this->error($booksModel->getError());
            }
            if ($booksModel->add()) {
                $this->success("添加成功..",U("Index/index"));
            }else{
                $this->error("添加失败");
            }



        }

}