<?php
namespace Home\Controller;
use Think\Controller;
class MineController extends Controller {
    public function addmessage(){
    	$usersModel=D("users");
    	$users=$usersModel->order('logintime desc')->select();
    	$this->assign("user",$users);

        $this->display();
    }
    //完善个人信息
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$tagsModel=D("users");
		if (!$tagsModel->create()) {
			$this->error($tagsModel->getError());
		}
		if ($tagsModel->add()) {
		    $this->success("添加成功",U("Index/index"));
		}else{
			$this->error("添加失败");
		}

	}

    public function booklist(){
    	$tagsModel=D('tags');
    	$tags=$tagsModel->select();
    	$this->assign("tags",$tags);

    	$usersModel=D("users");
    	$user=$usersModel->select();
    	$this->assign("user",$user);

    	$this->display();
    }

    public function drafts(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('books ON bookreview.bookid=books.bookid')
    	->order('publishtime desc')->select();
    	$this->assign("bookreview",$bookreview);

    	$this->display();
    }
    public function editmessage(){
    	$this->display();
    }
    public function myattention(){
    	$usersModel=D("users");
    	$user=$usersModel->select();
    	$this->assign("user",$user);

    	$this->display();
    }
    public function myBookReview_all(){
    	
    	$this->display();
    }
    public function mybookslists(){
    	$tagsModel=D('tags');
    	$tags=$tagsModel->select();
    	$this->assign("tags",$tags);

    	$this->display();
    }
    public function myCollect(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
    	->join('books ON bookreview.bookid=books.bookid')
    	->order('publishtime desc')->select();

    	// $tagsModel=M("tags");
    	// $tag=$tagsModel->join('users ON tags.userid=users.id')
    	// ->select();
    	// $this->assign("tag",$tag);

    	$this->assign("bookreview",$bookreview);
    	

    	$this->display();
    }
    public function myfans(){
    	$usersModel=D("users");
    	$user=$usersModel->select();
    	$this->assign("user",$user);
    	
    	$this->display();
    }
    public function relevent(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
    	->order('publishtime desc')->select();
    	$this->assign("bookreview",$bookreview);

    	$this->display();
    }


    
}