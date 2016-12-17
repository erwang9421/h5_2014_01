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
    public function editpass(){
        $usersModel=D("users");
        $id=$_GET['userId'];
        $users=$usersModel->find($id);
        $this->assign("user",$users);

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
    //完善个人信息
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize=3145728 ;// 设置附件上传大小
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  = THINK_PATH; // 设置附件上传根目录
        $upload->savePath  ='../Public/uploads/userimage/'; // 设置附件上传（子）目录
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }
        else{
                //实例化模型类 格式 [资源://][模块/]模型
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

	}

    public function booklist(){
    	$tagsModel=D('tags');
    	$tags=$tagsModel->select();
    	$this->assign("tags",$tags);

    	$this->display();
    }
    public function delete(){
        //全部删除
        $id = $_GET['tagId'];
        if($id){
            $user=M('tags');
            $data['tagid']=$id;
            $rs=$user->where($data)->delete();
            if($rs){
                $this->success('删除成功!');
            }else{
                $this->error('删除失败!'); }
        }else{
            $this->error('删除失败!');
        }
        // dump($id);
        // if(is_array($id)){
        //     foreach($id as $value){
        //         M("Tags")->delete($value);
        //     }  
        //     $this->success("删除成功！");
        // } 
        //单个删除
        // else{
        //     if(M("Tags")->delete($id)){
        //         $this->success("删除成功！");
        //     }
        // }       
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