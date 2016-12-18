<?php

namespace Home\Controller;
use Think\Controller;

class BookController extends Controller {

    //计算评论时间与当前时间差的函数
    public  function time2Units ($time)
    {
        $year = floor($time / 60 / 60 / 24 / 365);
        $time -= $year * 60 * 60 * 24 * 365;
        $month = floor($time / 60 / 60 / 24 / 30);
        $time -= $month * 60 * 60 * 24 * 30;
        $week = floor($time / 60 / 60 / 24 / 7);
        $time -= $week * 60 * 60 * 24 * 7;
        $day = floor($time / 60 / 60 / 24);
        $time -= $day * 60 * 60 * 24;
        $hour = floor($time / 60 / 60);
        $time -= $hour * 60 * 60;
        $minute = floor($time / 60);
        $time -= $minute * 60;
        $second = $time;
        $elapse = '';

        $unitArr = array('年' =>'year', '个月'=>'month', '周'=>'week', '天'=>'day',
            '小时'=>'hour', '分钟'=>'minute', '秒'=>'second'
        );

        foreach ( $unitArr as $cn => $u )
        {
            if ( $$u > 0 )
            {
                $elapse = $$u . $cn;
                break;
            }
        }

        return $elapse;
    }
   // index.html页面点击浏览全文，传入书评的id，显示书评详情页
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

        //当前时间-评论时间=时间差，即“多长时间之前发表的评论”
        //for循环遍历数组，将commmenttime赋值为“多少小时或者多少年或者多少分钟或者多少秒”
        for($i = 0; $i < count($commentResult,COUNT_NORMAL); $i++){
            $past = strtotime($commentResult[$i]["commenttime"]);
            $now = time();//当前日期
            $diff = $now - $past;//相差值
            $commentResult[$i]["commenttime"] = $this -> time2Units($diff);
        }

        $this -> assign("commentResult",$commentResult);

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