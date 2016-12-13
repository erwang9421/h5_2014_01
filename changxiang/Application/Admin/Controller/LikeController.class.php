<?php
namespace Admin\Controller;
use Think\Controller;
class LikeController extends Controller{
    //判断是否登录
    public function __construct(){
        parent::__construct();
        if (!isLogin()) {
            $this->error("请先登录",U("Admin/login"));
        }
    }
	public function likebookview(){
		$likeModel=M("Likebookreview");

        import('Org.Util.Page');
        $count=$likeModel->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');

        $like=$likeModel->join('bookreview ON likebookreview.bookreviewid=bookreview.bookreviewid')
        ->join('users ON bookreview.userid=users.id')
        ->order('liketime desc')->page($nowPage.',4')->select();
        $show=$page->show();
        
        $this->assign('page',$show);
        $this->assign("like",$like);

		$this->display();
	}
	public function delete(){
		//全部删除
        $id = $_GET['likeId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Likebookreview")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Likebookreview")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }
    //查看详情
    public function editlikebookview(){
    	$likeModel=D("likebookreview");
		$id=$_GET['likeId'];

        $like=$likeModel->join('bookreview ON likebookreview.bookreviewid=bookreview.bookreviewid')
        ->join('users ON bookreview.userid=users.id')->find($id);

		// $like=$likeModel->find($id);
		$this->assign('like',$like);

    	$this->display();
    }
   
	


}