<?php

namespace Home\Controller;
use Think\Controller;

class BookController extends Controller {
    //计算评论时间与当前时间差的函数
    function time2Units ($time)
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

        //发表书评的用户名的实现
        $bookReviewModel = M("bookreview");
        $bookReviewName = $bookReviewModel -> join("users on bookreview.userid = users.id") -> find("{$bookreviewid}");
        $this -> assign("bookReviewName",$bookReviewName);

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
        //页面底部评论内容的动态获取
        //实例化评论表对象模型
        //实例化comments对象模型
        $comment = M("comments");
        $commentResult = $comment -> where("bookreviewid = {$bookreviewid}") -> order("commenttime desc") -> select();
        //导入分页类
        import('Org.Util.Page');
        //查询满足要求的总记录数
        $commentResult = $comment  -> where("bookreviewid = {$bookreviewid}") -> order("commenttime desc") -> select();
        $count = count($commentResult,COUNT_NORMAL);
        //实例化分页类，传入总记录数和每一页显示的记录数3
        $page = new \Think\Page($count,3);
        //进行分页数据查询 Page方法的参数的前面部分是当前的页数，使用$_GET['p']获取
        $nowPage = isset($_GET['p'])?intval($_GET['p']):1;
                $page -> setConfig('first','第一页');
                $page -> setConfig('prev','前一页');
                $page -> setConfig('next','后一页');
                //进行分页数据查询，注意limit方法的参数要使用Page类的属性
                $commentResult = $comment  -> where("bookreviewid = {$bookreviewid}") -> order("commenttime desc") -> page($nowPage.',3') -> select();
                $show = $page -> show();//分页显示输出
                $this -> assign('page',$show);//赋值分页输出


            //当前时间-评论时间=时间差，即“多长时间之前发表的评论”
            //for循环遍历数组，将commmenttime赋值为“多少小时或者多少年或者多少分钟或者多少秒”
        for($i = 0; $i < $count; $i++){
            $past = strtotime($commentResult[$i]["commenttime"]); // 发布日期
            $now = time(); // 当前日期
            $diff = $now - $past;//相差值

            $commentResult[$i]["commenttime"] = $this -> time2Units($diff);
        }

         $this -> assign("commentResult",$commentResult);
         //获取评论的条数
         $this -> assign("commentQuantity",$count);

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