<?php
namespace Admin\Controller;
use Think\Controller;
class TagController extends Controller{
	public function __construct(){
        parent::__construct();
        if (!isLogin()) {
            $this->error("请先登录",U("Admin/login"));
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
            $this->success("删除成功！");
        } 
        //单个删除
        else{
            if(M("Tags")->delete($id)){
                $this->success("删除成功！");
            }
        }       
    }
    //添加
	public function addtag(){
		
		$this->display();
	}
	//添加书评标签
	public function doAdd(){
		if (!IS_POST) {
			exit("bad request请求");
		}
		$tagsModel=D("tags");
		if (!$tagsModel->create()) {
			$this->error($tagsModel->getError());
		}
		if ($tagsModel->add()) {
		    $this->success("添加成功",U("Tag/tag"));
		}else{
			$this->error("添加失败");
		}

	}




}