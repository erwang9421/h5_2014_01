<?php
namespace Home\Controller;
use Think\Controller;
class OtherController extends Controller {
	public function __construct(){
        parent::__construct();
            if (!isLogins()) {
                // dump("并没有登录");
            }
    }
    public function attention(){
    	$authorModel=D('author');
        $author=$authorModel->select();
        $this->assign("author",$author);

        $userModel=D('users');
        $user=$userModel->select();
        $this->assign("user",$user);

    	$this->display();
    }
    public function collect(){
    	$bookreviewModel=M("bookreview");
        $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->order('publishtime desc')->select();
        $this->assign("bookreview",$bookreview);

    	$this->display();
    }
    public function fans(){
    	$authorModel=D('author');
        $author=$authorModel->select();
        $this->assign("author",$author);

        $userModel=D('users');
        $user=$userModel->select();
        $this->assign("user",$user);

    	$this->display();
    }
    public function privatemes(){
    	$messageModel=D('messages');
        $message=$messageModel->join('users ON messages.receiveuserid=users.id')->select();
        $this->assign("message",$message);

        $messageModel=D('messages');
        $message=$messageModel->join('users ON messages.senduserid=users.id')->select();
        $this->assign("mes",$message);

    	$this->display();
    }
    public function userbooklist(){
    	$tagsModel=D('tags');
    	$tags=$tagsModel->select();
    	$this->assign("tags",$tags);

    	$this->display();
    }
    public function userbookslists(){
    	$bookreviewModel=M("bookreview");
        $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->order('publishtime desc')->select();
        $this->assign("bookreview",$bookreview);
        
    	$this->display();
    }
    public function bookreview_all(){
        $bookreviewModel=M("bookreview");
        $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->order('publishtime desc')->select();
        $this->assign("bookreview",$bookreview);

        $this->display();
    }




}