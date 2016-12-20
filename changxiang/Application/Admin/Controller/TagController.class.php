<?php
namespace Admin\Controller;
use Think\Controller;
class TagController extends Controller{
	public function __construct(){
        parent::__construct();
        if (!isLogin()) {
            $this->redirect('Admin/login',0);
        }
    }
    public function tag(){
		$tagModel=M("Tags");

        import('Org.Util.Page');
        $count=$tagModel->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');

        $tag=$tagModel->join('users ON tags.userid=users.id')
        ->order('tagtime desc')->page($nowPage.',4')->select();

        $show=$page->show();

        $this->assign('page',$show);
        $this->assign("tag",$tag);
	  

		$this->display();
	}
	//查看详情
    public function edittag(){
        $tagModel=D("tags");
        $id=$_GET['tagId'];

        $tag=$tagModel->join('users ON tags.userid=users.id')->find($id);

        $this->assign('tag',$tag);

        $this->display();
    }
    public function delete(){
		//全部删除
        $id = $_GET['tagId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Tags")->delete($value);
            }  
            // $this->success("删除成功！");
            $this->redirect('Tag/tag',0);
        } 
        //单个删除
        else{
            if(M("Tags")->delete($id)){
                // $this->success("删除成功！");
                $this->redirect('Tag/tag',0);
            }
        }       
    }




}