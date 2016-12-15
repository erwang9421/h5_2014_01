<?php
namespace Home\Controller;
use Think\Controller;
class MineController extends Controller {
    public function addmessage(){
    	$usersModel=D("users");
    	$users=$usersModel->order('jointime desc')->select();
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
		    $this->success("添加成功",U("Mine/addmessage"));
		}else{
			$this->error("添加失败");
		}

	}

    public function booklist(){
    	$tagsModel=D('tags');
    	$tags=$tagsModel->select();
    	$this->assign("tags",$tags);

    	// $usersModel=D("users");
    	// $user=$usersModel->select();
    	// $this->assign("user",$user);

    	$this->display();
    }
    public function delete(){
        //全部删除
        // $id = $_GET['tagId'];
        $id=$this->_request('tagId');
        dump($id);
        if(is_array($id)){
            foreach($id as $value){
                M("Tags")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Tags")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }

    public function editbooklist(){
        $usersModel=D("tags");
        $id=$_GET['tagId'];
        $users=$usersModel->find($id);
        $this->assign("tag",$users);

        $this->display();
    }
    //修改booklist
    public function updatebooklist(){
        if (IS_POST) {
            $model=M("tags");
            $model->create();
            if ($model->save()) {
                $this->success("修改成功",U("Mine/booklist"));
            }
            else{
                $this->error($model->getError());
            }
        }   
    }

    public function drafts(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('books ON bookreview.bookid=books.bookid')
    	->order('publishtime desc')->select();
    	$this->assign("bookreview",$bookreview);

    	$this->display();
    }
    public function editmessage(){
        $usersModel=D("users");
        $id=$_GET['userId'];
        $users=$usersModel->find($id);
        $this->assign("user",$users);

    	$this->display();
    }
    //修改个人信息
    public function update(){
        if (IS_POST) {
            $model=M("users");
            $model->create();
            if ($model->save()) {
                $this->success("修改成功",U("Mine/addmessage"));
            }
            else{
                $this->error($model->getError());
            }
        }   
    }

    public function myattention(){
    	$usersModel=D("users");
    	$user=$usersModel->select();
    	$this->assign("user",$user);

    	$this->display();
    }
    public function myBookReview_all(){
    	$bookreviewModel=M("bookreview");
        $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->order('publishtime desc')->select();
        $this->assign("bookreview",$bookreview);

    	$this->display();
    }
    public function mybookslists(){
        $bookreviewModel=M("bookreview");
        $bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->order('publishtime desc')->select();
        $this->assign("bookreview",$bookreview);

    	$this->display();
    }
    public function myCollect(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
    	->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
    	->order('collecttimes desc')->select();
        // dump($bookreview);
        // exit;

    	$this->assign("bookreview",$bookreview);
    	

    	$this->display();
    }
    public function myfans(){
    	$usersModel=D("users");
    	$user=$usersModel->select();
    	$this->assign("user",$user);
    	
    	$this->display();
    }
    public function relevant(){
    	$bookreviewModel=M("bookreview");
    	$bookreview=$bookreviewModel->join('users ON bookreview.userid=users.id')
        ->join('books ON bookreview.bookid=books.bookid')
        ->join('tags ON bookreview.tagid=tags.tagid')
        ->join('reply ON bookreview.bookreviewid=reply.bookreviewid')
        ->join('comments ON bookreview.bookreviewid=comments.bookreviewid')
    	->order('publishtime desc')->select();
    	$this->assign("bookreview",$bookreview);

    	$this->display();
    }


    
}