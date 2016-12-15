<?php
namespace Home\Controller;
use Think\Controller;

class AuthorController extends Controller {
    //作家动态页面获取作家信息，传入作家的id，显示该作家的信息
    public function author_trend($authorid){
        //获取作家相关信息
        $bookReviewModel = M('author_trend');
        $result = $bookReviewModel -> find($authorid);
        $this -> assign("bookReview",$result);
        $this->display();
        //显示书评标题
        $bookReviewModel = M('author_trend');
        $result = $bookReviewModel -> find($authorid);
        $this -> assign("bookReview",$result);
        $this->display();

        public function bookReview_all(){
            $this->display();
        }
        public function fans(){
        $usersModel=D("users");
        $user=$usersModel->select();
        $this->assign("user",$user);
        
        $this->display();
        }
        public function Collect(){
            $bookreviewModel=M("bookreview");
            $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')->join('books ON bookreview.bookid=books.bookid')->order('publishtime desc')->select();
            $this->assign("bookreview",$bookreview);
        
            $this->display();
        }
        public function myattention(){
            $usersModel=D("users");
            $user=$usersModel->select();
            $this->assign("user",$user);

            $this->display();
        }
    }
    public function tags(){
        $tagsModel=D('tags');
        $tags=$tagsModel->select();
        $this->assign("tags",$tags);

        $this->display();
    }
}