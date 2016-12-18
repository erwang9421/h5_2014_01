<?php

namespace Home\Controller;
use Think\Controller;

class BookController extends Controller {
    //index.html页面点击浏览全文，传入书评的id，显示书评详情页
    public function bookreviewcontent($bookreviewid){

        //发表书评的用户名的实现
        $bookReviewModel = M("bookreview");
        $bookReviewName = $bookReviewModel -> join("users on bookreview.userid = users.id") -> find("{$bookreviewid}");
        $this -> assign("bookReviewName",$bookReviewName);

        //书评发表时间的实现
        //实例化书评对象
        $bookReviewModel = M("bookreview");
        $bookReviewTime = $bookReviewModel -> find($bookreviewid);
        $this -> assign("bookReviewTime",$bookReviewTime);

        //书评浏览次数的实现
        $in = M("bookreview");
        $output = $in->where(array('bookreviewid' => $bookreviewid))->setInc('viewtimes',1);
        $info = $in -> find($bookreviewid);
        $this -> assign('info',$info);


        //书评评论量的实现
        $commentsModel = M("comments"); //实例化评论表对象模型
        //查询评论表中书评id为当前bookreviewid的评论条数
        $commentCounts = $commentsModel -> where("bookreviewid = {$bookreviewid}") -> count();
        $this -> assign("commentCounts",$commentCounts);


        //书评喜欢人数的实现
        $likeModel = M("likebookreview");
        $likeCounts = $likeModel -> where("bookreviewid = {$bookreviewid}") -> count();
        $this -> assign("likeCounts",$likeCounts);


        //书评收藏量的实现,即添加标签量的实现
        $collectModel = M("tags");
        $collectCounts = $collectModel -> where("bookreviewid = {$bookreviewid}") -> count();
        $this -> assign("collectCounts",$collectCounts);


        //图书分类的实现
        $bookReviewModel = M("bookreview");//实例化书评对象
        $category = $bookReviewModel -> join("books on bookreview.bookid = books.bookid") -> join("bookscategories on bookscategories.bcid = books.bcid") -> find($bookreviewid);
        $this -> assign("category",$category);


        //图书名的实现
        $books = $bookReviewModel -> join("books on bookreview.bookid = books.bookid") -> find($bookreviewid);
        $this -> assign("bookName",$books);

        //图书作者的实现
        $this -> assign("bookAuthor",$books);

        //显示书评标题以及书评内容
        $bookReviewModel = M('bookreview');
        $result = $bookReviewModel -> find($bookreviewid);
        $this -> assign("bookReview",$result);

        //页面底部评论内容的动态获取
        //实例化评论表对象模型
        $comment = M("comments");
        $commentResult = $comment -> where("bookreviewid = {$bookreviewid}") -> order("commenttime desc") -> select();
        $this -> assign("commentResult",$commentResult);

        //当前时间减去评论时间得到多少分钟之前发表的评论



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