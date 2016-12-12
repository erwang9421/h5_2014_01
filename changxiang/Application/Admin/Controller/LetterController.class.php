<?php
namespace Admin\Controller;
use Think\Controller;
class LetterController extends Controller{
    public function __construct(){
        parent::__construct();
        if (!isLogin()) {
            $this->error("请先登录",U("Admin/login"));
        }
    }
	public function letter(){
		$letterModel=M("messages");

        import('Org.Util.Page');
        $count=$letterModel->count();
        $page=new \Think\Page($count,4);
        $nowPage=isset($_GET['p'])?intval($_GET['p']):1;
        $page->setConfig('first','第一页');
        $page->setConfig('prev','前一页');
        $page->setConfig('next','后一页');

        $letter=$letterModel->join('users ON messages.receiveuserid=users.id')
        // ->join('users ON messages.senduserid=users.id')
        ->order('messagetime desc')->page($nowPage.',4')->select();

        $show=$page->show();

        $this->assign('page',$show);
        $this->assign("letter",$letter);
	  

		$this->display();
	}
	public function delete(){
		//全部删除
        $id = $_GET['letterId'];
        if(is_array($id)){
            foreach($id as $value){
                M("Messages")->delete($value);
            }  
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Messages")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }
    //查看详情
    public function editletter(){
        $letterModel=D("messages");
        $id=$_GET['letterId'];

        $letter=$letterModel->join('users ON messages.receiveuserid=users.id')->find($id);

        // $like=$likeModel->find($id);
        $this->assign('letter',$letter);

        $this->display();
    }


}